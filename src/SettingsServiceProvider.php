<?php

namespace Capripio\SettingsGenerator;

use Capripio\SettingsGenerator\Commands\CrudControllerCommand;
use Capripio\SettingsGenerator\Commands\ModelBackpackCommand;
use Capripio\SettingsGenerator\Commands\SettingsGenerator;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    protected $commands = [
        SettingsGenerator::class,
        CrudControllerCommand::class,
        ModelBackpackCommand::class,
    ];
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
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
