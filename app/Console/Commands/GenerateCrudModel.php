<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;


class GenerateCrudModel extends GeneratorCrudCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'crud:model';

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
        $path = config("crud.model_path");

        return $path. '/' . ucwords($this->argument('modelName')) . '.php';
    }

    /**
     * Fetch the template data.
     *
     * @return array
     */
    protected function getTemplateData()
    {

        $fields = $this->parseAndGetFields();

        $fields['NAMESPACE'] = 'App\Models';
        $fields['RELATIONS'] = $this->fksRelations();

        return $fields;

    }

    /**
     * Get path to the template for the generator.
     *
     * @return mixed
     */
    protected function getTemplatePath()
    {
        return config("crud.model_template");
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
