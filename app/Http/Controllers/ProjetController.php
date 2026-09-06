<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjetController extends Controller
{
    // 1. Afficher la liste des projets (avec recherche + pagination)
    public function index(Request $request)
    {
        $query = Projet::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $projets = $query->latest()->paginate(10)->withQueryString();

        return view('projets.index', compact('projets'));
    }

    // 2. Afficher le formulaire de création
    public function create()
    {
        return view('projets.create');
    }

    // 3. Sauvegarder un nouveau projet
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre'            => 'required|string|max:255',
            'description'      => 'required|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lien_demo'        => 'nullable|url',
            'lien_github'      => 'nullable|url',
            'date_realisation' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projets', 'public');
        }

        $validated['user_id'] = auth()->id();

        Projet::create($validated);

        return redirect()->route('projets.index')->with('success', 'Projet ajouté avec succès !');
    }

    // 4. Afficher le formulaire de modification
    public function edit($id)
    {
        $projet = Projet::findOrFail($id);

        return view('projets.edit', compact('projet'));
    }

    // 5. Mettre à jour un projet existant
    public function update(Request $request, $id)
    {
        $projet = Projet::findOrFail($id);

        $validated = $request->validate([
            'titre'            => 'required|string|max:255',
            'description'      => 'required|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lien_demo'        => 'nullable|url',
            'lien_github'      => 'nullable|url',
            'date_realisation' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            if ($projet->image) {
                Storage::disk('public')->delete($projet->image);
            }
            $validated['image'] = $request->file('image')->store('projets', 'public');
        }

        $projet->update($validated);

        return redirect()->route('projets.index')->with('success', 'Projet modifié avec succès !');
    }

    // 6. Supprimer un projet
    public function destroy($id)
    {
        $projet = Projet::findOrFail($id);

        if ($projet->image) {
            Storage::disk('public')->delete($projet->image);
        }

        $projet->delete();

        return redirect()->back()->with('success', 'Projet supprimé !');
    }
}