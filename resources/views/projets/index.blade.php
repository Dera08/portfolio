<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Projets
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
        .kgv-admin h1{font-family:'Fraunces',serif;font-weight:500;}
        .kgv-admin .top-bar{
            display:flex;flex-direction:column;gap:16px;margin-bottom:32px;
        }
        @media(min-width:768px){
            .kgv-admin .top-bar{flex-direction:row;align-items:center;justify-content:space-between;}
        }
        .kgv-admin .subtitle{color:var(--text-dim);font-size:0.9rem;margin-top:4px;}
        .kgv-admin .btn-new{
            background:var(--accent);color:#0A0C10;font-weight:600;font-size:0.85rem;
            padding:11px 20px;border-radius:2px;display:inline-flex;align-items:center;gap:8px;
            transition:background .2s;white-space:nowrap;
        }
        .kgv-admin .btn-new:hover{background:#c49957;}
        .kgv-admin .flash{
            background:rgba(176,137,73,0.1);border:1px solid var(--accent);color:var(--accent);
            padding:14px 18px;border-radius:2px;margin-bottom:24px;font-size:0.9rem;
            display:flex;justify-content:space-between;align-items:center;
        }
        .kgv-admin .flash button{background:none;border:none;color:var(--accent);font-size:1.2rem;cursor:pointer;}
        .kgv-admin .search-bar{
            display:flex;flex-direction:column;gap:12px;margin-bottom:28px;
        }
        @media(min-width:768px){.kgv-admin .search-bar{flex-direction:row;}}
        .kgv-admin .search-bar input[type=text]{
            flex:1;background:var(--surface);border:1px solid var(--border);color:var(--text);
            padding:11px 16px;border-radius:2px;font-family:inherit;font-size:0.9rem;
        }
        .kgv-admin .search-bar input:focus{outline:none;border-color:var(--accent);}
        .kgv-admin .btn-filter{
            background:var(--surface);border:1px solid var(--border);color:var(--text);
            padding:11px 20px;border-radius:2px;font-size:0.85rem;cursor:pointer;white-space:nowrap;
        }
        .kgv-admin .btn-reset{
            background:transparent;border:1px solid var(--border);color:var(--text-dim);
            padding:11px 20px;border-radius:2px;font-size:0.85rem;white-space:nowrap;
        }
        .kgv-admin table{width:100%;border-collapse:collapse;}
        .kgv-admin thead th{
            text-align:left;font-size:0.75rem;color:var(--text-dim);font-weight:500;
            padding:14px 16px;border-bottom:1px solid var(--border);
        }
        .kgv-admin tbody td{
            padding:18px 16px;border-bottom:1px solid var(--border);font-size:0.88rem;vertical-align:middle;
        }
        .kgv-admin tbody tr:hover{background:rgba(255,255,255,0.02);}
        .kgv-admin .proj-title{font-weight:600;margin-bottom:4px;}
        .kgv-admin .proj-desc{color:var(--text-dim);font-size:0.82rem;}
        .kgv-admin .proj-link{color:var(--accent);margin-right:14px;font-size:0.85rem;}
        .kgv-admin .proj-link:hover{text-decoration:underline;}
        .kgv-admin .action-edit{color:var(--accent);font-size:0.85rem;margin-right:16px;}
        .kgv-admin .action-delete{color:#e08b8b;font-size:0.85rem;background:none;border:none;cursor:pointer;font-family:inherit;}
        .kgv-admin .empty-row{text-align:center;padding:48px 16px;color:var(--text-dim);}
        .kgv-admin .pagination-wrap{padding-top:20px;border-top:1px solid var(--border);margin-top:8px;}

        /* Modale */
        .kgv-modal-overlay{
            position:fixed;inset:0;z-index:50;background:rgba(0,0,0,0.6);
            display:none;align-items:center;justify-content:center;padding:16px;
        }
        .kgv-modal-overlay.open{display:flex;}
        .kgv-modal-box{
            background:#13161C;border:1px solid #22262E;border-radius:4px;max-width:420px;width:100%;padding:28px;
        }
        .kgv-modal-box h3{font-family:'Fraunces',serif;font-weight:500;color:#ECEDEE;font-size:1.15rem;margin-bottom:10px;}
        .kgv-modal-box p{color:#92979F;font-size:0.88rem;margin-bottom:24px;}
        .kgv-modal-actions{display:flex;justify-content:flex-end;gap:12px;}
        .kgv-modal-cancel{background:none;border:1px solid #22262E;color:#ECEDEE;padding:10px 18px;border-radius:2px;font-size:0.85rem;cursor:pointer;}
        .kgv-modal-confirm{background:#c0524f;border:none;color:#fff;padding:10px 18px;border-radius:2px;font-size:0.85rem;cursor:pointer;}
    </style>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="kgv-admin">

                <div class="top-bar">
                    <div>
                        <h1 style="font-size:1.5rem;">Projets</h1>
                        <p class="subtitle">Gérez l'ensemble de vos projets et suivez leur avancement.</p>
                    </div>
                    <a href="{{ route('projets.create') }}" class="btn-new">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Nouveau Projet
                    </a>
                </div>

                @if(session('success'))
                    <div id="flash-alert" class="flash">
                        <span>{{ session('success') }}</span>
                        <button id="btn-close-alert" type="button">&times;</button>
                    </div>
                @endif

                <form id="filter-form" method="GET" action="{{ route('projets.index') }}" class="search-bar">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher par titre ou description...">
                    <button type="submit" class="btn-filter">Filtrer</button>
                    @if(request('search'))
                        <a href="{{ route('projets.index') }}" class="btn-reset" style="display:inline-flex;align-items:center;">Réinitialiser</a>
                    @endif
                </form>

                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Titre &amp; Description</th>
                                <th>Date de réalisation</th>
                                <th>Liens</th>
                                <th style="text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projets as $projet)
                                <tr>
                                    <td>
                                        <div class="proj-title">{{ $projet->titre }}</div>
                                        <div class="proj-desc">{{ \Illuminate\Support\Str::limit($projet->description, 60) }}</div>
                                    </td>
                                    <td style="color:var(--text-dim);">
                                        {{ $projet->date_realisation ? \Illuminate\Support\Carbon::parse($projet->date_realisation)->format('d/m/Y') : 'Non définie' }}
                                    </td>
                                    <td>
                                        @if($projet->lien_demo)
                                            <a href="{{ $projet->lien_demo }}" target="_blank" class="proj-link">Démo</a>
                                        @endif
                                        @if($projet->lien_github)
                                            <a href="{{ $projet->lien_github }}" target="_blank" class="proj-link">GitHub</a>
                                        @endif
                                    </td>
                                    <td style="text-align:right;white-space:nowrap;">
                                        <a href="{{ route('projets.edit', $projet) }}" class="action-edit">Éditer</a>
                                        <form action="{{ route('projets.destroy', $projet) }}" method="POST" class="form-delete" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-delete action-delete">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty-row">Aucun projet trouvé</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($projets->hasPages())
                    <div class="pagination-wrap">
                        {{ $projets->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modale de confirmation de suppression -->
    <div id="delete-modal" class="kgv-modal-overlay">
        <div class="kgv-modal-box">
            <h3>Confirmer la suppression</h3>
            <p>Êtes-vous sûr de vouloir supprimer ce projet ? Cette action est irréversible.</p>
            <div class="kgv-modal-actions">
                <button id="modal-cancel" type="button" class="kgv-modal-cancel">Annuler</button>
                <button id="modal-confirm" type="button" class="kgv-modal-confirm">Supprimer</button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alertBox = document.getElementById('flash-alert');
            const alertCloseBtn = document.getElementById('btn-close-alert');

            if (alertBox && alertCloseBtn) {
                alertCloseBtn.addEventListener('click', () => {
                    alertBox.style.opacity = '0';
                    setTimeout(() => alertBox.remove(), 300);
                });
            }

            const deleteModal = document.getElementById('delete-modal');
            const cancelBtn = document.getElementById('modal-cancel');
            const confirmBtn = document.getElementById('modal-confirm');
            let formToSubmit = null;

            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', (event) => {
                    formToSubmit = event.target.closest('.form-delete');
                    deleteModal.classList.add('open');
                });
            });

            cancelBtn.addEventListener('click', () => {
                deleteModal.classList.remove('open');
                formToSubmit = null;
            });

            confirmBtn.addEventListener('click', () => {
                if (formToSubmit) {
                    formToSubmit.submit();
                }
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