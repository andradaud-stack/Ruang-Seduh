<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Ruang Seduh</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#2D1D1B;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
        }

        .phone{
            width:100%;
            max-width:390px;
            min-height:100vh;
            background:#2D1D1B;
            overflow:hidden;
        }

        .top{

            background:#6B4433;
            height:38vh;
            min-height:280px;

            border-bottom-left-radius:50% 18%;
            border-bottom-right-radius:50% 18%;

            position:relative;

            display:flex;
            justify-content:center;
            align-items:center;

        }

        .logo{

            position:absolute;
            top:25px;
            left:25px;
            width:70px;

        }

        .title{

            color:white;
            font-size:52px;
            font-weight:700;

        }

        .content{

            background:white;

            margin-top:-30px;

            border-radius:35px 35px 0 0;

            padding:40px 28px;

            min-height:62vh;

        }

        .form-group{

            margin-bottom:25px;

        }

        label{

            display:block;

            margin-bottom:10px;

            font-size:16px;

            font-weight:700;

            color:#111;

        }

        input{

            width:100%;

            height:52px;

            border-radius:16px;

            border:1px solid #ddd;

            background:#efefef;

            padding:0 18px;

            font-size:15px;

            outline:none;

        }

        input:focus{

            border-color:#E76E57;

            background:white;

        }

        .btn-login{

            width:100%;

            height:58px;

            border:none;

            border-radius:40px;

            background:#2D1D1B;

            color:white;

            font-size:20px;

            font-weight:600;

            cursor:pointer;

            margin-top:18px;

            box-shadow:0 0 25px rgba(0,0,0,.25);

            transition:.3s;

        }

        .btn-login:hover{

            transform:translateY(-2px);

        }

        .bottom-text{

            text-align:center;

            margin-top:30px;

            color:#999;

        }

        .bottom-text a{

            text-decoration:none;

            color:#111;

            font-weight:700;

        }

        .error{

            background:#ffe8e8;

            color:#b10000;

            padding:12px;

            border-radius:12px;

            margin-bottom:20px;

        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
            color: #aaa;
            font-size: 13px;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #eee;
        }

        .divider span {
            padding: 0 14px;
        }

        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            height: 52px;
            border: 1.5px solid #e2e8f0;
            border-radius: 40px;
            background: #ffffff;
            color: #1e293b;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .btn-google:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

    </style>

</head>

<body>

<div class="phone">

    <div class="top">

        <img
            src="{{ asset('assets/images/LOGO_RUANG_SEDUH(putih).png') }}"
            class="logo"
            alt="Logo">

        <div class="title">
            Masuk
        </div>

    </div>

    <div class="content">

        @php
            $detectedTable = null;
            $tableParam = request('table') ?? request('table_id');
            if ($tableParam) {
                $detectedTable = \App\Modules\Tables\Models\Tables::where('table_number', $tableParam)
                    ->orWhere('table_number', str_pad($tableParam, 2, '0', STR_PAD_LEFT))
                    ->orWhere('id', $tableParam)
                    ->orWhere('qr_token', $tableParam)
                    ->first();
            }
            if (!$detectedTable && ($cookieTbl = request()->cookie('customer_table_id'))) {
                $detectedTable = \App\Modules\Tables\Models\Tables::find($cookieTbl);
            }
            if (!$detectedTable && ($sessTbl = session('customer_table_id'))) {
                $detectedTable = \App\Modules\Tables\Models\Tables::find($sessTbl);
            }
        @endphp

        @if($detectedTable)
            <div style="background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; padding:11px 14px; border-radius:14px; font-size:13px; font-weight:700; margin-bottom:18px; display:flex; align-items:center; gap:8px;">
                <span style="font-size:16px;">📍</span>
                <span>Terhubung ke <strong>Meja {{ $detectedTable->table_number }}</strong></span>
            </div>
        @endif

        @if (session('message_info'))
            <div style="background:#eff6ff; border:1px solid #bfdbfe; color:#1d4ed8; padding:11px 14px; border-radius:14px; font-size:13px; font-weight:600; margin-bottom:18px;">
                {{ session('message_info') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('customer.login.store') }}" method="POST">

            @csrf

            @if($detectedTable)
                <input type="hidden" name="table" value="{{ $detectedTable->table_number }}">
                <input type="hidden" name="table_id" value="{{ $detectedTable->id }}">
            @endif

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Masukkan email"
                    value="{{ old('email') }}"
                    required>

            </div>

            <div class="form-group">

                <label>Password</label>

                <div class="password-field">
                    <input
                        type="password"
                        name="password"
                        id="login-password"
                        placeholder="Masukkan password"
                        required>
                    <button type="button" class="password-toggle" data-target="login-password" aria-label="Lihat password">
                        <img src="{{ asset('assets/images/toggle/view.png') }}" alt="" aria-hidden="true">
                    </button>
                </div>

            </div>

            <button type="submit" class="btn-login">

                Masuk Sekarang

            </button>

        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <a href="{{ route('auth.google.redirect', $detectedTable ? ['table' => $detectedTable->table_number, 'table_id' => $detectedTable->id] : []) }}" class="btn-google">
            <svg width="20" height="20" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            Masuk dengan Google
        </a>

        <div class="bottom-text">

            Belum punya akun?

            <a href="{{ route('customer.register', $detectedTable ? ['table' => $detectedTable->table_number, 'table_id' => $detectedTable->id] : []) }}">

                Daftar

            </a>

        </div>

    </div>

</div>

<style>
    .password-field {
        position: relative;
    }

    .password-field input {
        width: 100%;
        padding-right: 44px;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: #6b7280;
        cursor: pointer;
        font-size: 16px;
        line-height: 1;
        padding: 4px;
    }

    .password-toggle img {
        display: block;
        width: 20px;
        height: 20px;
        object-fit: contain;
    }
</style>

<script>
    document.querySelectorAll('.password-toggle').forEach(function(button) {
        button.addEventListener('click', function () {
            const target = document.getElementById(this.dataset.target);
            const isPassword = target.type === 'password';
            target.type = isPassword ? 'text' : 'password';
            this.querySelector('img').src = isPassword
                ? "{{ asset('assets/images/toggle/hide.png') }}"
                : "{{ asset('assets/images/toggle/view.png') }}";
            this.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Lihat password');
        });
    });
</script>

</body>
</html>