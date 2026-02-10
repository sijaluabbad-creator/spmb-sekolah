<?php

namespace App\Http\Controllers;

use App\Models\SchoolLevelSetting;
use Illuminate\Http\Request;

class SchoolLevelSettingController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'academic_year' => 'required|string|max:20',
            'semester' => 'required|in:ganjil,genap',
            'levels' => 'nullable|array',
            'levels.*' => 'in:PAUD,SD,SMP,SMA,SMK',
        ]);

        $activeLevels = $data['levels'] ?? [];
        $allLevels = ['PAUD', 'SD', 'SMP', 'SMA', 'SMK'];

        foreach ($allLevels as $level) {
            SchoolLevelSetting::updateOrCreate(
                ['level' => $level],
                [
                    'is_active' => in_array($level, $activeLevels, true),
                    'academic_year' => $data['academic_year'],
                    'semester' => $data['semester'],
                ]
            );
        }

        return back()->with('status', 'Pengaturan jenjang berhasil disimpan.');
    }
}
