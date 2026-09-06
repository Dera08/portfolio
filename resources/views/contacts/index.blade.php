<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages
        </h2>
    </x-slot>

    <style>
        .kgv-admin{
            --bg: #0A0C10; --surface: #13161C; --border: #22262E;
            --text: #ECEDEE; --text-dim: #92979F; --accent: #B08949;
            background:var(--bg); color:var(--text);
            font-family:'Inter',sans-serif;
        }
        .kgv-admin h1{font-family:'Fraunces',serif;font-weight:500;}
        .kgv-panel{background:var(--surface);border:1px solid var(--border);border-radius:4px;overflow:hidden;}
        .kgv-admin table{width:100%;border-collapse:collapse;}
        .kgv-admin thead th{
            text-align:left;font-size:0.72rem;text-transform:uppercase;letter-spacing:0.03em;
            color:var(--text-dim);font-weight:500;padding:14px 16px;border-bottom:1px solid var(--border);
        }
        .kgv-admin tbody td{padding:16px;border-bottom:1px solid var(--border);font-size:0.88rem;vertical-align:middle;}
        .kgv-admin tbody tr:hover{background:rgba(255,255,255,0.02);}
        .kgv-sender{font-weight:600;display:flex;align-items:center;gap:8px;}
        .kgv-sender-email{color:var(--text-dim);font-size:0.8rem;margin-top:2px;}
        .kgv-subject{font-weight:500;}
        .kgv-preview{color:var(--text-dim);font-size:0.8rem;margin-top:2px;}
        .kgv-unread-dot{width:7px;height:7px;border-radius:50%;background:var(--accent);flex-shrink:0;}
        .kgv-date{color:var(--text-dim);font-size:0.8rem;white-space:nowrap;}
        .kgv-btn-read{
            display:inline-flex;align-items:center;padding:7px 14px;background:var(--border);
            color:var(--text);border-radius:2px;font-size:0.78rem;font-weight:500;
        }
        .kgv-btn-read:hover{background:#2c313b;}
        .action-delete{color:#e08b8b;background:none;border:none;cursor:pointer;font-family:inherit;font-size:0.8rem;padding:0 0 0 14px;}
        .empty-row{text-align:center;padding:48px 16px;color:var(--text-dim);}
        .pagination-wrap{padding:16px 20px;border-top:1px solid var(--border);}

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
                <h1 style="font-size:1.5rem;">Messages reçus</h1>
                <p style="color:var(--text-dim);font-size:0.9rem;margin-top:4px;">
                    Consultez les messages envoyés depuis le formulaire de contact de votre portfolio.
                </p>
            </div>

            <div class="kgv-panel">
                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Expéditeur</th>
                                <th>Sujet / Aperçu</th>
                                <th>Date</th>
                                <th style="text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contacts as $contact)
                                <tr>
                                    <td>
                                        <div class="kgv-sender">
                                            {{ $contact->nom_expediteur }}
                                            @if(!$contact->lu)
                                                <span class="kgv-unread-dot" title="Non lu"></span>
                                            @endif
                                        </div>
                                        <div class="kgv-sender-email">{{ $contact->email_expediteur }}</div>
                                    </td>
                                    <td style="max-width:280px;">
                                        <div class="kgv-subject">{{ $contact->sujet ?? 'Sans objet' }}</div>
                                        <div class="kgv-preview">{{ \Illuminate\Support\Str::limit($contact->message, 50) }}</div>
                                    </td>
                                    <td class="kgv-date">
                                        {{ $contact->date_envoi ? \Illuminate\Support\Carbon::parse($contact->date_envoi)->format('d/m/Y H:i') : 'Récemment' }}
                                    </td>
                                    <td style="text-align:right;white-space:nowrap;">
                                        <a href="{{ route('contacts.show', $contact) }}" class="kgv-btn-read">Lire</a>
                                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="form-delete-contact" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-delete-contact action-delete">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty-row">Votre boîte de réception est vide pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($contacts->hasPages())
                    <div class="pagination-wrap">
                        {{ $contacts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modale de suppression -->
    <div id="delete-contact-modal" class="kgv-modal-overlay">
        <div class="kgv-modal-box">
            <h3>Supprimer le message</h3>
            <p>Voulez-vous vraiment supprimer ce message ? Cette action est irréversible.</p>
            <div class="kgv-modal-actions">
                <button id="modal-contact-cancel" type="button" class="kgv-modal-cancel">Annuler</button>
                <button id="modal-contact-confirm" type="button" class="kgv-modal-confirm">Supprimer</button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteModal = document.getElementById('delete-contact-modal');
            const cancelBtn = document.getElementById('modal-contact-cancel');
            const confirmBtn = document.getElementById('modal-contact-confirm');
            let formToSubmit = null;

            document.querySelectorAll('.btn-delete-contact').forEach(button => {
                button.addEventListener('click', (event) => {
                    formToSubmit = event.target.closest('.form-delete-contact');
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