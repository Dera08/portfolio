<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le Projet
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
        .kgv-admin .field-hint{color:var(--text-dim);font-size:0.8rem;margin-top:6px;}
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
        .kgv-admin .current-image{
            width:120px;height:120px;object-fit:cover;border-radius:2px;
            border:1px solid var(--border);margin-bottom:14px;display:block;
        }
        @media(max-width:640px){.kgv-admin .row-2{grid-template-columns:1fr;}}
    </style>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="kgv-admin">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:36px;">
                    <div>
                        <h1 style="font-size:1.5rem;margin-bottom:6px;">Modifier le projet</h1>
                        <p style="color:var(--text-dim);font-size:0.9rem;">
                            Mettez à jour les détails de ce projet.
                        </p>
                    </div>
                    <a href="{{ route('projets.index') }}" style="font-size:0.85rem;color:var(--text-dim);white-space:nowrap;">
                        ← Retour aux projets
                    </a>
                </div>

                <form action="{{ route('projets.update', $projet) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="field">
                        <label for="titre">Titre <span class="required">*</span></label>
                        <input type="text" name="titre" id="titre" value="{{ old('titre', $projet->titre) }}" placeholder="Ex : Application de gestion de stock" required>
                        @error('titre') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="description">Description <span class="required">*</span></label>
                        <textarea name="description" id="description" rows="4" required>{{ old('description', $projet->description) }}</textarea>
                        @error('description') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field">
                        <label for="image">Image</label>
                        @if($projet->image)
                            <img src="{{ Illuminate\Support\Facades\Storage::url($projet->image) }}" alt="{{ $projet->titre }}" class="current-image">
                        @endif
                        <input type="file" name="image" id="image">
                        <p class="field-hint">Laissez vide pour conserver l'image actuelle.</p>
                        @error('image') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="field row-2">
                        <div>
                            <label for="lien_demo">Lien démo</label>
                            <input type="url" name="lien_demo" id="lien_demo" value="{{ old('lien_demo', $projet->lien_demo) }}" placeholder="https://mon-projet.com">
                            @error('lien_demo') <div class="field-error">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label for="lien_github">Lien GitHub</label>
                            <input type="url" name="lien_github" id="lien_github" value="{{ old('lien_github', $projet->lien_github) }}" placeholder="https://github.com/votre-compte/projet">
                            @error('lien_github') <div class="field-error">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="date_realisation">Date de réalisation <span class="required">*</span></label>
                        <input type="date" name="date_realisation" id="date_realisation"
                            value="{{ old('date_realisation', \Illuminate\Support\Carbon::parse($projet->date_realisation)->format('Y-m-d')) }}" required>
                        @error('date_realisation') <div class="field-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="actions">
                        <a href="{{ route('projets.index') }}" class="btn-cancel">Annuler</a>
                        <button type="submit" class="btn-submit">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>