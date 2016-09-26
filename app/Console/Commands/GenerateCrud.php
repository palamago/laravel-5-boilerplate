<?php

namespace App\Console\Commands;

use Way\Generators\Commands\ResourceGeneratorCommand;
use Xethron\MigrationsGenerator\Generators\SchemaGenerator;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateCrud extends ResourceGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CRUD generation for Laravel 5 Boilerplate based on existing database table.';

    protected $database;

    protected $schema;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $database = config('database.default');
        $this->info( 'Using connection: '. $database ."\n" );
        $this->schemaGenerator = new SchemaGenerator(
            $database,
            InputOption::VALUE_NONE,
            InputOption::VALUE_NONE
        );

        $repositorios = array();
        $routes = array();

        $tables = $this->schemaGenerator->getTables();

        foreach ($tables as $key => $tableName) {
            if ($this->confirm("Do you want me to create a CRUD structure for '$tableName' table? [yes|no]"))
            {
                $fields = $this->schemaGenerator->getFields($tableName);
                $fks = $this->schemaGenerator->getForeignKeyConstraints($tableName);

                $arguments = [
                    'tableName' => $tableName,
                    'modelName' => $this->getModelName($tableName),
                    'fields' => $fields,
                    'foreignKeys' => $fks
                ];

                if ($this->confirm("Model for '$tableName' table? [yes|no]")){
                    $this->call('crud:model',       $arguments);
                }
                if ($this->confirm("Repository for '$tableName' table? [yes|no]")){
                    $this->call('crud:repository',  $arguments);
                    
                    $repositorios[] = '
        $this->app->bind(
            \App\Repositories\Backend\\'.$arguments['modelName'].'\\'.$arguments['modelName'].'RepositoryContract::class,
            \App\Repositories\Backend\\'.$arguments['modelName'].'\Eloquent\\'.$arguments['modelName'].'Repository::class
        );
        ';

                }
                if ($this->confirm("Controller & Requests for '$tableName' table? [yes|no]")){
                    $this->call('crud:request',       $arguments);
                    $this->call('crud:controller',  $arguments);

                   $routes[] = "
        Route::get('".$arguments['tableName']."/get', '".$arguments['modelName']."Controller@get')->name('admin.".$arguments['tableName'].".get');
        Route::resource('".$arguments['tableName']."', '".$arguments['modelName']."Controller');
        ";

                }
                if ($this->confirm("Views for '$tableName' table? [yes|no]")){
                    $this->call('crud:view',        $arguments);
                }

            }
        }

        $this->info('Recuerde copiar lo siguiente en el CrudServiceProvider');
        $this->info(implode('',$repositorios));

        $this->info('Recuerde copiar lo siguiente en el Crud.php en routes');
        $this->info(implode('',$routes));

    }

}
