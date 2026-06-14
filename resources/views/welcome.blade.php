<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="Cardiac & cardiothoracic surgery — public site coming soon.">
    <style>
        :root { color-scheme: light dark; }
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif; margin: 0; min-height: 100vh; display: grid; place-items: center; background: #0b1220; color: #e6edf6; }
        main { text-align: center; padding: 2rem; max-width: 38rem; }
        h1 { font-size: clamp(1.6rem, 4vw, 2.4rem); margin: 0 0 .5rem; }
        p { color: #9fb0c3; line-height: 1.6; }
        .badge { display: inline-block; padding: .25rem .75rem; border: 1px solid #b42318; color: #ff6b5e; border-radius: 999px; font-size: .8rem; letter-spacing: .05em; text-transform: uppercase; margin-bottom: 1rem; }
        a { color: #ff6b5e; }
    </style>
</head>
<body>
    <main>
        <span class="badge">Phase 1 · Foundation</span>
        <h1>{{ config('app.name') }}</h1>
        <p>Project scaffold is in place. The public site (Phase 2) and blog (Phase 3) will render here. The admin dashboard is at <a href="/admin">/admin</a>.</p>
    </main>
</body>
</html>
