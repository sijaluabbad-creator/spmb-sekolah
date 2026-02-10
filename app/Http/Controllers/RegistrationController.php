<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function index()
    {
        $query = request('q');

        return view('admin.registrations', [
            'registrations' => Registration::when($query, function ($builder) use ($query) {
                $builder->where(function ($inner) use ($query) {
                    $inner->where('student_name', 'like', "%{$query}%")
                        ->orWhere('nisn', 'like', "%{$query}%")
                        ->orWhere('parent_name', 'like', "%{$query}%")
                        ->orWhere('parent_phone', 'like', "%{$query}%")
                        ->orWhere('level', 'like', "%{$query}%");
                });
            })->latest()->get(),
            'query' => $query,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_name' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:50',
            'birth_date' => 'required|date',
            'level' => 'required|in:PAUD,SD,SMP,SMA,SMK',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:50',
            'address' => 'required|string|max:1000',
            'birth_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'family_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'mother_id' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $registration = Registration::create($data);

        $uploads = [
            'birth_certificate' => 'birth_certificate_path',
            'family_card' => 'family_card_path',
            'mother_id' => 'mother_id_path',
            'photo' => 'photo_path',
        ];

        foreach ($uploads as $input => $column) {
            if ($request->hasFile($input)) {
                $path = $request->file($input)->store('registrations', 'public');
                $registration->{$column} = $path;
            }
        }

        if ($registration->isDirty()) {
            $registration->save();
        }

        $adminPhone = SchoolProfile::first()?->school_contact;
        $normalized = $adminPhone ? preg_replace('/\D+/', '', $adminPhone) : '';

        if ($normalized && str_starts_with($normalized, '0')) {
            $normalized = '62' . substr($normalized, 1);
        }

        if ($normalized) {
            $message = "Registrasi Baru | "
                . "Nama: {$registration->student_name} | "
                . "NISN: " . ($registration->nisn ?: '-') . " | "
                . "Jenjang: {$registration->level} "
                . "Sudah dicatat. Terima Kasih";

            return redirect()->away('https://wa.me/' . $normalized . '?text=' . rawurlencode($message));
        }

        return back()->with('status', 'Registrasi berhasil dikirim. Nomor WhatsApp admin belum tersedia.');
    }
}
