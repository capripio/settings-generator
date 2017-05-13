<?php

namespace Capripio\SettingsGenerator\Commands;

use Backpack\Generators\Console\Commands\CrudControllerBackpackCommand;

class CrudControllerCommand extends CrudControllerBackpackCommand
{
    protected $name = 'capripio:crud-controller';
    protected $signature = 'capripio:crud-controller {name}';

    protected function getStub()
    {
        return __DIR__.'/../stubs/crud-controller.stub';
    }

}
