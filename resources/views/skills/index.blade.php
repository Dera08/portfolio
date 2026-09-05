 <x-app-layout>

@section('title', 'Gestion des Compétences')

@section('content')
<div class="space-y-8">
    <!-- En-tête -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-zinc-100">Compétences</h1>
            <p class="text-sm text-zinc-400 mt-1">Gérez vos compétences techniques et leur niveau de maîtrise.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <!-- FORMULAIRE D'AJOUT (1 colonne sur grand écran) -->
        <div class="bg-zinc-950 border border-zinc-800 rounded-xl p-6 shadow-xl lg:col-span-1">
            <h2 class="text-lg font-bold text-zinc-100 mb-4 flex items-center gap-2">
                <span class="text-orange-500">+</span> Ajouter une compétence
            </h2>

            <form action="{{ route('skills.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Nom de la compétence -->
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-300 mb-1">Nom <span class="text-orange-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Ex: Tailwind CSS, Laravel, React" 
                        @class([
                            'w-full bg-zinc-900 border rounded-lg px-3.5 py-2 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition',
                            'border-red-500' => $errors->has('name'),
                            'border-zinc-800' => !$errors->has('name')
                        ]) required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catégorie -->
                <div>
                    <label for="category" class="block text-sm font-medium text-zinc-300 mb-1">Catégorie</label>
                    <input type="text" name="category" id="category" value="{{ old('category') }}" placeholder="Ex: Frontend, Backend, Database" 
                        class="w-full bg-zinc-900 border border-zinc-800 rounded-lg px-3.5 py-2 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition">
                </div>

                <!-- Niveau / Pourcentage -->
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label for="level" class="block text-sm font-medium text-zinc-300">Niveau (%)</label>
                        <span id="level-value" class="text-xs font-bold text-orange-500">80%</span>
                    </div>
                    <input type="range" name="level" id="level" min="0" max="100" value="{{ old('level', 80) }}" 
                        class="w-full accent-orange-500 cursor-pointer bg-zinc-800 rounded-lg">
                </div>

                <!-- Bouton Soumettre -->
                <button type="submit" id="btn-submit-skill" class="w-full mt-2 px-4 py-2.5 bg-orange-600 hover:bg-orange-500 text-white text-sm font-medium rounded-lg shadow-md transition duration-150 flex items-center justify-center">
                    <span>Ajouter la compétence</span>
                </button>
            </form>
        </div>

        <!-- LISTE DES COMPÉTENCES (2 colonnes sur grand écran) -->
        <div class="bg-zinc-950 border border-zinc-800 rounded-xl overflow-hidden shadow-xl lg:col-span-2">
            <div class="p-4 border-b border-zinc-800 bg-zinc-900/50 flex justify-between items-center">
                <h2 class="text-md font-semibold text-zinc-200">Compétences enregistrées</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-zinc-300">
                    <thead class="bg-zinc-900 text-xs uppercase text-zinc-400 border-b border-zinc-800">
                        <tr>
                            <th scope="col" class="px-6 py-3">Compétence</th>
                            <th scope="col" class="px-6 py-3">Catégorie</th>
                            <th scope="col" class="px-6 py-3">Niveau</th>
                            <th scope="col" class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        @forelse($skills as $skill)
                            <tr class="hover:bg-zinc-900/40 transition">
                                <td class="px-6 py-4 font-semibold text-zinc-100">
                                    {{ $skill->name ?? $skill->nom }}
                                </td>
                                <td class="px-6 py-4 text-xs text-zinc-400">
                                    <span class="px-2 py-1 rounded-md bg-zinc-800 border border-zinc-700">
                                        {{ $skill->category ?? $skill->categorie ?? 'Général' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 w-48">
                                    <div class="flex items-center gap-3">
                                        <div class="w-full bg-zinc-800 rounded-full h-2 overflow-hidden">
                                            <div class="bg-orange-500 h-2 rounded-full" style="width: {{ $skill->level ?? $skill->niveau ?? 0 }}%"></div>
                                        </div>
                                        <span class="text-xs font-bold text-zinc-400">{{ $skill->level ?? $skill->niveau ?? 0 }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('skills.destroy', $skill) }}" method="POST" class="inline-block form-delete-skill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-delete-skill text-zinc-500 hover:text-red-400 transition" title="Supprimer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-zinc-500">
                                    Aucune compétence enregistrée pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modale de confirmation de suppression -->
<div id="delete-skill-modal" class="fixed inset-0 z-50 hidden bg-zinc-950/80 backdrop-blur-sm items-center justify-center p-4">
    <div class="bg-zinc-900 border border-zinc-800 rounded-xl shadow-2xl max-w-md w-full p-6 space-y-4">
        <h3 class="text-lg font-bold text-zinc-100">Supprimer la compétence</h3>
        <p class="text-sm text-zinc-400">Voulez-vous vraiment retirer cette compétence ? Cette action est irréversible.</p>
        <div class="flex justify-end space-x-3 pt-2">
            <button id="modal-skill-cancel" type="button" class="px-4 py-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 text-sm font-medium rounded-lg transition">Annuler</button>
            <button id="modal-skill-confirm" type="button" class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white text-sm font-medium rounded-lg transition">Supprimer</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Mise à jour dynamique de la valeur du Range Input
        const levelRange = document.getElementById('level');
        const levelValue = document.getElementById('level-value');

        if (levelRange && levelValue) {
            levelRange.addEventListener('input', (e) => {
                levelValue.textContent = `${e.target.value}%`;
            });
        }

        // 2. Modale de suppression personnalisée
        const deleteModal = document.getElementById('delete-skill-modal');
        const cancelBtn = document.getElementById('modal-skill-cancel');
        const confirmBtn = document.getElementById('modal-skill-confirm');
        let formToSubmit = null;

        document.querySelectorAll('.btn-delete-skill').forEach(button => {
            button.addEventListener('click', (event) => {
                formToSubmit = event.target.closest('.form-delete-skill');
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
</x-app-layout>