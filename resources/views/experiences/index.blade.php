<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Expériences
        </h2>
    </x-slot>

    <style>
        .kgv-admin{
            --bg: #0A0C10; --surface: #13161C; --border: #22262E;
            --text: #ECEDEE; --text-dim: #92979F; --accent: #B08949;
            background:var(--bg); color:var(--text);
            font-family:'Inter',sans-serif;
        }
        .kgv-admin h1,.kgv-admin h2{font-family:'Fraunces',serif;font-weight:500;}
        .kgv-admin label{display:block;font-size:0.8rem;color:var(--text-dim);margin-bottom:8px;}
        .kgv-admin input[type=text],
        .kgv-admin input[type=date],
        .kgv-admin textarea{
            width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);
            padding:11px 14px;border-radius:2px;font-family:inherit;font-size:0.9rem;
        }
        .kgv-admin input:focus, .kgv-admin textarea:focus{outline:none;border-color:var(--accent);}
        .kgv-admin input:disabled{opacity:0.4;cursor:not-allowed;}
        .kgv-admin .field{margin-bottom:20px;}
        .kgv-admin .field-error{color:#e08b8b;font-size:0.8rem;margin-top:6px;}
        .kgv-admin .required{color:var(--accent);}
        .kgv-panel{background:var(--surface);border:1px solid var(--border);border-radius:4px;padding:28px;}
        .panel-title{font-size:1.05rem;margin-bottom:20px;display:flex;align-items:center;gap:8px;}
        .kgv-admin .row-2{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
        .kgv-admin .checkbox-row{display:flex;align-items:center;gap:8px;margin-bottom:20px;font-size:0.82rem;color:var(--text-dim);}
        .kgv-admin .checkbox-row input{accent-color:var(--accent);}
        .kgv-admin .btn-submit{
            width:100%;background:var(--accent);color:#0A0C10;font-weight:600;font-size:0.9rem;
            padding:12px 20px;border:none;border-radius:2px;cursor:pointer;transition:background .2s;margin-top:6px;
        }
        .kgv-admin .btn-submit:hover{background:#c49957;}

        .exp-item{padding:24px 0;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;gap:16px;align-items:flex-start;}
        .exp-item:last-child{border-bottom:none;}
        .exp-title-row{display:flex;align-items:center;gap:10px;margin-bottom:4px;}
        .exp-title{font-size:1rem;font-weight:600;}
        .exp-badge{
            font-size:0.7rem;font-weight:600;padding:3px 10px;border-radius:10px;
            background:rgba(176,137,73,0.12);color:var(--accent);border:1px solid rgba(176,137,73,0.3);
        }
        .exp-org{color:var(--accent);font-size:0.88rem;font-weight:500;margin-bottom:6px;}
        .exp-dates{color:var(--text-dim);font-size:0.8rem;display:flex;align-items:center;gap:6px;margin-bottom:10px;}
        .exp-desc{color:#c7cad0;font-size:0.88rem;line-height:1.6;}
        .action-delete{color:#e08b8b;background:none;border:none;cursor:pointer;font-family:inherit;font-size:0.85rem;flex-shrink:0;}
        .empty-note{text-align:center;padding:48px 16px;color:var(--text-dim);}

        .kgv-modal-overlay{
            position:fixed;inset:0;z-index:50;background:rgba(0,0,0,0.6);
            display:none;align-items:center;justify-content:center;padding:16px;
        }
        .kgv-modal-overlay.open{display:flex;}
        .kgv-modal-box{background:#13161C;border:1px solid #22262E;border-radius:4px;max-width:420px;width:100%;padding:28px;}
        .kgv-modal-box h3{font-family:'Fraunces',serif;font-weight:500;color:#ECEDEE;font-size:1.1rem;margin-bottom:10px;}
        .kgv-modal-box p{color:#92979F;font-size:0.85rem;margin-bottom:22px;}
        .kgv-modal-actions{display:flex;justify-content:flex-end;gap:12px;}
        .kgv-modal-cancel{background:none;border:1px solid #22262E;color:#ECEDEE;padding:9px 16px;border-radius:2px;font-size:0.85rem;cursor:pointer;}
        .kgv-modal-confirm{background:#c0524f;border:none;color:#fff;padding:9px 16px;border-radius:2px;font-size:0.85rem;cursor:pointer;}

        @media(min-width:1024px){
            .experiences-layout{ grid-template-columns: 1fr 2fr !important; align-items:start; }
        }
    </style>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 kgv-admin">
            <div style="margin-bottom:28px;">
                <h1 style="font-size:1.5rem;">Expériences</h1>
                <p style="color:var(--text-dim);font-size:0.9rem;margin-top:4px;">
                    Gérez vos parcours professionnels, formations et projets significatifs.
                </p>
            </div>

            @if(session('success'))
                <div style="background:rgba(176,137,73,0.1);border:1px solid var(--accent);color:var(--accent);padding:12px 16px;border-radius:2px;font-size:0.85rem;margin-bottom:24px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="display:grid;grid-template-columns:1fr;gap:24px;" class="experiences-layout">
                <!-- FORMULAIRE -->
                <div class="kgv-panel">
                    <h2 class="panel-title">Ajouter une expérience</h2>

                    <form action="{{ route('experiences.store') }}" method="POST">
                        @csrf

                        <div class="field">
                            <label for="poste_ou_diplome">Poste / Diplôme <span class="required">*</span></label>
                            <input type="text" name="poste_ou_diplome" id="poste_ou_diplome" value="{{ old('poste_ou_diplome') }}" placeholder="Ex : Développeuse Full Stack" required>
                            @error('poste_ou_diplome') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label for="entreprise">Entreprise / École <span class="required">*</span></label>
                            <input type="text" name="entreprise" id="entreprise" value="{{ old('entreprise') }}" placeholder="Ex : Tech Company / Université" required>
                            @error('entreprise') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field row-2">
                            <div>
                                <label for="date_debut">Début <span class="required">*</span></label>
                                <input type="date" name="date_debut" id="date_debut" value="{{ old('date_debut') }}" required>
                                @error('date_debut') <div class="field-error">{{ $message }}</div> @enderror
                            </div>
                            <div>
                                <label for="date_fin">Fin</label>
                                <input type="date" name="date_fin" id="date_fin" value="{{ old('date_fin') }}">
                                @error('date_fin') <div class="field-error">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="checkbox-row">
                            <input type="checkbox" id="is_current">
                            <label for="is_current" style="margin-bottom:0;">J'occupe actuellement ce poste</label>
                        </div>

                        <div class="field">
                            <label for="description">Description <span class="required">*</span></label>
                            <textarea name="description" id="description" rows="3" placeholder="Missions réalisées, technologies utilisées..." required>{{ old('description') }}</textarea>
                            @error('description') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn-submit">Ajouter l'expérience</button>
                    </form>
                </div>

                <!-- LISTE -->
                <div class="kgv-panel">
                    <h2 class="panel-title">Parcours &amp; Expériences</h2>

                    <div>
                        @forelse($experiences as $experience)
                            <div class="exp-item">
                                <div style="flex:1;">
                                    <div class="exp-title-row">
                                        <span class="exp-title">{{ $experience->poste_ou_diplome }}</span>
                                        @if(!$experience->date_fin)
                                            <span class="exp-badge">En cours</span>
                                        @endif
                                    </div>
                                    <div class="exp-org">{{ $experience->entreprise }}</div>
                                    <div class="exp-dates">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $experience->date_debut ? \Illuminate\Support\Carbon::parse($experience->date_debut)->format('m/Y') : 'N/A' }}
                                        —
                                        {{ $experience->date_fin ? \Illuminate\Support\Carbon::parse($experience->date_fin)->format('m/Y') : 'Présent' }}
                                    </div>
                                    @if($experience->description)
                                        <div class="exp-desc">{{ $experience->description }}</div>
                                    @endif
                                </div>

                                <form action="{{ route('experiences.destroy', $experience) }}" method="POST" class="form-delete-exp">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete-exp action-delete">Supprimer</button>
                                </form>
                            </div>
                        @empty
                            <div class="empty-note">Aucune expérience renseignée pour le moment.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale de suppression -->
    <div id="delete-exp-modal" class="kgv-modal-overlay">
        <div class="kgv-modal-box">
            <h3>Supprimer l'expérience</h3>
            <p>Voulez-vous vraiment retirer cette expérience ? Cette action est irréversible.</p>
            <div class="kgv-modal-actions">
                <button id="modal-exp-cancel" type="button" class="kgv-modal-cancel">Annuler</button>
                <button id="modal-exp-confirm" type="button" class="kgv-modal-confirm">Supprimer</button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const currentCheckbox = document.getElementById('is_current');
            const endDateInput = document.getElementById('date_fin');

            if (currentCheckbox && endDateInput) {
                const toggleEndDate = () => {
                    endDateInput.disabled = currentCheckbox.checked;
                    if (currentCheckbox.checked) endDateInput.value = '';
                };
                currentCheckbox.addEventListener('change', toggleEndDate);
            }

            const deleteModal = document.getElementById('delete-exp-modal');
            const cancelBtn = document.getElementById('modal-exp-cancel');
            const confirmBtn = document.getElementById('modal-exp-confirm');
            let formToSubmit = null;

            document.querySelectorAll('.btn-delete-exp').forEach(button => {
                button.addEventListener('click', (event) => {
                    formToSubmit = event.target.closest('.form-delete-exp');
                    deleteModal.classList.add('open');
                });
            });

            cancelBtn.addEventListener('click', () => {
                deleteModal.classList.remove('open');
                formToSubmit = null;
            });

            confirmBtn.addEventListener('click', () => {
                if (formToSubmit) formToSubmit.submit();
            });

            deleteModal.addEventListener('click', (event) => {
                if (event.target === deleteModal) {
                    deleteModal.classList.remove('open');
                    formToSubmit = null;
                }
            });
        });
    </script>
    @endpush
</x-app-layout>