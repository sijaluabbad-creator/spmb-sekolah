<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - SPMB</title>
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
                --card: #ffffff;
                --line: rgba(15, 107, 89, 0.14);
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                min-height: 100vh;
                font-family: "DM Sans", "Segoe UI", Arial, sans-serif;
                color: var(--ink);
                background: radial-gradient(circle at top, #ffffff 0%, #f3f6f2 40%, #ecf1ec 100%);
                display: grid;
                place-items: center;
                padding: 32px 16px;
            }

            .card {
                width: min(420px, 92vw);
                background: var(--card);
                border-radius: 24px;
                padding: 28px;
                border: 1px solid rgba(15, 107, 89, 0.08);
                box-shadow: 0 30px 60px rgba(20, 36, 32, 0.16);
            }

            h1 {
                font-family: "Playfair Display", "Times New Roman", serif;
                margin: 0 0 6px;
                color: var(--primary-strong);
                font-size: 28px;
            }

            p {
                margin: 0 0 18px;
                color: var(--muted);
                font-size: 14px;
            }

            label {
                display: block;
                font-weight: 600;
                margin-bottom: 6px;
                font-size: 13px;
                color: var(--primary-strong);
            }

            input {
                width: 100%;
                padding: 10px 12px;
                border-radius: 12px;
                border: 1px solid var(--line);
                font-size: 14px;
                margin-bottom: 14px;
            }

            .actions {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
                margin-top: 10px;
            }

            button {
                padding: 10px 18px;
                border-radius: 999px;
                border: none;
                background: var(--primary);
                color: #ffffff;
                font-weight: 600;
                cursor: pointer;
            }

            .link {
                color: var(--primary-strong);
                font-size: 13px;
                text-decoration: none;
            }

            .error {
                background: #fff1f1;
                color: #8a2a2a;
                border: 1px solid #f5c6c6;
                padding: 10px 12px;
                border-radius: 12px;
                font-size: 13px;
                margin-bottom: 14px;
            }
        </style>
    </head>
    <body>
        <form class="card" method="post" action="{{ url('/login') }}">
            @csrf
            <h1>Login SPMB</h1>
            <p>Masukkan akun Anda untuk melanjutkan.</p>

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

            <label for="password">Kata sandi</label>
            <input id="password" type="password" name="password" required>

            <div class="actions">
                <label style="display: inline-flex; align-items: center; gap: 6px; margin: 0;">
                    <input type="checkbox" name="remember" style="width: auto; margin: 0;">
                    Ingat saya
                </label>
                <button type="submit">Masuk</button>
            </div>

            <div style="margin-top: 16px;">
                <a class="link" href="{{ url('/') }}">Kembali ke beranda</a>
            </div>
        </form>
    </body>
</html>
