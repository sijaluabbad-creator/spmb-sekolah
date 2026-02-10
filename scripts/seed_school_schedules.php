<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$items = [
    [
        'activity' => 'Pendaftaran Gelombang 1',
        'start_date' => '2026-06-01',
        'end_date' => '2026-06-15',
        'note' => 'Pembukaan pendaftaran tahap awal.',
    ],
    [
        'activity' => 'Verifikasi Berkas',
        'start_date' => '2026-06-16',
        'end_date' => '2026-06-25',
        'note' => 'Verifikasi dokumen oleh panitia.',
    ],
    [
        'activity' => 'Pengumuman Hasil',
        'start_date' => '2026-06-30',
        'end_date' => null,
        'note' => 'Pengumuman hasil seleksi.',
    ],
];

foreach ($items as $item) {
    App\Models\SchoolSchedule::updateOrCreate(
        ['activity' => $item['activity'], 'start_date' => $item['start_date']],
        $item
    );
}
