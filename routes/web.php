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
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Models\KategoriSampah;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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

// Route::get('/admin-show-item', function () {
//     return view('admin.item.show');
// })->name('admin-show-item');
// Route::get('/user-trans-detail', function () {
//     return view('users.detail_transaksi_tukar_poin');
// })->name('user-trans-detail');
// Route::get('/user-checkout', function () {
//     return view('users.checkout');
// })->name('user-checkout');
// Route::get('/admin-create-kategori', function () {
//     return view('admin.kategori.create');
// })->name('admin-create-kategori');
// Route::get('/admin-create-quest', function () {
//     return view('admin.quest.create');
// })->name('admin-create-quest');
// Route::get('/admin-edit-quest/{id}', function ($id) {
//     $quest = \App\Models\Quest::find($id); // Ambil data quest yang id nya 1
//     return view('admin.quest.edit', ['quest' => $quest]);
// })->name('admin-edit-quest');
// Route::get('/admin-show-quest/{id}', function ($id) {
//     $quest = \App\Models\Quest::find($id); // Ambil data quest yang id nya 1
//     return view('admin.quest.show', ['quest' => $quest]);
// })->name('admin-show-quest');

// Route::get('/admin-role-show/{id}', function ($id) {
//     $role = Role::findOrFail($id);

//     return view('admin.role.show', compact('role'));
// })->name('admin-dashboard');
// Route::get('/admin-role-index', function () {
//     $listRole = Role::all();

//     return view('admin.role.index', compact('listRole'));
// })->name('admin-role-index');
// Route::get('/admin-role-edit/{id}', function ($id) {
//     $role = Role::findOrFail($id);
//     // Ambil semua permissions yang tersedia
//     $permissions = Permission::all();
//     // Ambil ID permissions yang sudah dimiliki role
//     $rolePermissions = $role->permissions->pluck('id')->toArray();

//     return view('admin.role.edit', compact('role', 'permissions', 'rolePermissions'));
// })->name('admin-role-edit');

// Route::get('/admin-show-kategori/{id}', function ($id) {
//     $kategori = KategoriSampah::findOrFail($id);
//     return view('admin.kategori.show', ['kategori' => $kategori]);
// })->name('admin-show-kategori');

Route::get('/admin-user-create', function () {
    $listRole = Role::all();
    return view('admin.user.create', compact('listRole'));
})->name('admin-user-create');
Route::get('/admin-user-edit/{id}', function ($id) {
    $user = User::findOrFail($id);
    $listRole = Role::all();

    return view('admin.user.edit', compact('user', 'listRole'));
})->name('admin-user-create');
Route::get('/admin-user-show/{id}', function ($id) {
    $user = User::findOrFail($id);
    $listRole = Role::all();

    return view('admin.user.show', compact('user', 'listRole'));
})->name('admin-user-show');
Route::get('/admin-user-control', function () {
    $listUser = User::paginate(2);
    return view('admin.user.index', compact('listUser'));
})->name('admin-user-control');


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

    // Belum implement ke viewnya aja
    Route::middleware(['verified'])->group(function () {
        Route::resource('item', ItemController::class);
        Route::resource('kategori-sampah', KategoriSampahController::class);
        Route::resource('penukaran-poin', PenukaranPoinController::class);
        Route::resource('quest', QuestController::class);
        Route::resource('role', RoleController::class);
        Route::resource('kelola-pengguna', UserController::class);
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
        Route::get('/kategori-sampah', [KategoriSampahController::class, 'index'])->name('users.kategori-sampah');
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
