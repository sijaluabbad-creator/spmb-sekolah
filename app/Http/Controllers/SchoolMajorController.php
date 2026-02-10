<?php

namespace App\Http\Controllers;

use App\Models\SchoolMajor;
use Illuminate\Http\Request;

class SchoolMajorController extends Controller
{
    public function index()
    {
        return view('admin.school-majors', [
            'majors' => SchoolMajor::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'quota' => 'nullable|integer|min:0',
            'status' => 'nullable|string|max:50',
        ]);

        SchoolMajor::create($data);

        return back()->with('status', 'Jurusan berhasil ditambahkan.');
    }

    public function update(Request $request, SchoolMajor $major)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'quota' => 'nullable|integer|min:0',
            'status' => 'nullable|string|max:50',
        ]);

        $major->update($data);

        return back()->with('status', 'Perubahan jurusan berhasil disimpan.');
    }
}
