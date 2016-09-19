<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateCrudView extends GeneratorCrudCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'crud:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CRUD generation for Laravel 5 Boilerplate based on existing database table.';

    /**
     * The path to where the file will be created.
     *
     * @return mixed
     */
    protected function getFileGenerationPath()
    {
        $path = config("crud.view_path");

        return $path. '/' . $this->argument('tableName') . '/index.blade.php';
    }

    /**
     * Fetch the template data.
     *
     * @return array
     */
    protected function getTemplateData()
    {
        $fields = $this->parseAndGetFields();

        $fields['NAMESPACE'] = 'App\Repositories\Backend\\'.$fields['MODEL'];

        $fields['TABLE_HEADERS'] = $this->getFillablesFieldsTableHeader();
        $fields['JSON_CONFIG'] = $this->getFillablesFieldsJsonConfig();
        $fields['FIELDS_SHOW'] = $this->getFieldsShow();
        $fields['FIELDS_FORM'] = $this->getFillablesFieldsForm();

        //SHOW
        $filePathToGenerate = config("crud.view_path"). '/' . $this->argument('tableName') . '/show.blade.php';

        try
        {
            $this->generator->make(
                config("crud.view_show_template"),
                $fields,
                $filePathToGenerate
            );

            $this->info("Created: {$filePathToGenerate}");
        }

        catch (FileAlreadyExists $e)
        {
            $this->error("Se ignora la creacion de crud contract");
        }

        //EDIT
        $filePathToGenerate = config("crud.view_path"). '/' . $this->argument('tableName') . '/edit.blade.php';

        try
        {
            $this->generator->make(
                config("crud.view_edit_template"),
                $fields,
                $filePathToGenerate
            );

            $this->info("Created: {$filePathToGenerate}");
        }

        catch (FileAlreadyExists $e)
        {
            $this->error("Se ignora la creacion de crud contract");
        }

        //CREATE
        $filePathToGenerate = config("crud.view_path"). '/' . $this->argument('tableName') . '/create.blade.php';

        try
        {
            $this->generator->make(
                config("crud.view_create_template"),
                $fields,
                $filePathToGenerate
            );

            $this->info("Created: {$filePathToGenerate}");
        }

        catch (FileAlreadyExists $e)
        {
            $this->error("Se ignora la creacion de crud contract");
        }

        //FORM
        $filePathToGenerate = config("crud.view_path"). '/' . $this->argument('tableName') . '/form.blade.php';

        try
        {
            $this->generator->make(
                config("crud.view_form_template"),
                $fields,
                $filePathToGenerate
            );

            $this->info("Created: {$filePathToGenerate}");
        }

        catch (FileAlreadyExists $e)
        {
            $this->error("Se ignora la creacion de crud contract");
        }


        return $fields;
    }

    /**
     * Get path to the template for the generator.
     *
     * @return mixed
     */
    protected function getTemplatePath()
    {
        return config("crud.view_index_template");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [

            ['tableName', InputArgument::REQUIRED, 'The name of the table'],
            ['modelName', InputArgument::REQUIRED, 'The name of the desired Eloquent model'],
            ['fields', InputArgument::REQUIRED, 'Fields'],
            ['foreignKeys', InputArgument::REQUIRED, 'FKs']
        ];
    }

}
