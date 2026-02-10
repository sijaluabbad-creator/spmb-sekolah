<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kontak & Lokasi - SPMB</title>
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
            textarea {
                width: 100%;
                padding: 10px 12px;
                border-radius: 8px;
                border: 1px solid rgba(255, 255, 255, 0.12);
                background: rgba(255, 255, 255, 0.06);
                color: #ffffff;
                font-size: 14px;
            }

            textarea {
                min-height: 120px;
                resize: vertical;
            }

            input::placeholder,
            textarea::placeholder {
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
                border: none;
                cursor: pointer;
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
                <h1>Kontak & Lokasi</h1>
                <p style="color: rgba(255, 255, 255, 0.7); margin-top: -6px;">
                    Kelola informasi kontak dan lokasi sekolah yang tampil di portal SPMB.
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
                <form method="post" action="{{ route('admin.school.contact.update') }}">
                    @csrf
                    <div class="section">
                        <h2>Kontak Utama</h2>
                        <div class="info-grid">
                            <label class="info-item">
                                <span>Telepon Sekolah</span>
                                <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" placeholder="Contoh: 021-000-000">
                            </label>
                            <label class="info-item">
                                <span>Email</span>
                                <input type="text" name="email" value="{{ old('email', $contact->email) }}" placeholder="nama@sekolah.sch.id">
                            </label>
                            <label class="info-item">
                                <span>Website</span>
                                <input type="text" name="website" value="{{ old('website', $contact->website) }}" placeholder="https://sekolah.sch.id">
                            </label>
                            <label class="info-item">
                                <span>Instagram</span>
                                <input type="text" name="instagram" value="{{ old('instagram', $contact->instagram) }}" placeholder="@sekolah">
                            </label>
                        </div>
                    </div>
                    <div class="section">
                        <h2>Lokasi</h2>
                        <div class="info-grid">
                            <label class="info-item">
                                <span>Alamat</span>
                                <textarea name="address" placeholder="Alamat lengkap sekolah">{{ old('address', $contact->address) }}</textarea>
                            </label>
                            <label class="info-item">
                                <span>Koordinat</span>
                                <input type="text" name="coordinate" value="{{ old('coordinate', $contact->coordinate) }}" placeholder="-6.200000, 106.816666">
                            </label>
                            <label class="info-item">
                                <span>Link Maps</span>
                                <input type="text" name="maps_link" value="{{ old('maps_link', $contact->maps_link) }}" placeholder="https://maps.google.com/...">
                            </label>
                            <label class="info-item">
                                <span>Jam Operasional</span>
                                <input type="text" name="operational_hours" value="{{ old('operational_hours', $contact->operational_hours) }}" placeholder="Senin-Jumat, 07.00-15.00">
                            </label>
                        </div>
                    </div>
                    <div class="section">
                        <button type="submit" class="btn">Simpan</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
