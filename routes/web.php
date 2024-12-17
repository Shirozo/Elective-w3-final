<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\TopicContentController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, "content"])->name("index");

Route::get("/learn", [IndexController::class, "topicShow"])->name("t_show");

Route::group(["prefix" => "topic", "as" => "topic."], function() {
    Route::get("/", [TopicController::class, "show"])->name("show");

    Route::post("/store", [TopicController::class, "store"])->name("store");

    Route::delete("/delete", [TopicController::class, "delete"])->name("delete");

    Route::put("/update", [TopicController::class, "update"])->name("update");
});

Route::group(["prefix" => "content", "as" => "content."], function() {
    Route::get("/", [TopicContentController::class, "show"])->name("show");

    Route::post("/store", [TopicContentController::class, "store"])->name("store");

    Route::delete("/delete", [TopicContentController::class, "delete"])->name("delete");

    Route::put("/update", [TopicContentController::class, "update"])->name("update");

    Route::get("/api", [TopicContentController::class, "api"])->name("api");
});


require __DIR__.'/auth.php';