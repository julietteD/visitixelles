<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
});

Route::get('/admin/jsonlocations', [AdminController::class, 'jsonlocations'])->name('admin.json-locations');
Route::get('/admin/jsonlocation/{location_id?}', [AdminController::class, 'jsonlocation'])->name('admin.json-location');
Route::get('/admin/jsontags', [AdminController::class, 'jsontags'])->name('admin.json-tags');

Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('locations', [AdminController::class, 'locations'])->name('admin.locations');
    Route::get('locations/new', [AdminController::class, 'editLocation'])->name('admin.locations.new');
    Route::get('locations/edit/{id}', [AdminController::class, 'editLocation'])->name('admin.locations.edit');
    Route::get('locations/delete/{id}', [AdminController::class, 'deleteLocation'])->name('admin.locations.delete');
    Route::post('locations/edit', [AdminController::class, 'editLocationAction'])->name('admin.locations.edit.action');
    Route::get('deletetags/{id}', [AdminController::class, 'deletetags'])->name('admin.deletetags');
    Route::get('deletealltags', [AdminController::class, 'deletealltags'])->name('admin.deletealltags');
    Route::get('tags', [AdminController::class, 'tags'])->name('admin.tags');
    Route::get('tags/edit/{id}', [AdminController::class, 'editTag'])->name('admin.tags.edit');
    Route::post('tags/edit', [AdminController::class, 'editTagAction'])->name('admin.tags.edit.action');
    Route::get('map', [AdminController::class, 'map'])->name('admin.map');
    Route::post('map', [AdminController::class, 'editMapAction'])->name('admin.map.edit.action');
    Route::get('gif', [AdminController::class, 'gif'])->name('admin.editgif');
    Route::post('gif', [AdminController::class, 'editGifAction'])->name('admin.gif.edit.action');
});

require __DIR__.'/auth.php';
