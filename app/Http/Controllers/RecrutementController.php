<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecrutementController extends Controller
{
    public function index()
    {
        $postes = Poste::all();
        
        // Récupération des données générales pour les réseaux sociaux
        $chiffres = [];
        if (Storage::exists('chiffres.json')) {
            $chiffres = json_decode(Storage::get('chiffres.json'), true) ?? [];
        }
        $general = collect($chiffres)->firstWhere('pays', 'general') ?? [];
        
        return view('recrutement', compact('postes', 'general'));
    }

    public function formulaire($id)
    {
        $poste = Poste::findOrFail($id);
        return view('recrutement_formulaire', compact('poste'));
    }
}