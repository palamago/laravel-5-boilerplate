<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateCrudController extends GeneratorCrudCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'crud:controller';

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
        $path = config("crud.controller_path");

        return $path. '/' . ucwords($this->argument('modelName')) . 'Controller.php';
    }

    /**
     * Fetch the template data.
     *
     * @return array
     */
    protected function getTemplateData()
    {

        $fields = $this->parseAndGetFields();

        $fields['NAMESPACE'] = 'App\Http\Controllers\Backend';

        $fields['RELATIONS_USE'] = collect($this->fks)->reduce(function ($s, $fk) {
            return $s . "
use App\Repositories\Backend\\".ucwords($fk['on'])."\\".ucwords($fk['on'])."RepositoryContract;";
        }, '');
        
        $fields['RELATIONS_PROTECTED'] = collect($this->fks)->reduce(function ($s, $fk) {
            return $s . "
    protected $" . $fk['on'] . ";";
        }, '');

        $fields['RELATIONS_REPOSITORIES'] = collect($this->fks)->reduce(function ($s, $fk) {
            return $s . "
        ".ucwords($fk['on'])."RepositoryContract $".$fk['on'].",";
        }, '');

        $fields['RELATIONS_SET'] = collect($this->fks)->reduce(function ($s, $fk) {
            return $s . "
        \$this->".$fk['on']."= $".$fk['on'].";";
        }, '');


        $fields['RELATIONS_WITH'] = collect($this->fks)->reduce(function ($s, $fk) {
            return $s . "
            ->with".ucwords($fk['on'])."(\$this->".$fk['on']."->getList())";
        }, '');

        return $fields;

    }

    /**
     * Get path to the template for the generator.
     *
     * @return mixed
     */
    protected function getTemplatePath()
    {
        return config("crud.controller_template");
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
