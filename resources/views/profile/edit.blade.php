<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profil
        </h2>
    </x-slot>

    <style>
        .kgv-admin{
            --bg: #0A0C10; --surface: #13161C; --border: #22262E;
            --text: #ECEDEE; --text-dim: #92979F; --accent: #B08949;
            background:var(--bg); color:var(--text);
            font-family:'Inter',sans-serif;
            border-radius:4px;
        }
        .kgv-admin h1,.kgv-admin h2{font-family:'Fraunces',serif;font-weight:500;}
        .kgv-card{padding:32px;border-bottom:1px solid var(--border);}
        .kgv-card:last-child{border-bottom:none;}
        .kgv-card h2{font-size:1.1rem;margin-bottom:20px;}
        .kgv-admin label{display:block;font-size:0.8rem;color:var(--text-dim);margin-bottom:8px;}
        .kgv-admin input[type=text],
        .kgv-admin input[type=email],
        .kgv-admin input[type=password]{
            width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);
            padding:12px 14px;border-radius:2px;font-family:inherit;font-size:0.9rem;max-width:480px;
        }
        .kgv-admin input:focus{outline:none;border-color:var(--accent);}
        .kgv-admin .field{margin-bottom:22px;}
        .kgv-admin .field-error{color:#e08b8b;font-size:0.8rem;margin-top:6px;}
        .kgv-admin .required{color:var(--accent);}
        .kgv-admin .btn-submit{
            background:var(--accent);color:#0A0C10;font-weight:600;font-size:0.9rem;
            padding:12px 24px;border:none;border-radius:2px;cursor:pointer;transition:background .2s;
        }
        .kgv-admin .btn-submit:hover{background:#c49957;}
        .kgv-admin .btn-danger{
            background:transparent;color:#e08b8b;border:1px solid #4a3230;font-weight:600;font-size:0.9rem;
            padding:12px 24px;border-radius:2px;cursor:pointer;transition:background .2s;
        }
        .kgv-admin .btn-danger:hover{background:rgba(224,139,139,0.08);}
        .kgv-admin .status-msg{
            background:rgba(176,137,73,0.1);border:1px solid var(--accent);color:var(--accent);
            padding:12px 16px;border-radius:2px;font-size:0.85rem;margin-bottom:20px;
        }
        .kgv-admin .danger-text{color:var(--text-dim);font-size:0.85rem;margin-bottom:20px;max-width:56ch;}
    </style>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="kgv-admin">

                <!-- Informations générales -->
                <div class="kgv-card">
                    <h2>Informations générales</h2>

                    @if (session('status') === 'profile-updated')
                        <div class="status-msg">Vos modifications ont été enregistrées avec succès.</div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="field">
                            <label for="photo_profil">Photo de profil</label>
                            @if($user->photo_profil)
                                <img src="{{ Illuminate\Support\Facades\Storage::url($user->photo_profil) }}" alt="{{ $user->nom }}" style="width:100px;height:100px;object-fit:cover;border-radius:2px;border:1px solid var(--border);margin-bottom:12px;display:block;">
                            @endif
                            <input type="file" name="photo_profil" id="photo_profil">
                            @error('photo_profil') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label for="nom">Nom complet <span class="required">*</span></label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom', $user->nom) }}" required>
                            @error('nom') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label for="email">Adresse e-mail <span class="required">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                            @error('email') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label for="titre_professionnel">Titre professionnel</label>
                            <input type="text" name="titre_professionnel" id="titre_professionnel" value="{{ old('titre_professionnel', $user->titre_professionnel) }}" placeholder="Ex : Développeuse full-stack">
                            @error('titre_professionnel') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label for="bio">Description / À propos</label>
                            <textarea name="bio" id="bio" rows="4" placeholder="Parlez de vous, votre parcours, votre approche...">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label for="telephone">Téléphone</label>
                            <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $user->telephone) }}">
                            @error('telephone') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn-submit">Enregistrer</button>
                    </form>
                </div>

                <!-- Mot de passe -->
                <div class="kgv-card">
                    <h2>Mettre à jour le mot de passe</h2>

                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="field">
                            <label for="current_password">Mot de passe actuel</label>
                            <input type="password" name="current_password" id="current_password">
                            @error('current_password', 'updatePassword') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label for="password">Nouveau mot de passe</label>
                            <input type="password" name="password" id="password">
                            @error('password', 'updatePassword') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                            <input type="password" name="password_confirmation" id="password_confirmation">
                        </div>

                        <button type="submit" class="btn-submit">Mettre à jour</button>
                    </form>
                </div>

                <!-- Suppression du compte -->
                <div class="kgv-card">
                    <h2>Supprimer le compte</h2>
                    <p class="danger-text">
                        Une fois votre compte supprimé, toutes ses données seront définitivement effacées.
                        Téléchargez toute information que vous souhaitez conserver avant de continuer.
                    </p>

                    <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ? Cette action est irréversible.');">
                        @csrf
                        @method('DELETE')

                        <div class="field">
                            <label for="password_delete">Mot de passe</label>
                            <input type="password" name="password" id="password_delete">
                            @error('password', 'userDeletion') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn-danger">Supprimer mon compte</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>