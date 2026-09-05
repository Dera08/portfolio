<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <style>
        .kgv-admin{
            --bg: #0A0C10; --surface: #13161C; --border: #22262E;
            --text: #ECEDEE; --text-dim: #92979F; --accent: #B08949;
            background:var(--bg); color:var(--text);
            font-family:'Inter',sans-serif;
            border-radius:4px;
            padding:40px;
        }
        .kgv-admin h1,.kgv-admin h3{font-family:'Fraunces',serif;font-weight:500;}
        .kgv-admin .welcome-line{color:var(--text-dim);font-size:0.95rem;margin-bottom:40px;}
        .kgv-admin .welcome-line strong{color:var(--text);font-weight:600;}

        .kgv-stats{
            display:grid;grid-template-columns:repeat(auto-fit, minmax(180px, 1fr));
            gap:1px;background:var(--border);border:1px solid var(--border);
            margin-bottom:48px;border-radius:2px;overflow:hidden;
        }
        .kgv-stat{background:var(--surface);padding:24px;}
        .kgv-stat .num{font-family:'Fraunces',serif;font-size:2.2rem;color:var(--accent);line-height:1;}
        .kgv-stat .label{color:var(--text-dim);font-size:0.85rem;margin-top:8px;}

        .kgv-quicklinks{
            display:grid;grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
            gap:16px;
        }
        .kgv-qlink{
            display:block;background:var(--surface);border:1px solid var(--border);
            padding:20px 22px;border-radius:2px;transition:border-color .2s;
        }
        .kgv-qlink:hover{border-color:var(--accent);}
        .kgv-qlink .qlink-title{font-weight:600;font-size:0.95rem;margin-bottom:6px;}
        .kgv-qlink .qlink-desc{color:var(--text-dim);font-size:0.82rem;}
    </style>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="kgv-admin">
                <h1 style="font-size:1.5rem;margin-bottom:10px;">Tableau de bord</h1>
                <p class="welcome-line">
                    Connectée en tant que <strong>{{ auth()->user()->nom }}</strong>. Voici un aperçu de votre portfolio.
                </p>

                <div class="kgv-stats">
                    <div class="kgv-stat">
                        <div class="num">{{ $projetsCount }}</div>
                        <div class="label">Projet{{ $projetsCount > 1 ? 's' : '' }}</div>
                    </div>
                    <div class="kgv-stat">
                        <div class="num">{{ $skillsCount }}</div>
                        <div class="label">Compétence{{ $skillsCount > 1 ? 's' : '' }}</div>
                    </div>
                    <div class="kgv-stat">
                        <div class="num">{{ $experiencesCount }}</div>
                        <div class="label">Expérience{{ $experiencesCount > 1 ? 's' : '' }}</div>
                    </div>
                </div>

                <div class="kgv-quicklinks">
                    <a href="{{ route('projets.index') }}" class="kgv-qlink">
                        <div class="qlink-title">Gérer les projets</div>
                        <div class="qlink-desc">Ajouter, modifier ou supprimer une réalisation.</div>
                    </a>
                    <a href="{{ route('skills.index') }}" class="kgv-qlink">
                        <div class="qlink-title">Gérer les compétences</div>
                        <div class="qlink-desc">Mettre à jour vos compétences techniques.</div>
                    </a>
                    <a href="{{ route('experiences.index') }}" class="kgv-qlink">
                        <div class="qlink-title">Gérer les expériences</div>
                        <div class="qlink-desc">Ajouter un parcours ou une formation.</div>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="kgv-qlink">
                        <div class="qlink-title">Mon profil</div>
                        <div class="qlink-desc">Modifier votre bio, photo et informations.</div>
                    </a>
                    <a href="{{ url('/') }}" class="kgv-qlink">
                        <div class="qlink-title">Voir le portfolio public</div>
                        <div class="qlink-desc">Ouvrir la page visible par vos visiteurs.</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>