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

        $tables = $this->schemaGenerator->getTables();

        foreach ($tables as $key => $tableName) {
            if ($this->confirm("Do you want me to create a CRUD structure for '$tableName' table? [yes|no]"))
            {

                $this->call('crud:model', [
                    'tableName' => $tableName,
                    'modelName' => $this->getModelName($tableName),
                    'fields' => $this->schemaGenerator->getFields($tableName),
                    'foreignKeys' => $this->schemaGenerator->getForeignKeyConstraints($tableName)
                ]);
            }
        }

    }

}
