<?php

namespace Lairg\ViewComponents\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lairg\ViewComponents\ViewComponents
 */
class ViewComponents extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Lairg\ViewComponents\ViewComponents::class;
    }
}
