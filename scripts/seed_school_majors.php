<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$majors = [
    ['name' => 'TK', 'quota' => 0, 'status' => 'Aktif'],
    ['name' => 'SD', 'quota' => 0, 'status' => 'Aktif'],
    ['name' => 'SMP', 'quota' => 0, 'status' => 'Aktif'],
    ['name' => 'SMA', 'quota' => 0, 'status' => 'Aktif'],
    ['name' => 'SMK', 'quota' => 0, 'status' => 'Aktif'],
];

foreach ($majors as $major) {
    App\Models\SchoolMajor::updateOrCreate(
        ['name' => $major['name']],
        $major
    );
}
