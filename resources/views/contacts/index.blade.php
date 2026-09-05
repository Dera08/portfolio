@extends('layouts.app')

@section('title', 'Boîte de réception - Messages')

@section('content')
<div class="space-y-6">
    <!-- En-tête -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-zinc-100">Messages reçus</h1>
            <p class="text-sm text-zinc-400 mt-1">Consultez les messages envoyés depuis le formulaire de contact de votre portfolio.</p>
        </div>
    </div>

    <!-- Tableau des messages -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-zinc-300">
                <thead class="bg-zinc-900 text-xs uppercase text-zinc-400 border-b border-zinc-800">
                    <tr>
                        <th scope="col" class="px-6 py-3">Expéditeur</th>
                        <th scope="col" class="px-6 py-3">Sujet / Aperçu</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @forelse($contacts ?? $messages as $contact)
                        <tr class="hover:bg-zinc-900/40 transition {{ isset($contact->is_read) && !$contact->is_read ? 'bg-orange-500' : '' }}">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-zinc-100 flex items-center gap-2">
                                    {{ $contact->name ?? $contact->nom }}
                                    @if(isset($contact->is_read) && !$contact->is_read)
                                        <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                    @endif
                                </div>
                                <div class="text-xs text-zinc-400">{{ $contact->email }}</div>
                            </td>
                            <td class="px-6 py-4 max-w-xs truncate">
                                <div class="font-medium text-zinc-200">{{ $contact->subject ?? $contact->sujet ?? 'Sans objet' }}</div>
                                <div class="text-xs text-zinc-500 truncate">{{ Str::limit($contact->message, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 text-xs text-zinc-400 whitespace-nowrap">
                                {{ $contact->created_at ? $contact->created_at->format('d/m/Y H:i') : 'Récemment' }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                <a href="{{ route('contacts.show', $contact) }}" class="inline-flex items-center px-3 py-1.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-200 rounded-lg text-xs font-medium transition">
                                    Lire
                                </a>
                                
                                <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="inline-block form-delete-contact">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete-contact text-zinc-500 hover:text-red-400 transition p-1.5" title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-zinc-500 text-sm">
                                Votre boîte de réception est vide pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($contacts ?? $messages, 'hasPages') && (suppressed = ($contacts ?? $messages)->hasPages()))
            <div class="px-6 py-4 border-t border-zinc-800">
                {{ ($contacts ?? $messages)->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Modale de suppression de message -->
<div id="delete-contact-modal" class="fixed inset-0 z-50 hidden bg-zinc-950/80 backdrop-blur-sm items-center justify-center p-4">
    <div class="bg-zinc-900 border border-zinc-800 rounded-xl shadow-2xl max-w-md w-full p-6 space-y-4">
        <h3 class="text-lg font-bold text-zinc-100">Supprimer le message</h3>
        <p class="text-sm text-zinc-400">Voulez-vous vraiment supprimer ce message ? Cette action est irréversible.</p>
        <div class="flex justify-end space-x-3 pt-2">
            <button id="modal-contact-cancel" type="button" class="px-4 py-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-lg transition">Annuler</button>
            <button id="modal-contact-confirm" type="button" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white text-sm font-medium rounded-lg transition">Supprimer</button>
        </div>
    </div>
</div>
@endsection

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
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            });
        });

        cancelBtn.addEventListener('click', () => {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
            formToSubmit = null;
        });

        confirmBtn.addEventListener('click', () => {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });

        deleteModal.addEventListener('click', (event) => {
            if (event.target === deleteModal) {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
                formToSubmit = null;
            }
        });
    });
</script>
@endpush