<?php

namespace App\Traits;

use App\Models\Scopes\VendorScope;

trait ApplyVendorScope
{
    protected static function booted(): void
    {
        static::addGlobalScope(new VendorScope());
    }
}
