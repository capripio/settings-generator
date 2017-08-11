<?php

namespace Capripio\SettingsGenerator;

use Capripio\SettingsGenerator\Commands\CrudControllerCommand;
use Capripio\SettingsGenerator\Commands\ModelBackpackCommand;
use Capripio\SettingsGenerator\Commands\SeederCommand;
use Capripio\SettingsGenerator\Commands\SettingsGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Config;

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
        //if(!\App::runningInConsole()){
            $tables = DB::select('SHOW TABLES;');
            foreach($tables as $table){
                $table = (array) $table;
                $table = array_values($table);
                $table = $table[0];
                if (preg_match('/_settings$/',$table) && count(Schema::getColumnListing($table))) {
                    $settings = DB::table($table)->get();
                    $temp = str_replace("_settings","",$table);
                     foreach ($settings as $key => $setting) {
                         Config::set("{$temp}.".$setting->key, $setting->value); //TODO:: add into docs
                     }
                }
            }
        //}
        
        $this->loadTranslationsFrom(realpath(__DIR__.'/resources/lang'), 'capripio');
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
