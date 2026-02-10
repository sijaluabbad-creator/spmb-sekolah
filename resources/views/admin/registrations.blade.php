<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Daftar Registrasi - SPMB</title>
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                background: #0f1f1b;
                color: #ffffff;
                padding: 32px;
            }

            .layout {
                max-width: 1100px;
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

            .search-bar {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
                margin-top: 12px;
            }

            .search-bar input {
                flex: 1 1 220px;
                padding: 10px 12px;
                border-radius: 8px;
                border: 1px solid rgba(255, 255, 255, 0.12);
                background: rgba(255, 255, 255, 0.06);
                color: #ffffff;
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        <div class="layout">
            <div class="card">
                <h1>Daftar Registrasi</h1>
                <p style="color: rgba(255, 255, 255, 0.7); margin-top: -6px;">
                    Data registrasi calon peserta yang masuk melalui halaman pendaftaran.
                </p>
                <form class="search-bar" method="get" action="{{ route('admin.registrations') }}">
                    <input type="text" name="q" value="{{ $query }}" placeholder="Cari nama, NISN, jenjang, orang tua">
                    <button type="submit" class="btn">Cari</button>
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Jenjang</th>
                            <th>Tgl Lahir</th>
                            <th>Orang Tua</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Kirim Pesan</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($registrations as $registration)
                            @php
                                $rawPhone = preg_replace('/\D+/', '', $registration->parent_phone ?? '');
                                $phone = $rawPhone;
                                if (str_starts_with($rawPhone, '0')) {
                                    $phone = '62' . substr($rawPhone, 1);
                                }
                                $message = "Pendaftaran sudah kami terima. Selanjutnya silahkan login Aplikasi, untuk mengirimkan Dokumen Umum, berupa;\n"
                                    . "1. Akte Lahir\n"
                                    . "2. Kartu Keluarga\n"
                                    . "3. Pas Poto\n"
                                    . "4. KTP Ibu Kandung\n"
                                    . "Hasil Penerimaan akan dikirim melalui Whatsapp orangtua.\n"
                                    . "Terima Kasih";
                            @endphp
                            <tr>
                                <td>{{ $registration->student_name }}</td>
                                <td>{{ $registration->nisn }}</td>
                                <td>{{ $registration->level }}</td>
                                <td>{{ $registration->birth_date }}</td>
                                <td>{{ $registration->parent_name }}</td>
                                <td>{{ $registration->parent_phone }}</td>
                                <td>{{ $registration->address }}</td>
                                <td>
                                    @if ($phone)
                                        <a class="btn" href="https://wa.me/{{ $phone }}?text={{ urlencode($message) }}" target="_blank" rel="noopener">
                                            Kirim Pesan
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $docs = [
                                            'Akte' => $registration->birth_certificate_path,
                                            'KK' => $registration->family_card_path,
                                            'KTP Ibu' => $registration->mother_id_path,
                                            'Foto' => $registration->photo_path,
                                        ];
                                        $availableDocs = array_filter($docs);
                                    @endphp
                                    @if ($availableDocs)
                                        <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                            @foreach ($availableDocs as $label => $path)
                                                <a class="btn secondary" href="{{ asset('storage/' . $path) }}" target="_blank" rel="noopener">
                                                    {{ $label }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">Belum ada data registrasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div style="margin-top: 16px;">
                    <a href="{{ route('admin.dashboard') }}" class="btn">Kembali</a>
                </div>
            </div>
        </div>
    </body>
</html>
