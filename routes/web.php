<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GamifikasiController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KategoriSampahController;
use App\Http\Controllers\PenukaranPoinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SetorSampahController;
use Illuminate\Support\Facades\Route;

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
    return view('landing_page');
})->name('landing-page');

Route::post('/feedback', [FeedbackController::class, 'kirimFeedback'])->name('feedback');

Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', function () {
        return view('landing_page');
    })->name('beranda');

    Route::middleware(['verified'])->group(function () {
        Route::resource('item', ItemController::class);
        Route::resource('kategori-sampah', KategoriSampahController::class);
        Route::resource('penukaran-poin', PenukaranPoinController::class);
        Route::resource('penyetoran-sampah', SetorSampahController::class);
        Route::resource('quest', QuestController::class);
        Route::resource('role', RoleController::class);
    });

    // Gamifikasi
    Route::get('/list-quest', [GamifikasiController::class, 'index'])->name('list-quest');
    Route::post('/ambil-quest/{id}', [GamifikasiController::class, 'ambilQuest'])->name('ambil-quest');
    Route::get('/perbarui-quest/{id}', [GamifikasiController::class, 'editQuest'])->name('perbarui-quest');
    Route::put('/perbarui-quest/{id}', [GamifikasiController::class, 'updateQuest'])->name('update-quest');
    Route::get('/detail-quest/{id}', [GamifikasiController::class, 'detailQuest'])->name('detail-quest');
    Route::delete('/hapus-quest/{id}', [GamifikasiController::class, 'hapusQuest'])->name('hapus-quest');

    // Admin
    Route::get('/admin/reward-quest', [GamifikasiController::class, 'penerimaReward'])->name('reward-quest');
    Route::put('/admin/kirim-reward-quest/{userId}/{questId}', [GamifikasiController::class, 'updateStatus'])->name('kirim-reward-quest');
});

require __DIR__ . '/auth.php';
