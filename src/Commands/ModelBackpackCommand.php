<?php

namespace Capripio\SettingsGenerator\Commands;


class ModelBackpackCommand extends \Backpack\Generators\Console\Commands\ModelBackpackCommand
{
    protected $name = 'capripio:crud-model';
    protected $signature = 'capripio:crud-model {name} {--softdelete}';
    protected function getStub()
    {
        if ($this->option('softdelete')) {
            return __DIR__.'/../stubs/model-softdelete.stub';
        }

        return __DIR__.'/../stubs/model.stub';
    }


    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Models';
    }

}
