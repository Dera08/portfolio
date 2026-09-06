<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Compétences
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
        .kgv-admin input[type=file],
        .kgv-admin textarea{
            width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);
            padding:11px 14px;border-radius:2px;font-family:inherit;font-size:0.9rem;
        }
        .kgv-admin input:focus, .kgv-admin textarea:focus{outline:none;border-color:var(--accent);}
        .kgv-admin .field{margin-bottom:20px;}
        .kgv-admin .field-error{color:#e08b8b;font-size:0.8rem;margin-top:6px;}
        .kgv-admin .required{color:var(--accent);}
        .kgv-panel{background:var(--surface);border:1px solid var(--border);border-radius:4px;padding:28px;}
        .kgv-admin input[type=range]{width:100%;accent-color:var(--accent);}
        .kgv-level-value{font-size:0.8rem;font-weight:600;color:var(--accent);}
        .kgv-admin .btn-submit{
            width:100%;background:var(--accent);color:#0A0C10;font-weight:600;font-size:0.9rem;
            padding:12px 20px;border:none;border-radius:2px;cursor:pointer;transition:background .2s;margin-top:6px;
        }
        .kgv-admin .btn-submit:hover{background:#c49957;}

        .kgv-admin table{width:100%;border-collapse:collapse;}
        .kgv-admin thead th{
            text-align:left;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.03em;
            color:var(--text-dim);font-weight:500;padding:12px 16px;border-bottom:1px solid var(--border);
        }
        .kgv-admin tbody td{padding:16px;border-bottom:1px solid var(--border);font-size:0.88rem;vertical-align:middle;}
        .kgv-admin tbody tr:hover{background:rgba(255,255,255,0.02);}
        .kgv-admin .skill-name{font-weight:600;}
        .kgv-admin .skill-desc{color:var(--text-dim);font-size:0.8rem;margin-top:2px;}
        .kgv-track{height:6px;background:var(--border);border-radius:3px;overflow:hidden;width:100%;}
        .kgv-fill{height:100%;background:var(--accent);}
        .kgv-admin .action-delete{color:#e08b8b;background:none;border:none;cursor:pointer;font-family:inherit;font-size:0.85rem;}
        .kgv-admin .empty-row{text-align:center;padding:40px 16px;color:var(--text-dim);}
        .panel-title{font-size:1.05rem;margin-bottom:20px;display:flex;align-items:center;gap:8px;}

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
    </style>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 kgv-admin">
            <div style="margin-bottom:28px;">
                <h1 style="font-size:1.5rem;">Compétences</h1>
                <p style="color:var(--text-dim);font-size:0.9rem;margin-top:4px;">
                    Gérez vos compétences techniques et leur niveau de maîtrise.
                </p>
            </div>

            @if(session('success'))
                <div style="background:rgba(176,137,73,0.1);border:1px solid var(--accent);color:var(--accent);padding:12px 16px;border-radius:2px;font-size:0.85rem;margin-bottom:24px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="display:grid;grid-template-columns:1fr;gap:24px;">
                <div class="kgv-grid" style="display:grid;grid-template-columns:1fr;gap:24px;">
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr;gap:24px;" class="skills-layout">
                <!-- FORMULAIRE -->
                <div class="kgv-panel">
                    <h2 class="panel-title">Ajouter une compétence</h2>

                    <form action="{{ route('skills.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="field">
                            <label for="titre">Nom <span class="required">*</span></label>
                            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" placeholder="Ex : Laravel, React, Tailwind CSS" required>
                            @error('titre') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="2" placeholder="Ex : Développement backend, API REST...">{{ old('description') }}</textarea>
                            @error('description') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label for="image">Logo / Icône</label>
                            <input type="file" name="image" id="image">
                            @error('image') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                                <label for="niveau" style="margin-bottom:0;">Niveau</label>
                                <span id="niveau-value" class="kgv-level-value">{{ old('niveau', 80) }}%</span>
                            </div>
                            <input type="range" name="niveau" id="niveau" min="0" max="100" value="{{ old('niveau', 80) }}">
                            @error('niveau') <div class="field-error">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn-submit">Ajouter la compétence</button>
                    </form>
                </div>

                <!-- LISTE -->
                <div class="kgv-panel">
                    <h2 class="panel-title">Compétences enregistrées</h2>

                    <div style="overflow-x:auto;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Compétence</th>
                                    <th>Niveau</th>
                                    <th style="text-align:right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($skills as $skill)
                                    <tr>
                                        <td>
                                            <div class="skill-name">{{ $skill->titre }}</div>
                                            @if($skill->description)
                                                <div class="skill-desc">{{ $skill->description }}</div>
                                            @endif
                                        </td>
                                        <td style="width:200px;">
                                            <div style="display:flex;align-items:center;gap:10px;">
                                                <div class="kgv-track">
                                                    <div class="kgv-fill" style="width: {{ is_numeric($skill->niveau) ? $skill->niveau : 70 }}%"></div>
                                                </div>
                                                <span style="font-size:0.78rem;color:var(--text-dim);white-space:nowrap;">{{ $skill->niveau }}{{ is_numeric($skill->niveau) ? '%' : '' }}</span>
                                            </div>
                                        </td>
                                        <td style="text-align:right;">
                                            <form action="{{ route('skills.destroy', $skill) }}" method="POST" class="form-delete-skill" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-delete-skill action-delete">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="empty-row">Aucune compétence enregistrée pour le moment.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modale de suppression -->
    <div id="delete-skill-modal" class="kgv-modal-overlay">
        <div class="kgv-modal-box">
            <h3>Supprimer la compétence</h3>
            <p>Voulez-vous vraiment retirer cette compétence ? Cette action est irréversible.</p>
            <div class="kgv-modal-actions">
                <button id="modal-skill-cancel" type="button" class="kgv-modal-cancel">Annuler</button>
                <button id="modal-skill-confirm" type="button" class="kgv-modal-confirm">Supprimer</button>
            </div>
        </div>
    </div>

    @push('scripts')
    <style>
        @media(min-width:1024px){
            .skills-layout{ grid-template-columns: 1fr 2fr !important; align-items:start; }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const niveauRange = document.getElementById('niveau');
            const niveauValue = document.getElementById('niveau-value');
            if (niveauRange && niveauValue) {
                niveauRange.addEventListener('input', (e) => {
                    niveauValue.textContent = `${e.target.value}%`;
                });
            }

            const deleteModal = document.getElementById('delete-skill-modal');
            const cancelBtn = document.getElementById('modal-skill-cancel');
            const confirmBtn = document.getElementById('modal-skill-confirm');
            let formToSubmit = null;

            document.querySelectorAll('.btn-delete-skill').forEach(button => {
                button.addEventListener('click', (event) => {
                    formToSubmit = event.currentTarget.closest('.form-delete-skill');
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