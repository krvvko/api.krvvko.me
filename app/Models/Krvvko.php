<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Krvvko extends Model
{
    public $table = 'krvvko';
    public $timestamps = false;
    protected $casts = [
        'ContactLinks' => 'array'
    ];

    protected function ProjectCreationDay(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('Y-m-d', $value / 1000),
            set: fn ($value) => strtotime($value)*1000,
        );
    }

}
