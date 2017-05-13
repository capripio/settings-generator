<?php

namespace Capripio\SettingsGenerator\Commands;


class ModelBackpackCommand extends \Backpack\Generators\Console\Commands\ModelBackpackCommand
{
    protected $name = 'capripio:model';
    protected $signature = 'capripio:model {name} {--softdelete}';
    protected function getStub()
    {
        if ($this->option('softdelete')) {
            return __DIR__.'/../stubs/model-softdelete.stub';
        }

        return __DIR__.'/../stubs/model.stub';
    }

}
