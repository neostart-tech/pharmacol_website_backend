<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;

    class PrestationController extends Controller
    {
        public function index()
        {
            // Récupération des données générales pour les réseaux sociaux
            $chiffres = [];
            if (Storage::exists('chiffres.json')) {
                $chiffres = json_decode(Storage::get('chiffres.json'), true) ?? [];
            }
            $general = collect($chiffres)->firstWhere('pays', 'general') ?? [];
            
            return view('prestation', compact('general'));
        }
    }
?>


