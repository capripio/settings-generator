<?php

namespace Capripio\SettingsGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SettingsGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'capripio:settings {name}';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Custom Settings Template for Backpack';

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

        $name = $this->argument('name');
        $name = strtolower(str_slug($name,"_"));
        Artisan::call('make:migration:schema',[
            'name'  =>  "create_{$name}_settings_table",
            '--model' =>  0,
            '--schema'=> "\"key:string,name:string,description:string:nullable,value:longText,nullable,field:text:nullable,active:tinyInteger\""
        ]);
        $name = ucfirst($name);
        // Create the CRUD Controller and show output
        Artisan::call('capripio:crud-controller', ['name' => "{$name}Setting"]);
        echo Artisan::output();
        // Create the CRUD Model and show output
        Artisan::call('capripio:crud-model', ['name' => "{$name}Setting"]);
        echo Artisan::output();
        // Create the CRUD Request and show output
        Artisan::call('backpack:crud-request', ['name' => "{$name}Setting"]);
        echo Artisan::output();
        // Create the CRUD Seeder and show output
        Artisan::call('capripio:seeder', ['name' => "{$name}Setting"]);
        echo Artisan::output();

        return true;
    }
}
