@extends('layouts.app')

@section('title', 'Gestion des Expériences')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-zinc-100">Expériences</h1>
            <p class="text-sm text-zinc-400 mt-1">Gérez vos parcours professionnels, formations et projets significatifs.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <div class="bg-zinc-950 border border-zinc-800 rounded-xl p-6 shadow-xl lg:col-span-1">
            <h2 class="text-lg font-bold text-zinc-100 mb-4 flex items-center gap-2">
                <span class="text-orange-500">+</span> Ajouter une expérience
            </h2>

            <form action="{{ route('experiences.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-zinc-300 mb-1">Poste / Rôle <span class="text-orange-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Ex: Développeur Full Stack" 
                        @class([
                            'w-full bg-zinc-900 border rounded-lg px-3.5 py-2 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition',
                            'border-red-500' => $errors->has('title'),
                            'border-zinc-800' => !$errors->has('title')
                        ]) required>
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="company" class="block text-sm font-medium text-zinc-300 mb-1">Entreprise / École <span class="text-orange-500">*</span></label>
                    <input type="text" name="company" id="company" value="{{ old('company') }}" placeholder="Ex: Tech Company / Université" 
                        @class([
                            'w-full bg-zinc-900 border rounded-lg px-3.5 py-2 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition',
                            'border-red-500' => $errors->has('company'),
                            'border-zinc-800' => !$errors->has('company')
                        ]) required>
                    @error('company')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-zinc-300 mb-1">Début</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" 
                            class="w-full bg-zinc-900 border border-zinc-800 rounded-lg px-3 py-2 text-zinc-100 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition">
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-zinc-300 mb-1">Fin</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" 
                            class="w-full bg-zinc-900 border border-zinc-800 rounded-lg px-3 py-2 text-zinc-100 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition">
                    </div>
                </div>

                <div class="flex items-center space-x-2 pt-1">
                    <input type="checkbox" name="is_current" id="is_current" value="1" {{ old('is_current') ? 'checked' : '' }}
                        class="rounded bg-zinc-900 border-zinc-800 text-orange-500 focus:ring-orange-500 h-4 w-4">
                    <label for="is_current" class="text-xs text-zinc-400">J'occupe actuellement ce poste</label>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-zinc-300 mb-1">Description</label>
                    <textarea name="description" id="description" rows="3" placeholder="Missions réalisées, technologies utilisées..."
                        class="w-full bg-zinc-900 border border-zinc-800 rounded-lg px-3.5 py-2 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="w-full mt-2 px-4 py-2.5 bg-orange-600 hover:bg-orange-500 text-white text-sm font-medium rounded-lg shadow-md transition duration-150 flex items-center justify-center">
                    <span>Ajouter l'expérience</span>
                </button>
            </form>
        </div>

        <div class="bg-zinc-950 border border-zinc-800 rounded-xl overflow-hidden shadow-xl lg:col-span-2">
            <div class="p-4 border-b border-zinc-800 bg-zinc-900/50">
                <h2 class="text-md font-semibold text-zinc-200">Parcours & Expériences</h2>
            </div>

            <div class="divide-y divide-zinc-800">
                @forelse($experiences as $experience)
                    <div class="p-6 hover:bg-zinc-900/40 transition flex items-start justify-between gap-4">
                        <div class="space-y-1.5 flex-1">
                            <div class="flex items-center gap-3">
                                <h3 class="text-base font-bold text-zinc-100">{{ $experience->title ?? $experience->titre ?? $experience->post }}</h3>
                                @if($experience->is_current)
                                    <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-orange-500/10 text-orange-400 border border-orange-500/20">En cours</span>
                                @endif
                            </div>
                            
                            <p class="text-sm font-medium text-orange-500">{{ $experience->company ?? $experience->entreprise }}</p>
                            
                            <p class="text-xs text-zinc-400 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $experience->start_date ? \Carbon\Carbon::parse($experience->start_date)->format('m/Y') : 'N/A' }} 
                                - 
                                {{ $experience->is_current ? 'Présent' : ($experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('m/Y') : 'N/A') }}
                            </p>

                            @if($experience->description)
                                <p class="text-sm text-zinc-400 pt-2 leading-relaxed">{{ $experience->description }}</p>
                            @endif
                        </div>

                        <form action="{{ route('experiences.destroy', $experience) }}" method="POST" class="form-delete-exp">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-delete-exp text-zinc-500 hover:text-red-400 transition p-1" title="Supprimer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="p-10 text-center text-zinc-500 text-sm">
                        Aucune expérience renseignée pour le moment.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div id="delete-exp-modal" class="fixed inset-0 z-50 hidden bg-zinc-950/80 backdrop-blur-sm items-center justify-center p-4">
    <div class="bg-zinc-900 border border-zinc-800 rounded-xl shadow-2xl max-w-md w-full p-6 space-y-4">
        <h3 class="text-lg font-bold text-zinc-100">Supprimer l'expérience</h3>
        <p class="text-sm text-zinc-400">Voulez-vous vraiment retirer cette expérience ? Cette action est irréversible.</p>
        <div class="flex justify-end space-x-3 pt-2">
            <button id="modal-exp-cancel" type="button" class="px-4 py-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-lg transition">Annuler</button>
            <button id="modal-exp-confirm" type="button" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white text-sm font-medium rounded-lg transition">Supprimer</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Désactivation/activation dynamique du champ date de fin selon "J'occupe actuellement ce poste"
        const currentCheckbox = document.getElementById('is_current');
        const endDateInput = document.getElementById('end_date');

        if (currentCheckbox && endDateInput) {
            const toggleEndDate = () => {
                endDateInput.disabled = currentCheckbox.checked;
                if (currentCheckbox.checked) {
                    endDateInput.value = '';
                    endDateInput.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    endDateInput.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            };
            
            toggleEndDate();
            currentCheckbox.addEventListener('change', toggleEndDate);
        }

        // Modale de suppression
        const deleteModal = document.getElementById('delete-exp-modal');
        const cancelBtn = document.getElementById('modal-exp-cancel');
        const confirmBtn = document.getElementById('modal-exp-confirm');
        let formToSubmit = null;

        document.querySelectorAll('.btn-delete-exp').forEach(button => {
            button.addEventListener('click', (event) => {
                formToSubmit = event.target.closest('.form-delete-exp');
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