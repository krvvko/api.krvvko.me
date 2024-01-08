<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public $table = 'my_experience';
    public $timestamps = false;

    protected function StartDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('Y-m-d', $value / 1000),
            set: fn ($value) => strtotime($value)*1000,
        );
    }
}
