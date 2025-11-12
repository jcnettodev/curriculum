<?php

use App\Http\Controllers\CurriculumController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CurriculumController::class, 'index'])->name('curriculum');
Route::get('set-locale/{locale}', [CurriculumController::class, 'setLocale'])->name('setLocale')->where('locale', 'pt_BR|en');
Route::get('{locale}', [CurriculumController::class, 'index'])->name('curriculum.locale')->where('locale', 'pt_BR|en');

