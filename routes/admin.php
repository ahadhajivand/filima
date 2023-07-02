<?php

use Illuminate\Support\Facades\Route;


Route::get('/',function (){
    return view('Admin.index');
});

Route::resource('categories' , \App\Http\Controllers\Admin\CategoryController::class);


Route::resource('films' , \App\Http\Controllers\Admin\film\FilmController::class);
Route::resource('films.similar' , \App\Http\Controllers\Admin\film\SimilarControoler::class);


Route::resource('serials' , \App\Http\Controllers\Admin\serial\SerialController::class);
Route::resource('serials.similar' , \App\Http\Controllers\Admin\serial\SimilarControoler::class);
Route::post('serial/link' , [\App\Http\Controllers\Admin\serial\Details\AddDetailsSerialController::class , 'link_index'])->name('serial-link-index');
Route::post('serial/link/{id}/store' , [\App\Http\Controllers\Admin\serial\Details\AddDetailsSerialController::class , 'link_store'])->name('serial-link-store');


Route::get('/comments/unapproved' , [\App\Http\Controllers\Admin\CommentController::class , 'unapproved'])->name('comments.unapproved');
Route::resource('comments' , \App\Http\Controllers\Admin\CommentController::class)->only(['index','destroy','update']);

Route::resource('plans' , \App\Http\Controllers\Admin\PlanController::class);

Route::resource('permissions' , \App\Http\Controllers\Admin\PermissionController::class);
Route::resource('roles' , \App\Http\Controllers\Admin\RoleController::class);




Route::get('updates' , [\App\Http\Controllers\Admin\Update\UpdateController::class , 'index'])->name('updates.index');
Route::get('updates/film' , [\App\Http\Controllers\Admin\Update\UpdateController::class , 'update_film'])->name('updates.film');
Route::get('updates/serial' , [\App\Http\Controllers\Admin\Update\UpdateController::class , 'update_serial'])->name('updates.serial');

Route::get('/PVideo' , [\App\Http\Controllers\Admin\Update\JobController::class , 'details_video'])->name('details_video');
Route::get('PSerial' , [\App\Http\Controllers\Admin\Update\JobController::class , 'details_serial'])->name('details_serial');
