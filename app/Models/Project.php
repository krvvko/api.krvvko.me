<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $table = 'my_projects';
    public $timestamps = false;
    protected $casts = [
        'ProjectDeployed' => 'bool',
        'ProjectTechnologies' => 'array',
        'ProjectImages' => 'array'
    ];

    protected function ProjectCreationDay(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('Y-m-d', $value / 1000), // Assuming the value is in milliseconds
            set: fn ($value) => strtotime($value) * 1000,
        );
    }
}
