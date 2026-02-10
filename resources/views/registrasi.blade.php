<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registrasi - SPMB</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:600,700&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,700&display=swap" rel="stylesheet" />
        <style>
            :root {
                --ink: #1f2421;
                --muted: #4c5c5a;
                --primary: #0f6b59;
                --primary-strong: #0a4b3f;
                --accent: #caa352;
                --paper: #f7f4ef;
                --mist: #e8efe9;
                --card: #ffffff;
                --line: rgba(15, 107, 89, 0.12);
                --shadow: 0 28px 70px rgba(20, 36, 32, 0.16);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: "DM Sans", "Segoe UI", Arial, sans-serif;
                color: var(--ink);
                background: radial-gradient(circle at top, #ffffff 0%, #f3f6f2 40%, #ecf1ec 100%);
                min-height: 100vh;
            }

            .page {
                padding: 36px 0 64px;
            }

            .container {
                width: min(980px, 92vw);
                margin: 0 auto;
            }

            .card {
                background: var(--card);
                border-radius: 26px;
                padding: 28px;
                box-shadow: var(--shadow);
                border: 1px solid rgba(15, 107, 89, 0.08);
            }

            h1 {
                font-family: "Playfair Display", "Times New Roman", serif;
                font-size: clamp(28px, 4vw, 40px);
                margin: 0 0 10px;
                color: var(--primary-strong);
            }

            p {
                margin: 0 0 24px;
                color: var(--muted);
                line-height: 1.7;
            }

            .grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 16px;
            }

            label {
                display: block;
                font-size: 13px;
                color: var(--primary-strong);
                font-weight: 600;
                margin-bottom: 8px;
            }

            input,
            select,
            textarea {
                width: 100%;
                padding: 12px 14px;
                border-radius: 12px;
                border: 1px solid var(--line);
                background: rgba(255, 255, 255, 0.9);
                font-family: inherit;
                font-size: 14px;
            }

            textarea {
                min-height: 120px;
                resize: vertical;
            }

            .actions {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 18px;
            }

            .button {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 12px 20px;
                border-radius: 999px;
                border: 1px solid transparent;
                font-weight: 600;
                font-size: 14px;
                background: var(--primary);
                color: #ffffff;
                cursor: pointer;
                text-decoration: none;
            }

            .button.secondary {
                background: rgba(255, 255, 255, 0.9);
                color: var(--primary-strong);
                border-color: var(--line);
            }

            .status-message {
                margin: 16px 0 0;
                padding: 12px 14px;
                border-radius: 14px;
                background: rgba(202, 163, 82, 0.16);
                color: #a16a1b;
                font-size: 14px;
            }

            .error-message {
                margin: 16px 0 0;
                padding: 12px 14px;
                border-radius: 14px;
                background: rgba(160, 60, 60, 0.15);
                color: #8f3e3e;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="container">
                <div class="card">
                    <h1>Registrasi</h1>
                    <p>Lengkapi data calon peserta didik untuk memulai proses pendaftaran SPMB.</p>
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
                    <form method="post" action="{{ route('registrasi.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid">
                            <div>
                                <label for="student-name">Nama Calon Siswa</label>
                                <input id="student-name" type="text" name="student_name" value="{{ old('student_name') }}" placeholder="Nama lengkap">
                            </div>
                            <div>
                                <label for="student-nisn">NISN (Opsional)</label>
                                <input id="student-nisn" type="text" name="nisn" value="{{ old('nisn') }}" placeholder="Nomor induk siswa nasional">
                            </div>
                            <div>
                                <label for="birth-date">Tanggal Lahir</label>
                                <input id="birth-date" type="date" name="birth_date" value="{{ old('birth_date') }}">
                            </div>
                            <div>
                                <label for="education-level">Jenjang</label>
                                <select id="education-level" name="level">
                                    <option value="PAUD" {{ old('level') === 'PAUD' ? 'selected' : '' }}>PAUD</option>
                                    <option value="SD" {{ old('level') === 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('level') === 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ old('level') === 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="SMK" {{ old('level') === 'SMK' ? 'selected' : '' }}>SMK</option>
                                </select>
                            </div>
                            <div>
                                <label for="parent-name">Nama Orang Tua/Wali</label>
                                <input id="parent-name" type="text" name="parent_name" value="{{ old('parent_name') }}" placeholder="Nama orang tua">
                            </div>
                            <div>
                                <label for="parent-phone">Nomor Telepon</label>
                                <input id="parent-phone" type="text" name="parent_phone" value="{{ old('parent_phone') }}" placeholder="08xx-xxxx-xxxx">
                            </div>
                        </div>
                        <div style="margin-top: 16px;">
                            <label for="address">Alamat</label>
                            <textarea id="address" name="address" placeholder="Alamat lengkap">{{ old('address') }}</textarea>
                        </div>
                        <div style="margin-top: 16px;">
                            <label>Upload Dokumen</label>
                            <div class="grid">
                                <div>
                                    <label for="birth-certificate">Akte Lahir</label>
                                    <input id="birth-certificate" type="file" name="birth_certificate" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <div>
                                    <label for="family-card">Kartu Keluarga</label>
                                    <input id="family-card" type="file" name="family_card" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <div>
                                    <label for="mother-id">KTP Ibu Kandung</label>
                                    <input id="mother-id" type="file" name="mother_id" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <div>
                                    <label for="photo">Pas Poto</label>
                                    <input id="photo" type="file" name="photo" accept=".jpg,.jpeg,.png">
                                </div>
                            </div>
                        </div>
                        <div class="actions">
                            <button type="submit" class="button">Kirim Registrasi</button>
                            <a href="{{ url('/') }}" class="button secondary">Kembali ke Beranda</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
