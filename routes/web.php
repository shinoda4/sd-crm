<?php
/*
 * Copyright (c) 2025 Shunde
 * All rights reserved.
 *
 * This source code is strictly confidential and proprietary.
 * The content of this file may not be disclosed to third parties, copied or
 * duplicated in any form, in whole or in part, without the prior written
 * permission of Shunde.
 *
 * Use of this source code is governed by the terms of the license agreement
 * contained in the LICENSE file found in the root directory of this source tree.
 * If no LICENSE file is found, use is strictly prohibited.
 */

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\PipelineStageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/customers', CustomerController::class);
    Route::resource('/contacts', ContactController::class);
    Route::resource('/deals', DealController::class);
    Route::patch('/deals/{deal}/stage', [DealController::class, 'updateStage'])
        ->name('deals.updateStage');
    Route::resource('/pipeline-stages', PipelineStageController::class);
    Route::get('/customers/{customer}/contacts', [ContactController::class, 'indexByCustomer'])
        ->name('customers.contacts.index');
    Route::get('/customers/{customer}/deals', [DealController::class, 'indexByCustomer'])
        ->name('customers.deals.index');

});

require __DIR__ . '/auth.php';
