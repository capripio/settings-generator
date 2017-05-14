<?php

namespace Capripio\SettingsGenerator;

use Capripio\SettingsGenerator\Commands\CrudControllerCommand;
use Capripio\SettingsGenerator\Commands\ModelBackpackCommand;
use Capripio\SettingsGenerator\Commands\SeederCommand;
use Capripio\SettingsGenerator\Commands\SettingsGenerator;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    protected $commands = [
        SettingsGenerator::class,
        CrudControllerCommand::class,
        ModelBackpackCommand::class,
        SeederCommand::class
    ];
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // publish the migrations and seeds
        $this->publishes([__DIR__.'/database/migrations/' => database_path('migrations')], 'migrations');
        $this->publishes([__DIR__.'/database/seeds/' => database_path('seeds')], 'seeds');

        // publish translation files
        $this->publishes([__DIR__.'/resources/lang' => resource_path('lang/vendor/capripio')], 'lang');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
    }
}
