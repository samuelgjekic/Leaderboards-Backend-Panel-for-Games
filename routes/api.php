<?php

use Illuminate\Support\Facades\Route;

Route::middleware('api.key')->group(function () {
    Route::get('/leaderboards/{id}', [\App\Http\Controllers\Api\LeaderboardController::class, 'show']);
    Route::post('/leaderboards/{id}/entries/create', [\App\Http\Controllers\Api\LeaderboardController::class, 'store']);
    Route::delete('/leaderboards/{id}/entries/delete/{entryId}', [\App\Http\Controllers\Api\LeaderboardController::class, 'destroy']);
});
