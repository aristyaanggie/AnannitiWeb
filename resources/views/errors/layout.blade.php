@props([
    'errorCode' => 'Error',
    'errorTitle' => 'Something Went Wrong',
    'errorMessage' => 'An unexpected error occurred.',
    'errorHint' => 'Please try again later.',
])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $errorCode }} — {{ config('app.name', 'Ananniti Tattoo Bali') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            background: #0a0a0a;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            -webkit-font-smoothing: antialiased;
        }
        .card { text-align: center; max-width: 480px; }
        .code {
            font-family: ui-monospace, 'SF Mono', Menlo, monospace;
            font-size: clamp(4rem, 16vw, 7rem);
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.04em;
            background: linear-gradient(135deg, #ffffff 0%, #9c9c9c 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 16px;
        }
        .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.6);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 999px;
            padding: 6px 16px;
            margin-bottom: 24px;
        }
        h1 { font-size: 24px; font-weight: 700; margin-bottom: 10px; }
        p { font-size: 14px; line-height: 1.6; color: rgba(255,255,255,0.65); margin-bottom: 6px; }
        .actions { margin-top: 28px; display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-primary { background: #ffffff; color: #0a0a0a; }
        .btn-primary:hover { background: #e5e5e5; }
        .btn-outline { border: 1px solid rgba(255,255,255,0.25); color: #ffffff; }
        .btn-outline:hover { background: rgba(255,255,255,0.08); }
        .footer { margin-top: 40px; font-size: 12px; color: rgba(255,255,255,0.35); letter-spacing: 0.05em; }
    </style>
</head>
<body>
    <div class="card">
        <div class="code">{{ $errorCode }}</div>
        <div class="badge">{{ $errorTitle }}</div>
        <h1>{{ $errorTitle }}</h1>
        <p>{{ $errorMessage }}</p>
        <p>{{ $errorHint }}</p>
        <div class="actions">
            <a href="{{ url()->previous() ?? url('/') }}" class="btn btn-outline">Kembali</a>
            <a href="{{ url('/') }}" class="btn btn-primary">Ke Beranda</a>
        </div>
        <div class="footer">Ananniti Tattoo Bali</div>
    </div>
</body>
</html>
