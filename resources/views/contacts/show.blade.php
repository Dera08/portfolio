@extends('layouts.app')

@section('title', 'Lecture du message')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- En-tête / Bouton retour -->
    <div class="flex items-center justify-between">
        <a href="{{ route('contacts.index') }}" class="inline-flex items-center text-sm font-medium text-zinc-400 hover:text-orange-500 transition duration-150">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour aux messages
        </a>
    </div>

    <!-- Contenu du message -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-xl p-6 md:p-8 shadow-xl space-y-6">
        <!-- Informations de l'expéditeur -->
        <div class="flex flex-col md:flex-row md:items-center justify-between pb-6 border-b border-zinc-800 gap-4">
            <div>
                <h1 class="text-xl font-bold text-zinc-100">{{ $contact->subject ?? $contact->sujet ?? 'Message de contact' }}</h1>
                <p class="text-sm text-zinc-400 mt-1">De : <span class="text-zinc-200 font-medium">{{ $contact->name ?? $contact->nom }}</span> (<a href="mailto:{{ $contact->email }}" class="text-orange-500 hover:underline">{{ $contact->email }}</a>)</p>
            </div>
            <div class="text-xs text-zinc-500 bg-zinc-900 border border-zinc-800 px-3 py-1.5 rounded-lg w-fit">
                {{ $contact->created_at ? $contact->created_at->format('d/m/Y à H:i') : 'Date non disponible' }}
            </div>
        </div>

        <!-- Corps du message -->
        <div class="text-zinc-300 text-sm leading-relaxed whitespace-pre-line py-2">
            {{ $contact->message }}
        </div>

        <!-- Actions (Répondre par email / Supprimer) -->
        <div class="flex items-center justify-between pt-6 border-t border-zinc-800">
            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject ?? $contact->sujet ?? 'Votre message' }}" class="px-4 py-2 bg-orange-600 hover:bg-orange-500 text-white text-sm font-medium rounded-lg shadow-md transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Répondre par e-mail
            </a>

            <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez-vous vraiment supprimer ce message ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-zinc-900 hover:bg-zinc-800 text-red-400 border border-zinc-800 text-sm font-medium rounded-lg transition">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection  