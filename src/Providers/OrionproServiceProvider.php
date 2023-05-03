<?php

namespace Osfrportal\OrionproLaravel\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;

class OrionproServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Date::use(CarbonImmutable::class);
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
            $this->publishes([
                __DIR__ . '/../../config/orionpro.php' => config_path('orionpro.php'),
            ]);
        }
        //JsonResource::withoutWrapping();
        $this->registerAPIRoutes();

    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //JsonResource::withoutWrapping();
        $this->mergeConfigFrom(
            __DIR__.'/../../config/orionpro.php', 'orionpro'
        );
    }

    /**
     * Register the package API routes.
     *
     * @return void
     */
    protected function registerAPIRoutes()
    {
            Route::group([
                'prefix' => 'api/osfr/v1/orionpro',
                'namespace' => 'Osfrportal\OrionproLaravel\Http\Controllers',
                'as' => 'osfrapi.orionpro.',
            ], function () {
                $this->loadRoutesFrom(__DIR__.'/../../routes/orionpro_api_v1.php');
            })->middleware('api');
    }
}
