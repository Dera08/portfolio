<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Afficher le formulaire d'édition du profil
    public function edit($id)
    {
        $user = User::findOrFail($id);
        
        // Correspond bien à ton fichier resources/views/users/edit.blade.php
        return view('users.edit', compact('user'));
    }

    // Mettre à jour les informations du profil
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nom'                 => 'required|string|max:255',
            'titre_professionnel' => 'nullable|string|max:255',
            'bio'                 => 'nullable|string',
            'email'               => 'required|email|max:255|unique:users,email,' . $id,
            'telephone'           => 'nullable|string|max:30',
            'photo_profil'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Modifié pour gérer un fichier image
            'liens_sociaux'       => 'nullable|string',
        ]);

        // Gestion du remplacement de la photo de profil
        if ($request->hasFile('photo_profil')) {
            // Supprimer l'ancienne photo du stockage si elle existe
            if ($user->photo_profil) {
                Storage::disk('public')->delete($user->photo_profil);
            }
            // Enregistrer la nouvelle photo
            $validated['photo_profil'] = $request->file('photo_profil')->store('users', 'public');
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'Profil mis à jour avec succès !');
    }
}