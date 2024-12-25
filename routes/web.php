<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GamifikasiController;
use App\Http\Controllers\HistoryTransaksiController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KategoriSampahController;
use App\Http\Controllers\PenukaranPoinController;
use App\Http\Controllers\ProfileController;
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
Route::get('/user-trans-detail', function () {
    return view('users.detail_transaksi_tukar_poin');
})->name('user-trans-detail');
Route::get('/user-checkout', function () {
    return view('users.checkout');
})->name('user-checkout');

Route::get('/', function () {
    return view('landing_page');
})->name('landing-page');

// Form Feedback dari Landing Page
Route::post('/feedback', [FeedbackController::class, 'kirimFeedback'])->name('feedback');

Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', function () {
        return view('landing_page');
    })->name('beranda');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('users-profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('users-profile.update');

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
        // Notes*
        /*Kiw, anu kategori sampah ieu anu nyieun error pas php artisan optimize teh. Penamaan Urlna ganti cobaan*/
        Route::resource('kategori-sampah', KategoriSampahController::class)->only('index', 'show'); // ganti namana cobaan soalna diluhur geus aya nu make
        // Gamifikasi
        Route::get('/list-quest', [GamifikasiController::class, 'allQuest'])->name('users.list-quest');
        Route::get('/quest', [GamifikasiController::class, 'listQuestUser'])->name('users.quest-user');
        Route::post('/ambil-quest/{id}', [GamifikasiController::class, 'ambilQuest'])->name('users.ambil-quest');
        Route::get('/perbarui-quest/{id}', [GamifikasiController::class, 'editQuest'])->name('users.perbarui-quest');
        Route::put('/perbarui-quest/{id}', [GamifikasiController::class, 'updateQuest'])->name('users.update-quest');
        Route::get('/detail-quest/{id}', [GamifikasiController::class, 'detailQuest'])->name('users.detail-quest');
        Route::delete('/hapus-quest/{id}', [GamifikasiController::class, 'hapusQuest'])->name('users.hapus-quest');
        // Riwayat Transaksi Poin
        Route::get('/riwayat-reward', [HistoryTransaksiController::class, 'riwayatRewardUser'])->name('users.riwayat-reward');
        // Riwayat Transaksi Setoran Sampah
        Route::get('/riwayat-setor-sampah', [HistoryTransaksiController::class, 'riwayatSetorSampahUser'])->name('users.riwayat-setor-sampah');
        // Tukar Poin
        Route::get('/penukaran-poin', [ItemController::class, 'index'])->name('users.penukaran-poin');
        Route::get('/riwayat-tukar-poin', [HistoryTransaksiController::class, 'riwayatTukarPoinUser'])->name('users.riwayat-tukar-poin');
    });
});

require __DIR__ . '/auth.php';
