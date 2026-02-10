<?php

namespace App\Http\Controllers;

use App\Models\SchoolContact;
use Illuminate\Http\Request;

class SchoolContactController extends Controller
{
    public function edit()
    {
        $contact = SchoolContact::firstOrCreate([]);

        return view('admin.school-contact', [
            'contact' => $contact,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:1000',
            'coordinate' => 'nullable|string|max:255',
            'maps_link' => 'nullable|string|max:255',
            'operational_hours' => 'nullable|string|max:255',
        ]);

        $contact = SchoolContact::firstOrCreate([]);
        $contact->fill($data);
        $contact->save();

        return back()->withInput()->with('status', 'Kontak & lokasi berhasil disimpan.');
    }
}
