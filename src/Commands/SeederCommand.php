<?php

namespace Capripio\SettingsGenerator\Commands;

use Illuminate\Console\GeneratorCommand;

class SeederCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'capripio:seeder';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'capripio:seeder {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a seeder for Setting';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seed';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/SettingsTableSeeder.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Replace the table name for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return string
     */
    protected function replaceTable(&$stub, $name)
    {
        $table = ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', str_replace($this->getNamespace($name).'\\', '', $name))), '_').'s';

        $stub = str_replace('DummyTable', $table, $stub);

        return $this;
    }

    /**
     * Build the class with the given name.
     *
     * @param string $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceTable($stub, $name)->replaceClass($stub, $name."TableSeeder");
    }

    protected function getPath($name)
    {
        $name = str_replace("App\\","",$name);
        $name = ucwords(camel_case($name)) . 'TableSeeder';
        return base_path() . '/database/seeds/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [

        ];
    }
}
