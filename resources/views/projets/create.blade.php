<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nouveau Projet
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
        .kgv-admin label{
            display:block;font-size:0.8rem;color:var(--text-dim);margin-bottom:8px;
        }
        .kgv-admin input[type=text],
        .kgv-admin input[type=url],
        .kgv-admin input[type=date],
        .kgv-admin input[type=file],
        .kgv-admin textarea{
            width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);
            padding:12px 14px;border-radius:2px;font-family:inherit;font-size:0.9rem;
        }
        .kgv-admin input:focus, .kgv-admin textarea:focus{outline:none;border-color:var(--accent);}
        .kgv-admin .field{margin-bottom:26px;}
        .kgv-admin .field-error{color:#e08b8b;font-size:0.8rem;margin-top:6px;}
        .kgv-admin .row-2{display:grid;grid-template-columns:1fr 1fr;gap:24px;}
        .kgv-admin .actions{
            display:flex;justify-content:flex-end;gap:16px;padding-top:24px;
            border-top:1px solid var(--border);margin-top:8px;
        }
        .kgv-admin .btn-cancel{
            font-size:0.9rem;color:var(--text-dim);padding:12px 20px;border-radius:2px;
            transition:color .2s;
        }
        .kgv-admin .btn-cancel:hover{color:var(--text);}
        .kgv-admin .btn-submit{
            background:var(--accent);color:#0A0C10;font-weight:600;font-size:0.9rem;
            padding:12px 28px;border:none;border-radius:2px;cursor:pointer;transition:background .2s;
        }
        .kgv-admin .btn-submit:hover{background:#c49957;}
        .kgv-admin .required{color:var(--accent);}
        @media(max-width:640px){.kgv-admin .row-2{grid-template-columns:1fr;}}
    </style>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="kgv-admin">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:36px;">
                    <div>
                        <h1 style="font-size:1.5rem;margin-bottom:6px;">Nouveau projet</h1>
                        <p style="color:var(--text-dim);font-size:0.9rem;">
                            Ajoutez une réalisation à votre portfolio public.
                        </p>
                    </div>
                    <a href="{{ route('projets.index') }}" style="font-size:0.85rem;color:var(--text-dim);white-space:nowrap;">
                        ← Retour aux projets
                    </a>
                </div>

                <form action="{{ route('projets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="field">
                        <label for="titre">Titre <span class="required">*</span></label>
                        <input type="text" name="titre" id="titre" value="{{ old('titre') }}" placeholder="Ex : Application de gestion de stock" required>
                        @error('titre') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="description">Description <span class="required">*</span></label>
                        <textarea name="description" id="description" rows="4" placeholder="Décrivez les fonctionnalités et objectifs de ce projet..." required>{{ old('description') }}</textarea>
                        @error('description') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image">
                        @error('image') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field row-2">
                        <div>
                            <label for="lien_demo">Lien démo</label>
                            <input type="url" name="lien_demo" id="lien_demo" value="{{ old('lien_demo') }}" placeholder="https://mon-projet.com">
                            @error('lien_demo') <div class="field-error">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label for="lien_github">Lien GitHub</label>
                            <input type="url" name="lien_github" id="lien_github" value="{{ old('lien_github') }}" placeholder="https://github.com/votre-compte/projet">
                            @error('lien_github') <div class="field-error">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="date_realisation">Date de réalisation <span class="required">*</span></label>
                        <input type="date" name="date_realisation" id="date_realisation" value="{{ old('date_realisation') }}" required>
                        @error('date_realisation') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="actions">
                        <a href="{{ route('projets.index') }}" class="btn-cancel">Annuler</a>
                        <button type="submit" class="btn-submit">Créer le projet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>