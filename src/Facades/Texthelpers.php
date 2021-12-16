<?php

namespace Shawnveltman\Texthelpers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Shawnveltman\Texthelpers\TextTrait
 */
class Texthelpers extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'texthelpers';
    }
}
