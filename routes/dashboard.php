<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Routing\Route;

Route::resource('dashboard/categories', CategoriesController::class);
