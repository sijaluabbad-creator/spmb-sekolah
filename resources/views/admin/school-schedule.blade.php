<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jadwal - SPMB</title>
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
                font-size: 12px;
                letter-spacing: 0.4px;
                text-transform: uppercase;
            }

            input[type="text"],
            input[type="date"] {
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

            .btn.danger {
                background: rgba(160, 60, 60, 0.2);
                color: #f4b6b6;
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

            .inline-form {
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="layout">
            <div class="card">
                <h1>Jadwal</h1>
                <p style="color: rgba(255, 255, 255, 0.7); margin-top: -6px;">
                    Atur jadwal penting SPMB untuk dipublikasikan ke pendaftar.
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
                    <h2>Daftar Jadwal</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Kegiatan</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($schedules as $schedule)
                                <tr>
                                    <td>
                                        <form class="inline-form" method="post" action="{{ route('admin.school.schedule.update', $schedule) }}">
                                            @csrf
                                            <input type="text" name="activity" value="{{ old('activity', $schedule->activity) }}">
                                    </td>
                                    <td>
                                        <input type="date" name="start_date" value="{{ old('start_date', $schedule->start_date) }}">
                                    </td>
                                    <td>
                                        <input type="date" name="end_date" value="{{ old('end_date', $schedule->end_date) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="note" value="{{ old('note', $schedule->note) }}">
                                        <div style="margin-top: 8px; display: flex; gap: 8px; flex-wrap: wrap;">
                                            <button type="submit" class="btn">Simpan</button>
                                        </div>
                                        </form>
                                        <form class="inline-form" method="post" action="{{ route('admin.school.schedule.delete', $schedule) }}" style="margin-top: 8px;">
                                            @csrf
                                            <button type="submit" class="btn danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Belum ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="section">
                    <h2>Tambah Jadwal</h2>
                    <form method="post" action="{{ route('admin.school.schedule.store') }}">
                        @csrf
                        <table>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="activity" value="{{ old('activity') }}" placeholder="Nama kegiatan"></td>
                                    <td><input type="date" name="start_date" value="{{ old('start_date') }}"></td>
                                    <td><input type="date" name="end_date" value="{{ old('end_date') }}"></td>
                                    <td><input type="text" name="note" value="{{ old('note') }}" placeholder="Keterangan"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="margin-top: 12px;">
                            <button type="submit" class="btn">Simpan</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
