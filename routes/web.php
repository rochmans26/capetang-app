<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GamifikasiController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KategoriSampahController;
use App\Http\Controllers\PenukaranPoinController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SetorSampahController;
use App\Http\Controllers\UserDashboardController;
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

Route::get('/v-kategori-sampah/', function () {
    return view('users.kategori_sampah');
})->name('user-kategori-sampah');
Route::get('/v-reward-poin/', function () {
    return view('users.riwayat_reward_poin');
})->name('reward-poin');
Route::get('/v-riwayat-tukar-poin/', function () {
    return view('users.riwayat_tukar_poin');
})->name('riwayat-tukar-poin');
Route::get('/v-tukar-poin/', function () {
    return view('users.tukar_poin');
})->name('tukar-poin');
Route::get('/v-user-profile/', function () {
    return view('users.user_profile');
})->name('user-profile');
Route::get('/v-user-authentication/', function () {
    return view('auth.change-password');
})->name('user-authentication');

Route::post('/feedback', [FeedbackController::class, 'kirimFeedback'])->name('feedback');

Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', function () {
        return view('landing_page');
    })->name('beranda');

    Route::middleware(['verified'])->group(function () {
        Route::resource('item', ItemController::class);
        Route::resource('kategori-sampah', KategoriSampahController::class);
        Route::resource('penukaran-poin', PenukaranPoinController::class);
        Route::resource('quest', QuestController::class);
        Route::resource('role', RoleController::class);
    });

    // Admin
    Route::prefix('admin')->middleware(['verified'])->group(function () {
        Route::get('/reward-quest', [GamifikasiController::class, 'penerimaReward'])->name('admin.reward-quest');
        Route::put('/kirim-reward-quest/{userId}/{questId}', [GamifikasiController::class, 'updateStatus'])->name('admin.kirim-reward-quest');
        Route::resource('/penyetoran-sampah', SetorSampahController::class);
    });

    // Users
    Route::prefix('users')->middleware(['verified'])->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('users.dashboard');
        // Gamifikasi
        Route::get('/list-quest', [GamifikasiController::class, 'allQuest'])->name('users.list-quest');
        Route::get('/quest', [GamifikasiController::class, 'listQuestUser'])->name('users.quest-user');
        Route::post('/ambil-quest/{id}', [GamifikasiController::class, 'ambilQuest'])->name('users.ambil-quest');
        Route::get('/perbarui-quest/{id}', [GamifikasiController::class, 'editQuest'])->name('users.perbarui-quest');
        Route::put('/perbarui-quest/{id}', [GamifikasiController::class, 'updateQuest'])->name('users.update-quest');
        Route::get('/detail-quest/{id}', [GamifikasiController::class, 'detailQuest'])->name('users.detail-quest');
        Route::delete('/hapus-quest/{id}', [GamifikasiController::class, 'hapusQuest'])->name('users.hapus-quest');
    });
});

require __DIR__ . '/auth.php';
