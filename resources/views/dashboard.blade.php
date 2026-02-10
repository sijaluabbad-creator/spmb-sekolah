<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard - SPMB</title>
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                background: #f5f6f4;
                color: #1f2421;
                padding: 32px;
            }

            .card {
                max-width: 680px;
                margin: 0 auto;
                background: #ffffff;
                border-radius: 16px;
                padding: 24px;
                box-shadow: 0 18px 34px rgba(0, 0, 0, 0.08);
            }

            h1 {
                margin-top: 0;
            }

            form {
                margin-top: 16px;
            }

            button {
                padding: 10px 16px;
                border: none;
                border-radius: 8px;
                background: #0f6b59;
                color: #ffffff;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="card">
            <h1>Dashboard Pengguna</h1>
            <p>Halo, {{ auth()->user()->name }}. Anda berhasil login.</p>
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </body>
</html>
