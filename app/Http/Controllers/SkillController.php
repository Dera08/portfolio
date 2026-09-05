<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    // 1. Afficher la liste des compétences + formulaire d'ajout
    public function index()
    {
        $skills = Skill::all();
        
        // Correction : Ton arborescence indique 'skills.index', pas 'skills.edit'
        return view('skills.index', compact('skills'));
    }

    // 2. Sauvegarder une nouvelle compétence
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'user_id'     => 'required|exists:users,id', // Décommenter si non géré par auth()->id()
            'titre'       => 'required|string|max:50',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Modifié pour un fichier (j'ai ajouté 'svg' qui est très commun pour les logos de compétences)
            'niveau'      => 'required|string|max:50', // Correction : 'string 50' était une syntaxe invalide
        ]);

        // Gestion de l'upload de l'image (logo de la compétence)
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('skills', 'public');
        }

        // $validated['user_id'] = auth()->id();

        Skill::create($validated);

        return redirect()->back()->with('success', 'Compétence ajoutée avec succès !');
    }

    // 3. Supprimer une compétence
    public function destroy($id)
    {
        // Correction : Il faut une majuscule au modèle "Skill" (et non "skill::findOrFail")
        $skill = Skill::findOrFail($id);

        // Supprimer l'image/le logo du serveur avant de supprimer la compétence
        if ($skill->image) {
            Storage::disk('public')->delete($skill->image);
        }

        $skill->delete();

        return redirect()->back()->with('success', 'Compétence supprimée !');
    }
}