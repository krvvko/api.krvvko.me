<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/projects', function() {
   return \App\Models\Project::all();
});

Route::get('/projects/{id}', function($id) {
   return \App\Models\Project::findOrFail($id);
})->where('id', '\d+');

Route::get('/experience', function() {
   return \App\Models\Experience::all();
});
