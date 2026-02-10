<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin - SPMB</title>
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                background: #0f1f1b;
                color: #ffffff;
                padding: 32px;
            }

            .layout {
                max-width: 1000px;
                margin: 0 auto;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 18px;
            }

            .card {
                background: #162a24;
                border-radius: 16px;
                padding: 24px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            }

            h1 {
                margin-top: 0;
                color: #caa352;
            }

            form {
                margin-top: 16px;
            }

            button {
                padding: 10px 16px;
                border: none;
                border-radius: 8px;
                background: #caa352;
                color: #0f1f1b;
                cursor: pointer;
                font-weight: 600;
            }

            button:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            .action-btn {
                padding: 6px 12px;
                font-size: 12px;
            }

            .action-btn.secondary {
                background: rgba(255, 255, 255, 0.12);
                color: #ffffff;
            }

            .card-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                gap: 16px;
                flex-wrap: wrap;
            }

            .toolbar {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
            }

            .timeline {
                position: relative;
                padding-left: 22px;
            }

            .timeline::before {
                content: "";
                position: absolute;
                left: 8px;
                top: 4px;
                bottom: 4px;
                width: 2px;
                background: rgba(255, 255, 255, 0.12);
            }

            .timeline-item {
                position: relative;
                padding: 6px 0 6px 0;
            }

            .timeline-item::before {
                content: "";
                position: absolute;
                left: -14px;
                top: 12px;
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.12);
                border: 2px solid rgba(255, 255, 255, 0.24);
            }

            .timeline-item.approved::before {
                background: #caa352;
                border-color: rgba(202, 163, 82, 0.6);
            }

            .timeline-item.pending::before {
                background: rgba(255, 255, 255, 0.3);
                border-color: rgba(255, 255, 255, 0.5);
            }

            .timeline-item.review::before {
                background: #2a8f75;
                border-color: rgba(42, 143, 117, 0.6);
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                padding: 10px 16px;
                border-radius: 8px;
                background: #caa352;
                color: #0f1f1b;
                text-decoration: none;
                font-weight: 600;
            }

            .btn.secondary {
                background: rgba(255, 255, 255, 0.12);
                color: #ffffff;
            }

            .section {
                margin-top: 24px;
            }

            .summary-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }

            @media (max-width: 900px) {
                .summary-grid {
                    grid-template-columns: 1fr;
                }
            }

            .summary-card {
                background: rgba(255, 255, 255, 0.04);
                border-radius: 12px;
                padding: 16px;
            }

            .manage-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
                margin-top: 16px;
            }

            .manage-card {
                background: rgba(255, 255, 255, 0.04);
                border-radius: 12px;
                padding: 16px;
            }

            .toggle-group {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                margin-top: 8px;
            }

            .toggle-input {
                position: absolute;
                opacity: 0;
                pointer-events: none;
            }

            .toggle-label {
                padding: 8px 12px;
                border-radius: 999px;
                border: 1px solid rgba(255, 255, 255, 0.2);
                background: rgba(255, 255, 255, 0.08);
                color: rgba(255, 255, 255, 0.8);
                font-size: 12px;
                font-weight: 600;
                cursor: pointer;
                display: inline-flex;
                align-items: center;
            }

            .toggle-input:checked + .toggle-label {
                background: rgba(202, 163, 82, 0.2);
                border-color: rgba(202, 163, 82, 0.6);
                color: #f6d79c;
            }

            .control-field {
                margin-top: 12px;
            }

            .control-field label {
                display: block;
                font-size: 12px;
                color: rgba(255, 255, 255, 0.7);
                margin-bottom: 6px;
                letter-spacing: 0.3px;
                text-transform: uppercase;
            }

            .control-field select {
                width: 100%;
                padding: 8px 10px;
                border-radius: 8px;
                border: 1px solid rgba(255, 255, 255, 0.12);
                background: rgba(255, 255, 255, 0.06);
                color: #ffffff;
                font-size: 12px;
            }

            .form-message {
                margin-top: 12px;
                padding: 10px 12px;
                border-radius: 10px;
                font-size: 12px;
            }

            .form-message.success {
                background: rgba(202, 163, 82, 0.16);
                color: #f6d79c;
            }

            .form-message.error {
                background: rgba(160, 60, 60, 0.2);
                color: #f4b6b6;
            }

            @media (max-width: 900px) {
                .manage-grid {
                    grid-template-columns: 1fr;
                }
            }

            .summary-card table {
                margin-top: 8px;
                font-size: 12px;
            }

            .summary-card th,
            .summary-card td {
                padding: 6px 8px;
            }

            .summary-card .status {
                padding: 2px 8px;
                font-size: 11px;
            }

            .summary-card .action-btn {
                padding: 4px 8px;
                font-size: 11px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 12px;
                font-size: 12px;
            }

            th,
            td {
                text-align: left;
                padding: 6px 8px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            }

            th {
                color: rgba(255, 255, 255, 0.7);
                font-weight: 600;
                font-size: 13px;
                letter-spacing: 0.4px;
                text-transform: uppercase;
            }

            .status {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 4px 10px;
                border-radius: 999px;
                font-size: 12px;
                font-weight: 600;
                background: rgba(255, 255, 255, 0.12);
                color: #ffffff;
            }

            .status.approved {
                background: rgba(202, 163, 82, 0.2);
                color: #f6d79c;
            }

            .status.pending {
                background: rgba(255, 255, 255, 0.12);
                color: #ffffff;
            }

            .status.review {
                background: rgba(15, 107, 89, 0.35);
                color: #bfe6db;
            }

            .sidebar {
                width: min(420px, 100%);
            }
        </style>
    </head>
    <body>
        <div class="layout">
            <div class="card" style="width: 100%;">
                <h1>Halaman Admin</h1>
                <p>Selamat datang, {{ auth()->user()->name }}. Anda memiliki akses administrator.</p>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>

            <div class="card" style="width: 100%;">
                <div class="section" style="margin-top: 0;">
                    <h2>Manajemen Sekolah</h2>
                    <p style="color: rgba(255, 255, 255, 0.7); margin-top: -6px;">
                        Pengelolaan profil sekolah, jurusan, dan data pendukung.
                    </p>
                    <div style="margin-top: 12px;">
                        <a href="{{ route('admin.registrations') }}" class="btn secondary">Lihat Registrasi</a>
                    </div>
                    @php
                        $profileComplete = $schoolProfile
                            && ($schoolProfile->school_name
                                || $schoolProfile->school_npsn
                                || $schoolProfile->school_accreditation
                                || $schoolProfile->school_contact
                                || $schoolProfile->address);
                        $profileStatus = $profileComplete ? 'Lengkap' : 'Belum ada data';
                        $profileStatusClass = $profileComplete ? 'approved' : 'pending';
                        $profileCreated = $schoolProfile && $schoolProfile->created_at
                            ? $schoolProfile->created_at->format('d M Y')
                            : '0';
                        $profileUpdated = $schoolProfile && $schoolProfile->updated_at
                            ? $schoolProfile->updated_at->format('d M Y')
                            : '0';
                    @endphp
                    @php
                        $contactComplete = $schoolContact
                            && ($schoolContact->phone
                                || $schoolContact->email
                                || $schoolContact->website
                                || $schoolContact->instagram
                                || $schoolContact->address
                                || $schoolContact->coordinate
                                || $schoolContact->maps_link
                                || $schoolContact->operational_hours);
                        $contactCreated = $schoolContact && $schoolContact->created_at
                            ? $schoolContact->created_at->format('d M Y')
                            : '0';
                        $contactUpdated = $schoolContact && $schoolContact->updated_at
                            ? $schoolContact->updated_at->format('d M Y')
                            : '0';
                    @endphp
                    <table>
                        <thead>
                            <tr>
                                <th>Unit</th>
                                <th>Timeline</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="manage-grid">
                        <div class="manage-card">
                            <h3 style="margin: 0 0 8px; font-size: 16px; color: rgba(255, 255, 255, 0.85);">
                                Profil Sekolah
                            </h3>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Unit</th>
                                        <th>Timeline</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Profil Sekolah</td>
                                        <td>
                                            <div class="timeline">
                                                <div class="timeline-item pending">
                                                    <div style="color: rgba(255, 255, 255, 0.8); font-weight: 600;">
                                                        Dibuat
                                                    </div>
                                                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">
                                                        {{ $profileCreated }}
                                                    </div>
                                                </div>
                                                <div class="timeline-item {{ $profileStatusClass }}">
                                                    <div style="color: rgba(255, 255, 255, 0.8); font-weight: 600;">
                                                        Diperbarui
                                                    </div>
                                                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">
                                                        {{ $profileUpdated }}
                                                    </div>
                                                </div>
                                                <div class="timeline-item {{ $profileStatusClass }}">
                                                    <div style="color: rgba(255, 255, 255, 0.8); font-weight: 600;">
                                                        Divalidasi
                                                    </div>
                                                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">
                                                        {{ $profileComplete ? 'Siap' : 'Belum' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.school.profile') }}" class="btn">Kelola</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="manage-card">
                            <h3 style="margin: 0 0 8px; font-size: 16px; color: rgba(255, 255, 255, 0.85);">
                                Jenjang /Jurusan / Kuota
                            </h3>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Unit</th>
                                        <th>Timeline</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Jenjang /Jurusan / Kuota</td>
                                        <td>
                                            <div class="timeline">
                                                <div class="timeline-item pending">
                                                    <div style="color: rgba(255, 255, 255, 0.8); font-weight: 600;">
                                                        Dibuat
                                                    </div>
                                                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">
                                                        10 Mei 2026
                                                    </div>
                                                </div>
                                                <div class="timeline-item review">
                                                    <div style="color: rgba(255, 255, 255, 0.8); font-weight: 600;">
                                                        Diperbarui
                                                    </div>
                                                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">
                                                        10 Mei 2026
                                                    </div>
                                                </div>
                                                <div class="timeline-item review">
                                                    <div style="color: rgba(255, 255, 255, 0.8); font-weight: 600;">
                                                        Divalidasi
                                                    </div>
                                                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">
                                                        Menunggu
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.school.majors') }}" class="btn">Kelola</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="manage-card">
                            <h3 style="margin: 0 0 8px; font-size: 16px; color: rgba(255, 255, 255, 0.85);">
                                Jalur Pengaktifan Jenjang
                            </h3>
                            @php
                                $levelMap = ['PAUD', 'SD', 'SMP', 'SMA', 'SMK'];
                                $levelByKey = $levelSettings->keyBy('level');
                                $levelConfig = $levelSettings->first();
                                $selectedYear = old('academic_year', $levelConfig->academic_year ?? '2026-2027');
                                $selectedSemester = old('semester', $levelConfig->semester ?? 'ganjil');
                                $selectedLevels = old('levels', []);
                            @endphp
                            <form method="post" action="{{ route('admin.school.level-settings.update') }}">
                                @csrf
                                @if (session('status'))
                                    <div class="form-message success">{{ session('status') }}</div>
                                @endif
                                @if ($errors->any())
                                    <div class="form-message error">
                                        <strong>Periksa kembali input Anda:</strong>
                                        <ul style="margin: 8px 0 0; padding-left: 18px;">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="toggle-group">
                                    @foreach ($levelMap as $level)
                                        @php
                                            $isActive = $levelByKey->get($level)?->is_active;
                                            $isChecked = in_array($level, $selectedLevels, true) || (!$selectedLevels && $isActive);
                                        @endphp
                                        <input
                                            type="checkbox"
                                            class="toggle-input"
                                            id="level-{{ strtolower($level) }}"
                                            name="levels[]"
                                            value="{{ $level }}"
                                            {{ $isChecked ? 'checked' : '' }}
                                        >
                                        <label class="toggle-label" for="level-{{ strtolower($level) }}">
                                            {{ $level }}
                                        </label>
                                    @endforeach
                                </div>
                                <div class="control-field">
                                    <label for="academic-year">Tahun Pelajaran</label>
                                    <select id="academic-year" name="academic_year">
                                        <option value="2025-2026" {{ $selectedYear === '2025-2026' ? 'selected' : '' }}>2025/2026</option>
                                        <option value="2026-2027" {{ $selectedYear === '2026-2027' ? 'selected' : '' }}>2026/2027</option>
                                        <option value="2027-2028" {{ $selectedYear === '2027-2028' ? 'selected' : '' }}>2027/2028</option>
                                    </select>
                                </div>
                                <div class="control-field">
                                    <label for="semester">Semester</label>
                                    <select id="semester" name="semester">
                                        <option value="ganjil" {{ $selectedSemester === 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                                        <option value="genap" {{ $selectedSemester === 'genap' ? 'selected' : '' }}>Genap</option>
                                    </select>
                                </div>
                                <div class="control-field">
                                    <button type="submit" class="btn">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <div class="manage-card">
                            <h3 style="margin: 0 0 8px; font-size: 16px; color: rgba(255, 255, 255, 0.85);">
                                Kontak & Lokasi
                            </h3>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Unit</th>
                                        <th>Timeline</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Kontak & Lokasi</td>
                                        <td>
                                            <div class="timeline">
                                                <div class="timeline-item pending">
                                                    <div style="color: rgba(255, 255, 255, 0.8); font-weight: 600;">
                                                        Dibuat
                                                    </div>
                                                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">
                                                        {{ $contactCreated }}
                                                    </div>
                                                </div>
                                                <div class="timeline-item {{ $contactComplete ? 'approved' : 'pending' }}">
                                                    <div style="color: rgba(255, 255, 255, 0.8); font-weight: 600;">
                                                        Diperbarui
                                                    </div>
                                                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">
                                                        {{ $contactUpdated }}
                                                    </div>
                                                </div>
                                                <div class="timeline-item {{ $contactComplete ? 'approved' : 'pending' }}">
                                                    <div style="color: rgba(255, 255, 255, 0.8); font-weight: 600;">
                                                        Divalidasi
                                                    </div>
                                                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">
                                                        {{ $contactComplete ? 'Siap' : 'Belum' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.school.contact') }}" class="btn">Kelola</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="manage-card">
                            <h3 style="margin: 0 0 8px; font-size: 16px; color: rgba(255, 255, 255, 0.85);">
                                Jadwal
                            </h3>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Unit</th>
                                        <th>Timeline</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Jadwal</td>
                                        <td>
                                            <div class="timeline">
                                                <div class="timeline-item pending">
                                                    <div style="color: rgba(255, 255, 255, 0.8); font-weight: 600;">
                                                        Dibuat
                                                    </div>
                                                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">
                                                        0
                                                    </div>
                                                </div>
                                                <div class="timeline-item pending">
                                                    <div style="color: rgba(255, 255, 255, 0.8); font-weight: 600;">
                                                        Diperbarui
                                                    </div>
                                                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">
                                                        0
                                                    </div>
                                                </div>
                                                <div class="timeline-item pending">
                                                    <div style="color: rgba(255, 255, 255, 0.8); font-weight: 600;">
                                                        Divalidasi
                                                    </div>
                                                    <div style="color: rgba(255, 255, 255, 0.6); font-size: 12px;">
                                                        Belum
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.school.schedule') }}" class="btn">Kelola</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="section" style="margin-top: 16px;">
                        <h3 style="margin: 0 0 8px; font-size: 16px; color: rgba(255, 255, 255, 0.85);">
                            Profil Saat Ini
                        </h3>
                        @if ($schoolProfile && $profileComplete)
                            <p style="margin: 0 0 6px; color: rgba(255, 255, 255, 0.7);">
                                Nama: {{ $schoolProfile->school_name ?? '-' }} | NPSN: {{ $schoolProfile->school_npsn ?? '-' }}
                            </p>
                            <p style="margin: 0 0 6px; color: rgba(255, 255, 255, 0.7);">
                                Akreditasi: {{ $schoolProfile->school_accreditation ?? '-' }} | Kontak: {{ $schoolProfile->school_contact ?? '-' }}
                            </p>
                            <p style="margin: 0; color: rgba(255, 255, 255, 0.7);">
                                Alamat: {{ $schoolProfile->address ?? '-' }}
                            </p>
                        @else
                            <p style="margin: 0; color: rgba(255, 255, 255, 0.7);">
                                Belum ada data profil sekolah.
                            </p>
                        @endif
                    </div>
                    <div class="section" style="margin-top: 16px;">
                        <h3 style="margin: 0 0 8px; font-size: 16px; color: rgba(255, 255, 255, 0.85);">
                            Kontak & Lokasi Saat Ini
                        </h3>
                        @if ($schoolContact && $contactComplete)
                            <p style="margin: 0 0 6px; color: rgba(255, 255, 255, 0.7);">
                                Telepon: {{ $schoolContact->phone ?? '-' }} | Email: {{ $schoolContact->email ?? '-' }}
                            </p>
                            <p style="margin: 0 0 6px; color: rgba(255, 255, 255, 0.7);">
                                Website: {{ $schoolContact->website ?? '-' }} | Instagram: {{ $schoolContact->instagram ?? '-' }}
                            </p>
                            <p style="margin: 0 0 6px; color: rgba(255, 255, 255, 0.7);">
                                Koordinat: {{ $schoolContact->coordinate ?? '-' }} | Maps:
                                @if ($schoolContact->maps_link)
                                    <a href="{{ $schoolContact->maps_link }}" style="color: #f6d79c; text-decoration: none;" target="_blank" rel="noopener">
                                        Buka Peta
                                    </a>
                                @else
                                    -
                                @endif
                            </p>
                            <p style="margin: 0 0 6px; color: rgba(255, 255, 255, 0.7);">
                                Jam Operasional: {{ $schoolContact->operational_hours ?? '-' }}
                            </p>
                            <p style="margin: 0; color: rgba(255, 255, 255, 0.7);">
                                Alamat: {{ $schoolContact->address ?? '-' }}
                            </p>
                        @else
                            <p style="margin: 0; color: rgba(255, 255, 255, 0.7);">
                                Belum ada data kontak & lokasi.
                            </p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
