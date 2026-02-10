<?php

namespace App\Http\Controllers;

use App\Models\SchoolSchedule;
use Illuminate\Http\Request;

class SchoolScheduleController extends Controller
{
    public function index()
    {
        return view('admin.school-schedule', [
            'schedules' => SchoolSchedule::orderBy('start_date')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'activity' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'note' => 'nullable|string|max:255',
        ]);

        SchoolSchedule::create($data);

        return back()->with('status', 'Jadwal berhasil ditambahkan.');
    }

    public function update(Request $request, SchoolSchedule $schedule)
    {
        $data = $request->validate([
            'activity' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'note' => 'nullable|string|max:255',
        ]);

        $schedule->update($data);

        return back()->with('status', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(SchoolSchedule $schedule)
    {
        $schedule->delete();

        return back()->with('status', 'Jadwal berhasil dihapus.');
    }
}
