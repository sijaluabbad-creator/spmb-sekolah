<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SPMB - Beranda</title>
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

            a {
                color: inherit;
                text-decoration: none;
            }

            .page {
                position: relative;
                overflow: hidden;
                padding: 32px 0 64px;
            }

            .page::before,
            .page::after {
                content: "";
                position: absolute;
                width: 520px;
                height: 520px;
                background: radial-gradient(circle, rgba(15, 107, 89, 0.12) 0%, rgba(15, 107, 89, 0) 65%);
                border-radius: 50%;
                z-index: 0;
            }

            .page::before {
                top: -280px;
                right: -140px;
            }

            .page::after {
                bottom: -320px;
                left: -180px;
            }

            .texture {
                position: absolute;
                inset: 0;
                background-image: url("data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 60H120' stroke='rgba(15, 107, 89, 0.06)'/%3E%3Cpath d='M60 0V120' stroke='rgba(15, 107, 89, 0.06)'/%3E%3C/svg%3E");
                opacity: 0.55;
                z-index: 0;
            }

            .container {
                width: min(1140px, 92vw);
                margin: 0 auto;
                position: relative;
                z-index: 1;
            }

            .nav {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                margin-bottom: 48px;
            }

            .logo {
                display: flex;
                align-items: center;
                gap: 12px;
                font-family: "Playfair Display", "Times New Roman", serif;
                font-size: 22px;
                letter-spacing: 0.8px;
            }

            .logo-mark {
                width: 44px;
                height: 44px;
                border-radius: 14px;
                background: linear-gradient(135deg, #0f6b59, #2f7a55);
                display: grid;
                place-items: center;
                color: #ffffff;
                font-weight: 700;
                font-size: 18px;
                box-shadow: 0 10px 20px rgba(15, 107, 89, 0.25);
                overflow: hidden;
            }

            .logo-mark img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .nav-links {
                display: flex;
                align-items: center;
                gap: 16px;
                font-size: 14px;
                color: var(--muted);
            }

            .auth-menu a {
                padding: 8px 16px;
                border-radius: 999px;
                font-weight: 600;
                font-size: 13px;
                background: rgba(255, 255, 255, 0.75);
                border: 1px solid var(--line);
                color: var(--primary-strong);
            }

            .nav-links a {
                padding: 8px 14px;
                border-radius: 999px;
                transition: all 0.2s ease;
            }

            .nav-links a:hover {
                background: rgba(15, 107, 89, 0.08);
                color: var(--primary-strong);
            }

            .nav-links .cta {
                background: var(--primary);
                color: #ffffff;
                box-shadow: 0 14px 30px rgba(15, 107, 89, 0.22);
            }

            .hero {
                display: grid;
                gap: 32px;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                align-items: center;
                margin-bottom: 60px;
            }

            .hero h1 {
                font-family: "Playfair Display", "Times New Roman", serif;
                font-size: clamp(32px, 4vw, 54px);
                line-height: 1.08;
                margin: 0 0 16px;
                color: var(--primary-strong);
            }

            .hero p {
                font-size: 17px;
                line-height: 1.75;
                color: var(--muted);
                margin: 0 0 24px;
            }

            .hero-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
            }

            .button {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                padding: 12px 20px;
                border-radius: 999px;
                border: 1px solid transparent;
                font-weight: 600;
                transition: all 0.2s ease;
                font-size: 14px;
            }

            .button.primary {
                background: var(--primary);
                color: #ffffff;
                box-shadow: 0 18px 32px rgba(15, 107, 89, 0.22);
            }

            .button.primary:hover {
                transform: translateY(-2px);
                background: var(--primary-strong);
            }

            .button.secondary {
                border-color: var(--line);
                color: var(--primary-strong);
                background: rgba(255, 255, 255, 0.8);
            }

            .hero-card {
                background: var(--card);
                border-radius: 26px;
                padding: 26px;
                box-shadow: var(--shadow);
                border: 1px solid rgba(15, 107, 89, 0.08);
            }

            .hero-card h3 {
                margin: 0 0 16px;
                font-size: 18px;
                color: var(--primary-strong);
            }

            .hero-card ul {
                margin: 0;
                padding: 0;
                list-style: none;
                display: grid;
                gap: 12px;
                color: var(--muted);
                font-size: 14px;
            }

            .hero-card li {
                display: flex;
                justify-content: space-between;
                border-bottom: 1px dashed rgba(15, 107, 89, 0.16);
                padding-bottom: 10px;
            }

            .hero-card li:last-child {
                border-bottom: none;
                padding-bottom: 0;
            }

            .stats {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
                gap: 14px;
                margin-top: 24px;
            }

            .stat {
                background: var(--mist);
                padding: 16px;
                border-radius: 18px;
                text-align: left;
            }

            .stat strong {
                display: block;
                font-size: 20px;
                color: var(--primary-strong);
                margin-bottom: 6px;
            }

            .section {
                margin: 60px 0;
            }

            .section-title {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 22px;
            }

            .section-title span {
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 2px;
                color: var(--accent);
                font-weight: 600;
            }

            .section-title h2 {
                margin: 0;
                font-size: clamp(24px, 3vw, 34px);
                font-family: "Playfair Display", "Times New Roman", serif;
                color: var(--primary-strong);
            }

            .grid-3 {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 18px;
            }

            .card {
                background: var(--card);
                border-radius: 22px;
                padding: 20px;
                border: 1px solid rgba(15, 107, 89, 0.08);
                box-shadow: 0 16px 36px rgba(17, 36, 30, 0.08);
            }

            .card h3 {
                margin: 0 0 10px;
                color: var(--primary-strong);
                font-size: 18px;
            }

            .card p {
                margin: 0;
                color: var(--muted);
                font-size: 14px;
                line-height: 1.6;
            }

            .steps {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 16px;
            }

            .step {
                border-radius: 18px;
                padding: 18px;
                background: rgba(255, 255, 255, 0.85);
                border: 1px solid rgba(15, 107, 89, 0.1);
            }

            .step-number {
                font-weight: 700;
                color: var(--accent);
                font-size: 20px;
                margin-bottom: 8px;
            }

            .timeline {
                display: grid;
                gap: 14px;
            }

            .timeline-item {
                display: flex;
                gap: 14px;
                padding: 14px;
                border-radius: 18px;
                background: var(--card);
                border: 1px solid rgba(15, 107, 89, 0.08);
            }

            .timeline-date {
                min-width: 120px;
                font-weight: 700;
                color: var(--primary-strong);
            }

            .cta-band {
                background: linear-gradient(120deg, #0f6b59, #2a7a5e);
                color: #ffffff;
                padding: 28px;
                border-radius: 24px;
                display: grid;
                gap: 14px;
                align-items: center;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            }

            .cta-band h3 {
                margin: 0;
                font-size: 22px;
                font-family: "Playfair Display", "Times New Roman", serif;
            }

            .cta-band p {
                margin: 0;
                color: rgba(255, 255, 255, 0.85);
            }

            .faq {
                display: grid;
                gap: 12px;
            }

            .faq details {
                background: var(--card);
                border-radius: 18px;
                padding: 14px 18px;
                border: 1px solid rgba(15, 107, 89, 0.08);
            }

            .faq summary {
                cursor: pointer;
                font-weight: 600;
                color: var(--primary-strong);
            }

            .footer {
                margin-top: 50px;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                gap: 12px;
                color: var(--muted);
                font-size: 13px;
            }

            .reveal {
                opacity: 0;
                transform: translateY(16px);
                animation: rise 0.7s ease forwards;
                animation-delay: var(--d, 0ms);
            }

            @keyframes rise {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 720px) {
                .nav {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .hero-actions {
                    width: 100%;
                }

                .timeline-item {
                    flex-direction: column;
                }

                .timeline-date {
                    min-width: auto;
                }
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="texture"></div>
            <div class="container">
                <header class="nav reveal" style="--d: 80ms;">
                    <div class="logo">
                        <div class="logo-mark">
                            @if (!empty($schoolProfile?->logo_path))
                                <img src="{{ asset('storage/' . $schoolProfile->logo_path) }}" alt="Logo Sekolah">
                            @else
                                SP
                            @endif
                        </div>
                        <div>
                            <div>SPMB</div>
                            <small style="color: var(--muted); font-size: 12px;">
                                {{ $schoolProfile?->school_name ?? 'Seleksi Penerimaan Murid Baru' }}
                            </small>
                        </div>
                    </div>
                    <div class="nav-links">
                        <a href="#alur">Alur</a>
                        <a href="#jadwal">Jadwal</a>
                        <a href="#faq">FAQ</a>
                        <a href="{{ route('registrasi') }}">Registrasi</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/home') }}" class="cta">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}">Masuk</a>
                            @endauth
                        @endif
                    </div>
                </header>

                <section class="hero">
                    <div class="reveal" style="--d: 120ms;">
                        <h1>
                            Beranda SPMB.
                            @if (!empty($schoolProfile?->school_name))
                                <span style="display: block; font-size: 0.7em; color: var(--muted); margin-top: 6px;">
                                    {{ $schoolProfile->school_name }}
                                </span>
                            @endif
                        </h1>
                        <p>
                            Kelola proses pendaftaran siswa baru dengan alur yang jelas, jadwal transparan,
                            dan pengalaman yang ramah bagi orang tua serta calon peserta didik.
                        </p>
                        <div class="hero-actions">
                            <a class="button primary" href="#jadwal">Cek Jadwal</a>
                            <a class="button secondary" href="#alur">Panduan Pendaftaran</a>
                        </div>
                        <div class="stats">
                            <div class="stat">
                                <strong>{{ number_format($totalQuota) }}</strong>
                                Kuota keseluruhan
                            </div>
                            <div class="stat">
                                <strong>3 Hari</strong>
                                Rata-rata verifikasi
                            </div>
                        </div>
                    </div>
                    <div class="hero-card reveal" style="--d: 180ms;">
                        <h3>Informasi Gelombang</h3>
                        <ul>
                            @forelse ($schedules as $schedule)
                                @php
                                    $start = $schedule->start_date
                                        ? \Illuminate\Support\Carbon::parse($schedule->start_date)->translatedFormat('d M')
                                        : '-';
                                    $end = $schedule->end_date
                                        ? \Illuminate\Support\Carbon::parse($schedule->end_date)->translatedFormat('d M')
                                        : null;
                                    $dateLabel = $end ? $start . ' - ' . $end : $start;
                                @endphp
                                <li><span>{{ $schedule->activity }}</span><strong>{{ $dateLabel }}</strong></li>
                            @empty
                                <li><span>Belum ada jadwal</span><strong>-</strong></li>
                            @endforelse
                        </ul>
                        <div class="hero-actions" style="margin-top: 18px;">
                            @if (Route::has('login'))
                                @auth
                                    <a class="button secondary" href="{{ url('/home') }}">Masuk Dashboard</a>
                                @else
                                    <a class="button primary" href="{{ route('login') }}">Login</a>
                                @endauth
                            @endif
                            <a class="button primary" href="{{ route('registrasi') }}">Mulai Daftar</a>
                            <a class="button secondary" href="#">Unduh Panduan</a>
                        </div>
                    </div>
                </section>

                <section class="section" id="alur">
                    <div class="section-title reveal" style="--d: 380ms;">
                        <span>Alur</span>
                    </div>
                    <div class="steps">
                        <div class="step reveal" style="--d: 420ms;">
                            <div class="step-number">01</div>
                            <strong>Buat Akun</strong>
                            <p>Isi data orang tua dan calon siswa secara lengkap.</p>
                        </div>
                        <div class="step reveal" style="--d: 460ms;">
                            <div class="step-number">02</div>
                            <strong>Unggah Berkas</strong>
                            <p>Upload dokumen sesuai jalur pendaftaran yang dipilih.</p>
                        </div>
                        <div class="step reveal" style="--d: 500ms;">
                            <div class="step-number">03</div>
                            <strong>Verifikasi</strong>
                            <p>Petugas memeriksa berkas dan memberi status verifikasi.</p>
                        </div>
                        <div class="step reveal" style="--d: 540ms;">
                            <div class="step-number">04</div>
                            <strong>Pengumuman</strong>
                            <p>Cek hasil seleksi langsung di dashboard SPMB.</p>
                        </div>
                    </div>
                </section>

                <section class="section" id="jadwal">
                    <div class="section-title reveal" style="--d: 580ms;">
                        <span>Jadwal</span>
                        <h2>Timeline kegiatan utama</h2>
                    </div>
                    <div class="timeline">
                        @forelse ($schedules as $index => $schedule)
                            @php
                                $start = $schedule->start_date
                                    ? \Illuminate\Support\Carbon::parse($schedule->start_date)->translatedFormat('d M Y')
                                    : '-';
                                $end = $schedule->end_date
                                    ? \Illuminate\Support\Carbon::parse($schedule->end_date)->translatedFormat('d M Y')
                                    : null;
                                $dateLabel = $end ? $start . ' - ' . $end : $start;
                                $delay = 620 + ($index * 40);
                            @endphp
                            <div class="timeline-item reveal" style="--d: {{ $delay }}ms;">
                                <div class="timeline-date">{{ $dateLabel }}</div>
                                <div>
                                    <strong>{{ $schedule->activity }}</strong>
                                    <p>{{ $schedule->note ?? 'Detail jadwal tersedia di dashboard.' }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="timeline-item reveal" style="--d: 620ms;">
                                <div class="timeline-date">-</div>
                                <div>
                                    <strong>Belum ada jadwal</strong>
                                    <p>Jadwal kegiatan akan diperbarui oleh admin.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="section">
                    <div class="cta-band reveal" style="--d: 740ms;">
                        <div>
                            <h3>Siap memulai proses SPMB?</h3>
                            <p>Gunakan akun orang tua untuk memantau status secara real time.</p>
                        </div>
                        <div class="hero-actions">
                            <a class="button secondary" href="#faq">Baca FAQ</a>
                            <a class="button primary" href="#">Mulai Sekarang</a>
                        </div>
                    </div>
                </section>

                <footer class="footer reveal" style="--d: 940ms;">
                    <div>SPMB Terpadu untuk : Paud / SD / SMP / SMA / SMK</div>
                    <div>Created By OPS270 | 085117678151</div>
                </footer>
            </div>
        </div>
    </body>
</html>
