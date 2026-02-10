<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jenjang /Jurusan / Kuota - SPMB</title>
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

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 12px;
                font-size: 14px;
            }

            th,
            td {
                text-align: left;
                padding: 10px 12px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            }

            th {
                color: rgba(255, 255, 255, 0.7);
                font-weight: 600;
                font-size: 13px;
                letter-spacing: 0.4px;
                text-transform: uppercase;
            }

            input[type="text"],
            input[type="number"] {
                width: 100%;
                padding: 10px 12px;
                border-radius: 8px;
                border: 1px solid rgba(255, 255, 255, 0.12);
                background: rgba(255, 255, 255, 0.06);
                color: #ffffff;
                font-size: 14px;
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
                border: none;
                cursor: pointer;
            }

            .btn.secondary {
                background: rgba(255, 255, 255, 0.12);
                color: #ffffff;
            }

            .inline-form {
                margin: 0;
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
                <h1>Jenjang /Jurusan / Kuota</h1>
                <p style="color: rgba(255, 255, 255, 0.7); margin-top: -6px;">
                    Kelola daftar jurusan dan kuota penerimaan untuk SPMB.
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
                    <h2>Jenjang Pendaftaran</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Jurusan</th>
                                <th>Kuota</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($majors as $major)
                                <tr>
                                    <td>
                                        <form class="inline-form" method="post" action="{{ route('admin.school.majors.update', $major) }}">
                                            @csrf
                                            <input type="text" name="name" value="{{ old('name', $major->name) }}">
                                    </td>
                                    <td>
                                        <input type="number" name="quota" value="{{ old('quota', $major->quota) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="status" value="{{ old('status', $major->status) }}">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn">Simpan</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Belum ada data jurusan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="section">
                    <h2>Tambah Jurusan SMK</h2>
                    <form method="post" action="{{ route('admin.school.majors.store') }}">
                        @csrf
                        <table>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="name" placeholder="Nama jurusan"></td>
                                    <td><input type="number" name="quota" placeholder="Kuota"></td>
                                    <td><input type="text" name="status" placeholder="Status"></td>
                                    <td><button type="submit" class="btn">Simpan</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="section">
                    <a href="{{ route('admin.dashboard') }}" class="btn secondary">Kembali</a>
                </div>
            </div>
        </div>
    </body>
</html>
