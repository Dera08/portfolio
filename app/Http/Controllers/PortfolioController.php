<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        // Récupère le premier utilisateur avec toutes ses données associées
        $user = User::with(['projets', 'skills', 'experiences'])->firstOrFail();

        // Extraction des collections pour correspondre aux variables de la vue
        // Si la relation est vide, on renvoie une collection vide pour éviter les erreurs
        $projects = $user->projets ?? collect(); 
        $skills = $user->skills ?? collect();
        $experiences = $user->experiences ?? collect();

        // Retourne la vue avec toutes les variables nécessaires
        return view('welcome', compact('user', 'projects', 'skills', 'experiences'));
    }
}