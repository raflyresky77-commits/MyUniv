
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - MyUniv</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f4f7fb;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 420px;
            padding: 35px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }

        h2 {
            margin-bottom: 10px;
            color: #172554;
        }

        p {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 13px;
            margin-bottom: 18px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #1d4ed8;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .success {
            color: #15803d;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Reset Password</h2>
    <p>Buat kata sandi baru untuk akun MyUniv kamu.</p>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <label>Email</label>
        <input
            type="email"
            name="email"
            value="{{ old('email', $email) }}"
            required
        >

        <label>Password Baru</label>
        <input
            type="password"
            name="password"
            placeholder="Minimal 8 karakter"
            required
        >

        <label>Konfirmasi Password</label>
        <input
            type="password"
            name="password_confirmation"
            placeholder="Ulangi password baru"
            required
        >

        <button type="submit">Simpan Password Baru</button>
    </form>
</div>

</body>
</html>
