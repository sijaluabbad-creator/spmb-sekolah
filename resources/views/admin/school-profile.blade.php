<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profil Sekolah - SPMB</title>
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

            .section {
                margin-top: 24px;
            }

            .info-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 16px;
                margin-top: 12px;
            }

            .info-item {
                background: rgba(255, 255, 255, 0.05);
                border-radius: 12px;
                padding: 16px;
            }

            .info-item span {
                display: block;
                color: rgba(255, 255, 255, 0.7);
                font-size: 12px;
                text-transform: uppercase;
                letter-spacing: 0.4px;
                margin-bottom: 6px;
            }

            input[type="text"],
            input[type="password"],
            input[type="file"] {
                width: 100%;
                padding: 10px 12px;
                border-radius: 8px;
                border: 1px solid rgba(255, 255, 255, 0.12);
                background: rgba(255, 255, 255, 0.06);
                color: #ffffff;
                font-size: 14px;
            }

            input[type="file"] {
                padding: 8px;
            }

            input::placeholder {
                color: rgba(255, 255, 255, 0.5);
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

            .status-message {
                background: rgba(202, 163, 82, 0.16);
                color: #f6d79c;
                padding: 10px 14px;
                border-radius: 10px;
                margin-top: 12px;
            }

            .error-message {
                background: rgba(160, 60, 60, 0.2);
                color: #f4b6b6;
                padding: 10px 14px;
                border-radius: 10px;
                margin-top: 12px;
            }
        </style>
    </head>
    <body>
        <div class="layout">
            <div class="card">
                <h1>Profil Sekolah</h1>
                <p style="color: rgba(255, 255, 255, 0.7); margin-top: -6px;">
                    Kelola informasi utama sekolah yang tampil di portal SPMB.
                </p>
                @if (session('status'))
                    <div class="status-message">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="error-message">
                        <strong>Periksa kembali input Anda:</strong>
                        <ul style="margin: 8px 0 0; padding-left: 18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="section">
                    <h2>Informasi Utama</h2>
                    <form method="post" action="{{ route('admin.school.profile.update') }}">
                        @csrf
                        <div class="info-grid">
                            <label class="info-item">
                                <span>Nama Sekolah</span>
                                <input type="text" name="school_name" value="{{ old('school_name', $profile->school_name) }}" placeholder="Nama sekolah">
                            </label>
                            <label class="info-item">
                                <span>NPSN</span>
                                <input type="text" name="school_npsn" value="{{ old('school_npsn', $profile->school_npsn) }}" placeholder="NPSN">
                            </label>
                            <label class="info-item">
                                <span>Akreditasi</span>
                                <input type="text" name="school_accreditation" value="{{ old('school_accreditation', $profile->school_accreditation) }}" placeholder="Akreditasi">
                            </label>
                            <label class="info-item">
                                <span>Kontak</span>
                                <input type="text" name="school_contact" value="{{ old('school_contact', $profile->school_contact) }}" placeholder="Nomor kontak">
                            </label>
                            <label class="info-item">
                                <span>Alamat</span>
                                <input type="text" name="address" value="{{ old('address', $profile->address) }}" placeholder="Alamat sekolah">
                            </label>
                        </div>
                        <div style="margin-top: 12px;">
                            <button type="submit" class="btn">Simpan</button>
                        </div>
                    </form>
                </div>
                <div class="section">
                    <h2>Kepala Sekolah</h2>
                    <p style="color: rgba(255, 255, 255, 0.7); margin-top: -6px;">
                        Isi data kepala sekolah untuk kebutuhan administrasi.
                    </p>
                    <form method="post" action="{{ route('admin.school.profile.principal') }}">
                        @csrf
                        <div class="info-grid">
                            <label class="info-item">
                                <span>Nama Kepala Sekolah</span>
                                <input type="text" name="principal_name" value="{{ old('principal_name', $profile->principal_name) }}" placeholder="Nama lengkap">
                            </label>
                            <label class="info-item">
                                <span>NIP/NUPTK</span>
                                <input type="text" name="principal_id" value="{{ old('principal_id', $profile->principal_id) }}" placeholder="NIP atau NUPTK">
                            </label>
                        </div>
                        <div style="margin-top: 12px;">
                            <button type="submit" class="btn">Simpan</button>
                        </div>
                    </form>
                </div>
                <div class="section">
                    <h2>Upload Logo Sekolah</h2>
                    <p style="color: rgba(255, 255, 255, 0.7); margin-top: -6px;">
                        Unggah logo resmi sekolah untuk ditampilkan di portal SPMB.
                    </p>
                    @if ($profile->logo_path)
                        <div style="margin-bottom: 12px;">
                            <img src="{{ asset('storage/' . $profile->logo_path) }}" alt="Logo Sekolah" style="max-width: 160px; border-radius: 12px;">
                        </div>
                    @endif
                    <form method="post" action="{{ route('admin.school.profile.logo') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="logo" accept="image/*">
                        <button type="submit" class="btn">Upload</button>
                    </form>
                </div>
                <div class="section">
                    <h2>Password</h2>
                    <p style="color: rgba(255, 255, 255, 0.7); margin-top: -6px;">
                        Ganti password akun admin untuk keamanan akses.
                    </p>
                    <form method="post" action="{{ route('admin.school.profile.password') }}">
                        @csrf
                        <div class="info-grid">
                            <label class="info-item">
                                <span>Password Saat Ini</span>
                                <input type="password" name="current_password" placeholder="Password saat ini">
                            </label>
                            <label class="info-item">
                                <span>Password Baru</span>
                                <input type="password" name="password" placeholder="Password baru">
                            </label>
                            <label class="info-item">
                                <span>Konfirmasi Password Baru</span>
                                <input type="password" name="password_confirmation" placeholder="Ulangi password baru">
                            </label>
                        </div>
                        <div style="margin-top: 12px;">
                            <button type="submit" class="btn">Simpan</button>
                        </div>
                    </form>
                </div>
                <div class="section">
                    <h2>Alamat</h2>
                    <p style="color: rgba(255, 255, 255, 0.7); margin-top: -6px;">
                        {{ $profile->address ?? 'Belum ada data alamat.' }}
                    </p>
                </div>
                <div class="section">
                    <a href="{{ route('admin.dashboard') }}" class="btn secondary">Kembali</a>
                </div>
            </div>
        </div>
    </body>
</html>
