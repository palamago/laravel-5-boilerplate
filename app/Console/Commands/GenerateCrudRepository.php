<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateCrudRepository extends GeneratorCrudCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'crud:repository';

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
        $path = config("crud.repository_path");

        return $path. '/' . ucwords($this->argument('modelName')) . '/Eloquent' . ucwords($this->argument('modelName')) . 'Repository.php';
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

        $filePathToGenerate = config("crud.repository_path"). '/' . ucwords($this->argument('modelName')) . '/' . ucwords($this->argument('modelName')) . 'RepositoryContract.php';

        try
        {
            $this->generator->make(
                config("crud.repository_contract_template"),
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
        return config("crud.repository_template");
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
