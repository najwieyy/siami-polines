<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeriodeAuditController;
use App\Http\Controllers\JadwalAuditController;
use App\Http\Controllers\DaftarTilikController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\DataInstrumenController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Livewire\PeriodeAudit;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
});

// route register
// Route::get('/register', [RegisterController::class, 'index'])->name('register');

// route login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Route untuk Admin dengan prefix 'admin'
Route::prefix('admin')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    });

    // Route::get('/periode-audit', PeriodeAudit::class)->name('periode-audit.index');


    // Periode Audit
    Route::prefix('periode-audit')->group(function () {
        Route::get('/', [PeriodeAuditController::class, 'index'])->name('periode-audit.index');
        Route::get('/create', [PeriodeAuditController::class, 'create'])->name('periode-audit.create');
        Route::post('/', [PeriodeAuditController::class, 'store'])->name('periode-audit.store');
        Route::get('/{id}/edit', [PeriodeAuditController::class, 'edit'])->name('periode-audit.edit');
        Route::put('/{id}', [PeriodeAuditController::class, 'update'])->name('periode-audit.update');
        Route::delete('/{id}', [PeriodeAuditController::class, 'destroy'])->name('periode-audit.destroy');
        Route::patch('/{id}/close', [PeriodeAuditController::class, 'close'])->name('periode-audit.close');
    });

    // Jadwal Audit
    Route::prefix('jadwal-audit')->group(function () {
        Route::get('/', [JadwalAuditController::class, 'index'])->name('jadwal-audit.index');
        Route::get('/create', [JadwalAuditController::class, 'create'])->name('jadwal-audit.create'); // Route untuk halaman form
        Route::post('/store', [JadwalAuditController::class, 'makeJadwalAudit'])->name('jadwal-audit.store'); // Route untuk menyimpan data
        Route::delete('/{id}', [JadwalAuditController::class, 'destroy'])->name('jadwal-audit.destroy');
        Route::post('/reset', [JadwalAuditController::class, 'reset'])->name('jadwal-audit.reset');
        Route::get('/download', [JadwalAuditController::class, 'download'])->name('jadwal-audit.download');
    });

    // Daftar Tilik
    Route::prefix('daftar-tilik')->group(function () {
        Route::get('/', [DaftarTilikController::class, 'index'])->name('daftar-tilik.index');
    });

    // Data Unit (Unit Kerja)
    Route::prefix('unit-kerja')->group(function () {
        // Route::get('/', [UnitKerjaController::class, 'index'])->name('unit-kerja.index');
        Route::get('/create/{type?}', [UnitKerjaController::class, 'create'])->name('unit-kerja.create');
        Route::get('/{id}/edit/{type?}', [UnitKerjaController::class, 'edit'])->name('unit-kerja.edit');
        Route::post('/', [UnitKerjaController::class, 'store'])->name('unit-kerja.store');
        Route::put('/{id}', [UnitKerjaController::class, 'update'])->name('unit-kerja.update');
        Route::delete('/{id}', [UnitKerjaController::class, 'destroy'])->name('unit-kerja.destroy');

        // TARUH PALING BAWAH
        Route::get('/{type?}', [UnitKerjaController::class, 'index'])->name('unit-kerja.index');

        // Route::get('/', [UnitKerjaController::class, 'index'])->name('unit-kerja.index');
        // Route::get('/', [UnitKerjaController::class, 'index'])->name('unit-kerja.prodi');
        // Route::get('/', [UnitKerjaController::class, 'index'])->name('unit-kerja.jurusan');
    });

    // // Data Instrumen
    Route::prefix('data-instrumen')->group(function () {
        Route::get('/{type?}', [DataInstrumenController::class, 'index'])->name('data-instrumen.index');
        // Route::get('/', [InstrumenUptController::class, 'index'])->name('instrumen-upt.index');
        // Route::get('/create', [InstrumenUptController::class, 'create'])->name('instrumen-upt.create');
        // Route::post('/', [InstrumenUptController::class, 'store'])->name('instrumen-upt.store');
        // Route::get('/{id}/edit', [InstrumenUptController::class, 'edit'])->name('instrumen-upt.edit');
        // Route::put('/{id}', [InstrumenUptController::class, 'update'])->name('instrumen-upt.update');
        // Route::delete('/{id}', [InstrumenUptController::class, 'destroy'])->name('instrumen-upt.destroy');
        // Route::post('/import', [InstrumenUptController::class, 'import'])->name('instrumen-upt.import');
        // Route::get('/export', [InstrumenUptController::class, 'export'])->name('instrumen-upt.export');
    });


    // Data User
    Route::prefix('data-user')->group(function () {
        Route::get('/', [DataUserController::class, 'index'])->name('data-user.index');
        Route::get('/create', [DataUserController::class, 'create'])->name('data-user.create');
        Route::post('/', [DataUserController::class, 'store'])->name('data-user.store');
        Route::get('/{id}/edit', [DataUserController::class, 'edit'])->name('data-user.edit');
        Route::put('/{id}', [DataUserController::class, 'update'])->name('data-user.update');
        Route::delete('/{id}', [DataUserController::class, 'destroy'])->name('data-user.destroy');
        Route::delete('data-user/bulk-delete', [DataUserController::class, 'bulkDelete'])->name('data-user.bulk-delete');
    });

    // Laporan
    Route::prefix('laporan')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
    });
});

// Route untuk Logout
Route::get('/logout', function () {
    // Logika logout (misalnya menggunakan Auth::logout())
    return redirect('/login');
})->name('logout');

//route jadwal
Route::get('jadwal-audit/create', [JadwalAuditController::class, 'create'])->name('jadwal-audit.create');

Route::get('jadwal-audit/download', [JadwalAuditController::class, 'download'])->name('jadwal-audit.download');

Route::post('jadwal-audit/reset', [JadwalAuditController::class, 'reset'])->name('jadwal-audit.reset');


Route::get('jadwal-audit/{id}/edit', [JadwalAuditController::class, 'edit'])->name('jadwal-audit.edit');
Route::put('/jadwal-audit/{id}', [JadwalAuditController::class, 'update'])->name('jadwal-audit.update');

Route::delete('/jadwal-audit/{id}', [JadwalAuditController::class, 'destroy'])->name('jadwal-audit.destroy');

Route::prefix('auditor')->group(function () {
    Route::get('/dashboard', function () {return view('auditor.dashboard.index');})->name('auditor.dashboard.index');
    Route::get('/daftar-tilik', function () {return view('auditor.daftar-tilik.index');})->name('auditor.daftar-tilik.index');
    Route::get('/assesmen-lapangan', function () {return view('auditor.assesmen-lapangan.index');})->name('auditor.assesmen-lapangan.index');
    Route::get('/data-instrumen', function () {return view('auditor.data-instrumen.index');})->name('auditor.data-instrumen.index');
    Route::get('/laporan', function () {return view('auditor.laporan.index');})->name('auditor.laporan.index');
    Route::get('/ptpp', function () {return view('auditor.ptpp.index');})->name('auditor.ptpp.index');
});


