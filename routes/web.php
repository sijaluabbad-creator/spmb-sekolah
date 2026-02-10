<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolContactController;
use App\Http\Controllers\SchoolLevelSettingController;
use App\Http\Controllers\SchoolMajorController;
use App\Http\Controllers\SchoolProfileController;
use App\Http\Controllers\SchoolScheduleController;
use App\Http\Controllers\RegistrationController;
use App\Models\SchoolContact;
use App\Models\SchoolLevelSetting;
use App\Models\SchoolProfile;
use App\Models\SchoolSchedule;
use App\Models\SchoolMajor;
use Illuminate\Support\Facades\Route;

if (!function_exists('getDailyReports')) {
    function getDailyReports(): array
    {
        return [
            [
                'date' => '14 Mei 2026',
                'registrants' => 0,
                'verified' => 0,
                'rejected' => 0,
                'note' => 'Belum ada data.',
            ],
            [
                'date' => '13 Mei 2026',
                'registrants' => 0,
                'verified' => 0,
                'rejected' => 0,
                'note' => 'Belum ada data.',
            ],
            [
                'date' => '12 Mei 2026',
                'registrants' => 0,
                'verified' => 0,
                'rejected' => 0,
                'note' => 'Belum ada data.',
            ],
        ];
    }
}

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
    return view('welcome', [
        'schedules' => SchoolSchedule::orderBy('start_date')->get(),
        'schoolProfile' => SchoolProfile::first(),
        'totalQuota' => (int) SchoolMajor::sum('quota'),
    ]);
});

Route::get('/registrasi', function () {
    return view('registrasi');
})->name('registrasi');

Route::post('/registrasi', [RegistrationController::class, 'store'])->name('registrasi.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin', function () {
        return view('admin.dashboard', [
            'dailyReports' => getDailyReports(),
            'schoolProfile' => SchoolProfile::first(),
            'schoolContact' => SchoolContact::first(),
            'levelSettings' => SchoolLevelSetting::whereIn('level', ['PAUD', 'SD', 'SMP', 'SMA', 'SMK'])->get(),
        ]);
    })->middleware('admin')->name('admin.dashboard');

    Route::get('/admin/registrasi', [RegistrationController::class, 'index'])
        ->middleware('admin')
        ->name('admin.registrations');

    Route::get('/admin/sekolah/profil', [SchoolProfileController::class, 'edit'])
        ->middleware('admin')
        ->name('admin.school.profile');

    Route::post('/admin/sekolah/profil', [SchoolProfileController::class, 'updateInfo'])
        ->middleware('admin')
        ->name('admin.school.profile.update');

    Route::post('/admin/sekolah/profil/kepala', [SchoolProfileController::class, 'updatePrincipal'])
        ->middleware('admin')
        ->name('admin.school.profile.principal');

    Route::post('/admin/sekolah/profil/logo', [SchoolProfileController::class, 'uploadLogo'])
        ->middleware('admin')
        ->name('admin.school.profile.logo');

    Route::post('/admin/sekolah/profil/password', [SchoolProfileController::class, 'updatePassword'])
        ->middleware('admin')
        ->name('admin.school.profile.password');

    Route::get('/admin/sekolah/jurusan', [SchoolMajorController::class, 'index'])
        ->middleware('admin')
        ->name('admin.school.majors');

    Route::post('/admin/sekolah/jurusan', [SchoolMajorController::class, 'store'])
        ->middleware('admin')
        ->name('admin.school.majors.store');

    Route::post('/admin/sekolah/jurusan/{major}', [SchoolMajorController::class, 'update'])
        ->middleware('admin')
        ->name('admin.school.majors.update');

    Route::get('/admin/sekolah/kontak', [SchoolContactController::class, 'edit'])
        ->middleware('admin')
        ->name('admin.school.contact');

    Route::post('/admin/sekolah/kontak', [SchoolContactController::class, 'update'])
        ->middleware('admin')
        ->name('admin.school.contact.update');

    Route::get('/admin/sekolah/jadwal', [SchoolScheduleController::class, 'index'])
        ->middleware('admin')
        ->name('admin.school.schedule');

    Route::post('/admin/sekolah/jadwal', [SchoolScheduleController::class, 'store'])
        ->middleware('admin')
        ->name('admin.school.schedule.store');

    Route::post('/admin/sekolah/jenjang', [SchoolLevelSettingController::class, 'update'])
        ->middleware('admin')
        ->name('admin.school.level-settings.update');

    Route::post('/admin/sekolah/jadwal/{schedule}/update', [SchoolScheduleController::class, 'update'])
        ->middleware('admin')
        ->name('admin.school.schedule.update');

    Route::post('/admin/sekolah/jadwal/{schedule}/delete', [SchoolScheduleController::class, 'destroy'])
        ->middleware('admin')
        ->name('admin.school.schedule.delete');

    Route::get('/admin/rekap/export', function () {
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, ['Tanggal', 'Pendaftar', 'Terverifikasi', 'Ditolak', 'Catatan']);

        foreach (getDailyReports() as $report) {
            fputcsv($handle, [
                $report['date'],
                $report['registrants'],
                $report['verified'],
                $report['rejected'],
                $report['note'],
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="rekap-laporan-harian.csv"',
        ]);
    })->middleware('admin')->name('admin.daily-report.export');

    Route::get('/admin/rekap/print', function () {
        return view('admin.daily-report-print', [
            'dailyReports' => getDailyReports(),
        ]);
    })->middleware('admin')->name('admin.daily-report.print');
});
