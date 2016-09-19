<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateCrudRequest extends GeneratorCrudCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'crud:request';

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
        $path = config("crud.request_path");

        return $path. '/' . ucwords($this->argument('modelName')) . '/Manage' . ucwords($this->argument('modelName')) . 'Request.php';
    }

    /**
     * Fetch the template data.
     *
     * @return array
     */
    protected function getTemplateData()
    {
        $fields = $this->parseAndGetFields();

        $fields['NAMESPACE'] = 'App\Http\Requests\Backend\\'.$fields['MODEL'];
        $fields['VALIDATION_FIELDS'] = $this->getFillablesFieldsRequired();

        $filePathToGenerate = config("crud.request_path"). '/' . ucwords($this->argument('modelName')) . '/Store' . ucwords($this->argument('modelName')) . 'Request.php';

        try
        {
            $this->generator->make(
                config("crud.request_store_template"),
                $fields,
                $filePathToGenerate
            );

            $this->info("Created: {$filePathToGenerate}");
        }

        catch (FileAlreadyExists $e)
        {
            $this->error("Se ignora la creacion de crud request");
        }

        $filePathToGenerate = config("crud.request_path"). '/' . ucwords($this->argument('modelName')) . '/Update' . ucwords($this->argument('modelName')) . 'Request.php';

        try
        {
            $this->generator->make(
                config("crud.request_update_template"),
                $fields,
                $filePathToGenerate
            );

            $this->info("Created: {$filePathToGenerate}");
        }

        catch (FileAlreadyExists $e)
        {
            $this->error("Se ignora la creacion de crud request");
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
        return config("crud.request_manage_template");
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
