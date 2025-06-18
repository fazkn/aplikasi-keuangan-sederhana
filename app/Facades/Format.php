<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Format extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'format';
    }
}
// This code defines a facade for a format helper in a Laravel application.
// The `Format` class extends the `Facade` class and specifies the accessor method