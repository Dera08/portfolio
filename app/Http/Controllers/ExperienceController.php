<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    // 1. Afficher la liste des expériences + formulaire d'ajout
    public function index()
    {
        $experiences = Experience::all();
        
        // Correction : Ton arborescence indique 'experiences.index', pas 'experiences.edit'
        return view('experiences.index', compact('experiences'));
    }

    // 2. Sauvegarder une nouvelle expérience
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'user_id'          => 'required|exists:users,id', // Décommenter si l'ID n'est pas géré par auth()->id()
            'entreprise'       => 'required|string|max:80',
            'poste_ou_diplome' => 'required|string',
            'description'      => 'required|string',
            'date_debut'       => 'required|date',
            'date_fin'         => 'nullable|date|after_or_equal:date_debut',
        ]);

        // Assignation de l'utilisateur connecté (si applicable)
        // $validated['user_id'] = auth()->id();

        Experience::create($validated);

        return redirect()->back()->with('success', 'Expérience ajoutée avec succès !');
    }

    // 3. Supprimer une expérience
    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        
        $experience->delete();

        return redirect()->back()->with('success', 'Expérience supprimée !');
    }
}