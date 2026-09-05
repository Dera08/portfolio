<x-app-layout>

@section('title', 'Modifier le Profil')

@section('content')
<div class="max-w-4xl mx-auto py-4 space-y-8">
    <!-- En-tête -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-zinc-100">Paramètres du profil</h1>
            <p class="text-sm text-zinc-400 mt-1">Mettez à jour vos informations personnelles et vos identifiants de connexion.</p>
        </div>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="bg-emerald-950/50 border border-emerald-800/60 text-emerald-300 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-400 flex-shrink-" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span>Vos modifications ont été enregistrées avec succès.</span>
        </div>
    @endif

    <!-- Formulaire d'informations générales -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-xl p-6 md:p-8 shadow-xl">
        <h2 class="text-lg font-bold text-zinc-100 mb-4 pb-2 border-b border-zinc-800">Informations générales</h2>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Nom -->
            <div>
                <label for="name" class="block text-sm font-medium text-zinc-300 mb-2">Nom complet <span class="text-orange-500">*</span></label>
                <input type="text" name="name" id="name" 
                    value="{{ old('name', $user->name ?? '') }}" 
                    @class([
                        'w-full bg-zinc-900 border rounded-lg px-4 py-2.5 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition',
                        'border-red-500' => $errors->has('name'),
                        'border-zinc-800' => !$errors->has('name')
                    ])
                    required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-zinc-300 mb-2">Adresse e-mail <span class="text-orange-500">*</span></label>
                <input type="email" name="email" id="email" 
                    value="{{ old('email', $user->email ?? '') }}" 
                    @class([
                        'w-full bg-zinc-900 border rounded-lg px-4 py-2.5 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition',
                        'border-red-500' => $errors->has('email'),
                        'border-zinc-800' => !$errors->has('email')
                    ])
                    required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="px-5 py-2.5 bg-orange-600 hover:bg-orange-500 text-white text-sm font-medium rounded-lg shadow-md transition duration-150">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>

    <!-- Formulaire de modification du mot de passe -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-xl p-6 md:p-8 shadow-xl">
        <h2 class="text-lg font-bold text-zinc-100 mb-4 pb-2 border-b border-zinc-800">Mettre à jour le mot de passe</h2>

        <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Mot de passe actuel -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-zinc-300 mb-2">Mot de passe actuel</label>
                <input type="password" name="current_password" id="current_password" 
                    @class([
                        'w-full bg-zinc-900 border rounded-lg px-4 py-2.5 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition',
                        'border-red-500' => $errors->updatePassword->has('current_password'),
                        'border-zinc-800' => !$errors->updatePassword->has('current_password')
                    ])>
                @error('current_password', 'updatePassword')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nouveau mot de passe -->
            <div>
                <label for="password" class="block text-sm font-medium text-zinc-300 mb-2">Nouveau mot de passe</label>
                <input type="password" name="password" id="password" 
                    @class([
                        'w-full bg-zinc-900 border rounded-lg px-4 py-2.5 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition',
                        'border-red-500' => $errors->updatePassword->has('password'),
                        'border-zinc-800' => !$errors->updatePassword->has('password')
                    ])>
                @error('password', 'updatePassword')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmation du nouveau mot de passe -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-zinc-300 mb-2">Confirmer le nouveau mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="w-full bg-zinc-900 border border-zinc-800 rounded-lg px-4 py-2.5 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition">
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="px-5 py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-200 text-sm font-medium rounded-lg transition duration-150">
                    Mettre à jour le mot de passe
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>