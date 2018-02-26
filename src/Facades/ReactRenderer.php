<?php

namespace TektonLabs\ReactOnLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class ReactRenderer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'reactRenderer';
    }
}
