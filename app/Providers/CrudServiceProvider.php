<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class CrudServiceProvider
 * @package App\Providers
 */
class CrudServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Package boot method
     */
    public function boot()
    {
        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Backend\Calificacion\CalificacionRepositoryContract::class,
            \App\Repositories\Backend\Calificacion\EloquentCalificacionRepository::class
        );

    }

}