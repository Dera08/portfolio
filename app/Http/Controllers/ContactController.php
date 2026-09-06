<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // 1. Afficher la boîte de réception (liste des messages reçus)
    public function index()
{
    $contacts = Contact::orderBy('date_envoi', 'desc')->paginate(15);

    return view('contacts.index', compact('contacts'));
}

    // 2. Afficher un message précis (Lecture complète - lié à show.blade.php)
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        // Marquer le message comme "lu" automatiquement à l'ouverture
        if (!$contact->lu) {
            $contact->update(['lu' => true]);
        }

        return view('contacts.show', compact('contact'));
    }

    // 3. Sauvegarder un nouveau message (généralement soumis depuis le portfolio public)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'          => 'required|exists:users,id',
            'email_expediteur' => 'nullable|email',
            'sujet'            => 'required|string|max:150', // Correction : 'max :150' générait une erreur
            'message'          => 'required|string',
            'notification'     => 'nullable|string',         // Correction : espace en trop retiré
            'nom_expediteur' => 'required|string|max:255',
        ]);

        // Correction : 'date_envoi' s'écrit sans 'e' à la fin, pour correspondre à ton modèle
        $validated['date_envoi'] = now();
        $validated['lu'] = false;
         
        Contact::create($validated);

        return redirect()->back()->with('success', 'Message envoyé avec succès !');
    }

    // 4. Supprimer un message de la boîte de réception
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Message supprimé !');
    }
}