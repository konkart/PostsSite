<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/posts');
});

Route::resource('posts', 'App\Http\Controllers\PostController');