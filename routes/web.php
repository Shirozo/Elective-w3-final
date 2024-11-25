<?php

use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TopicController::class, "show"])->name("topic.show");

Route::get("/store/topic", [TopicController::class, "store"])->name("topic.store");