<?php

use App\Http\Controllers\SubmitTaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('submit-task-answer')->name('submit.task.answer.')->group(function () {
    Route::post('store/{courseAssignment}', [SubmitTaskController::class, 'store'])->name('store');
    Route::get('{submitTask}', [SubmitTaskController::class, 'show'])->name('show');
    Route::put('{submitTask}', [SubmitTaskController::class, 'update'])->name('update');
    Route::delete('{submitTask}', [SubmitTaskController::class, 'destroy'])->name('destroy');
    Route::patch('update-status/{submitTask}', [SubmitTaskController::class, 'updateStatus'])->name('update-status');
    Route::post('download/{submitTask}', [SubmitTaskController::class, 'download'])->name('download');
});
