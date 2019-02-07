<?php

namespace OguzcanDemircan\LaravelStubGenerator\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelStubGenerator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelstubgenerator';
    }
}
