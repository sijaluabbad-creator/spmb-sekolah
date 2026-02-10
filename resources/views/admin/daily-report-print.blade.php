<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rekap Laporan Harian - SPMB</title>
        <style>
            body {
                margin: 24px;
                font-family: Arial, sans-serif;
                color: #1f2a26;
            }

            h1 {
                margin: 0 0 12px;
                font-size: 22px;
            }

            p {
                margin: 0 0 20px;
                color: #44524d;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 14px;
            }

            th,
            td {
                text-align: left;
                padding: 10px 12px;
                border-bottom: 1px solid #d7dedb;
            }

            th {
                text-transform: uppercase;
                font-size: 12px;
                letter-spacing: 0.4px;
                color: #44524d;
            }

            @media print {
                body {
                    margin: 0;
                }
            }
        </style>
    </head>
    <body>
        <h1>Rekap Laporan Harian</h1>
        <p>Ringkasan aktivitas harian untuk pemantauan operasional SPMB.</p>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pendaftar</th>
                    <th>Terverifikasi</th>
                    <th>Ditolak</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dailyReports as $report)
                    <tr>
                        <td>{{ $report['date'] }}</td>
                        <td>{{ $report['registrants'] }}</td>
                        <td>{{ $report['verified'] }}</td>
                        <td>{{ $report['rejected'] }}</td>
                        <td>{{ $report['note'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data laporan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <script>
            window.addEventListener('load', () => {
                window.print();
            });
        </script>
    </body>
</html>
