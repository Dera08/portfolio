<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root{
                --admin-bg: #0A0C10;
                --admin-surface: #13161C;
                --admin-border: #22262E;
                --admin-text: #ECEDEE;
                --admin-text-dim: #92979F;
                --admin-accent: #B08949;
            }
            body{ font-family:'Inter',sans-serif; background:var(--admin-bg); margin:0; }

            /* NAV HORIZONTALE - même identité que le portfolio public */
            .admin-nav{
                position:sticky; top:0; z-index:50;
                background:rgba(10,12,16,0.85); backdrop-filter:blur(8px);
                border-bottom:1px solid var(--admin-border);
            }
            .admin-nav-inner{
                max-width:1200px; margin:0 auto; padding:0 32px;
                height:72px; display:flex; align-items:center; justify-content:space-between;
            }
            .admin-brand{
                font-family:'Fraunces',serif; font-size:1.05rem; font-weight:500; color:var(--admin-text);
                display:flex; align-items:center; gap:10px; text-decoration:none;
            }
            .admin-brand-mark{
                width:28px;height:28px;border:1px solid var(--admin-accent);border-radius:2px;
                display:flex;align-items:center;justify-content:center;
                font-size:0.7rem;color:var(--admin-accent);
            }
            .admin-links{ display:flex; gap:8px; align-items:center; }
            .admin-links a{
                color:var(--admin-text-dim); font-size:0.88rem; text-decoration:none;
                padding:9px 14px; border-radius:2px; transition:color .15s, background .15s;
            }
            .admin-links a:hover{ color:var(--admin-text); background:rgba(255,255,255,0.03); }
            .admin-links a.active{ color:var(--admin-text); background:rgba(176,137,73,0.1); }

            .admin-right{ display:flex; align-items:center; gap:16px; }
            .admin-user-toggle{
                display:flex; align-items:center; gap:8px; background:none; border:1px solid var(--admin-border);
                color:var(--admin-text); font-size:0.85rem; padding:8px 14px; border-radius:2px; cursor:pointer;
                font-family:inherit; transition:border-color .15s;
            }
            .admin-user-toggle:hover{ border-color:var(--admin-accent); }
            .admin-dropdown{
                position:relative;
            }
            .admin-dropdown-menu{
                position:absolute; right:0; top:calc(100% + 8px); background:var(--admin-surface);
                border:1px solid var(--admin-border); border-radius:2px; min-width:180px;
                padding:6px; z-index:60; box-shadow:0 8px 24px rgba(0,0,0,0.4);
            }
            .admin-dropdown-menu a, .admin-dropdown-menu button{
                display:block; width:100%; text-align:left; color:var(--admin-text-dim);
                font-size:0.85rem; padding:9px 12px; border-radius:2px; background:none; border:none;
                cursor:pointer; font-family:inherit; text-decoration:none;
            }
            .admin-dropdown-menu a:hover, .admin-dropdown-menu button:hover{
                background:rgba(255,255,255,0.04); color:var(--admin-text);
            }
            .admin-dropdown-email{
                padding:9px 12px; font-size:0.78rem; color:var(--admin-text-dim);
                border-bottom:1px solid var(--admin-border); margin-bottom:4px;
            }

            /* Mobile hamburger */
            .admin-hamburger{ display:none; background:none; border:none; color:var(--admin-text); cursor:pointer; }
            @media(max-width:900px){
                .admin-links{ display:none; }
                .admin-hamburger{ display:block; }
            }
            .admin-mobile-menu{
                display:none; flex-direction:column; padding:12px 20px 20px; gap:2px;
                border-top:1px solid var(--admin-border);
            }
            .admin-mobile-menu.open{ display:flex; }
            .admin-mobile-menu a{
                color:var(--admin-text-dim); font-size:0.9rem; padding:10px 8px; text-decoration:none; border-radius:2px;
            }
            .admin-mobile-menu a.active{ color:var(--admin-text); background:rgba(176,137,73,0.1); }
            .admin-mobile-menu .divider{ border-top:1px solid var(--admin-border); margin:8px 0; }

            /* HEADER (titre de page) */
            .admin-header{
                background:var(--admin-surface); border-bottom:1px solid var(--admin-border);
                padding:24px 32px;
            }
            .admin-header-inner{ max-width:1200px; margin:0 auto; }
            .admin-header h2{
                font-family:'Fraunces',serif; font-weight:500; color:var(--admin-text); font-size:1.3rem;
            }

            /* Bouton de fichier stylisé */
            input[type=file]{ color:var(--admin-text-dim); font-size:0.85rem; }
            input[type=file]::-webkit-file-upload-button{
                background:var(--admin-accent); color:#0A0C10; border:none;
                padding:9px 16px; border-radius:2px; font-weight:600; font-size:0.8rem;
                margin-right:14px; cursor:pointer; font-family:'Inter',sans-serif;
                transition:background .2s;
            }
            input[type=file]::-webkit-file-upload-button:hover{ background:#c49957; }
        </style>
    </head>
    <body>
        @include('layouts.navigation')

        @isset($header)
            <header class="admin-header">
                <div class="admin-header-inner">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>

        @stack('scripts')
    </body>
</html>