<?php

namespace App\Http\Controllers;

use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function edit()
    {
        $profile = SchoolProfile::firstOrCreate([]);

        return view('admin.school-profile', [
            'profile' => $profile,
        ]);
    }

    public function updateInfo(Request $request)
    {
        $data = $request->validate([
            'school_name' => 'nullable|string|max:255',
            'school_npsn' => 'nullable|string|max:255',
            'school_accreditation' => 'nullable|string|max:255',
            'school_contact' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $profile = SchoolProfile::firstOrCreate([]);
        $profile->fill($data);
        $profile->save();

        return back()->withInput()->with('status', 'Profil sekolah berhasil disimpan.');
    }

    public function updatePrincipal(Request $request)
    {
        $data = $request->validate([
            'principal_name' => 'nullable|string|max:255',
            'principal_id' => 'nullable|string|max:255',
        ]);

        $profile = SchoolProfile::firstOrCreate([]);
        $profile->fill($data);
        $profile->save();

        return back()->withInput()->with('status', 'Data kepala sekolah berhasil disimpan.');
    }

    public function uploadLogo(Request $request)
    {
        $data = $request->validate([
            'logo' => 'required|image|max:2048',
        ]);

        $profile = SchoolProfile::firstOrCreate([]);

        if ($profile->logo_path) {
            Storage::disk('public')->delete($profile->logo_path);
        }

        $path = $data['logo']->store('school-logos', 'public');
        $profile->logo_path = $path;
        $profile->save();

        return back()->withInput()->with('status', 'Logo sekolah berhasil diunggah.');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = $data['password'];
        $user->save();

        return back()->with('status', 'Password berhasil diperbarui.');
    }
}
