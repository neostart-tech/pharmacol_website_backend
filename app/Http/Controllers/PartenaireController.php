<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartenaireController extends Controller
{
    /**
     * Constructeur pour vérifier l'authentification admin
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Permettre l'accès public seulement pour l'API getActifs
            if ($request->is('api/partenaires')) {
                return $next($request);
            }
            
            // Vérifier l'authentification admin pour toutes les autres routes
            if (!session('admin')) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Non autorisé'], 401);
                }
                return redirect()->route('admin.login');
            }
            
            return $next($request);
        });
    }
    /**
     * Afficher tous les partenaires pour le dashboard
     */
    public function index()
    {
        $partenaires = Partenaire::orderBy('ordre')->get();
        return response()->json($partenaires);
    }

    /**
     * Stocker un nouveau partenaire
     */
    public function store(Request $request)
    {
        \Log::info('🚀 Début store partenaire', [
            'data' => $request->all(),
            'files' => $request->hasFile('image') ? 'Oui' : 'Non',
            'session' => session('admin')
        ]);
        
        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'lien' => 'required|url|max:500',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'ordre' => 'nullable|integer|min:0',
                'actif' => 'nullable|boolean'
            ]);
            
            \Log::info('✅ Validation OK');

            $partenaire = new Partenaire();
            $partenaire->nom = $request->nom;
            $partenaire->lien = $request->lien;
            $partenaire->ordre = $request->ordre ?? 0;
            $partenaire->actif = $request->has('actif') ? (bool)$request->actif : true;

            // Gestion de l'upload d'image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = 'partenaires/' . $imageName;
                
                \Log::info('📁 Upload image', ['name' => $imageName, 'path' => $imagePath]);
                
                // Stocker l'image dans storage/app/public/partenaires
                $image->storeAs('partenaires', $imageName, 'public');
                $partenaire->image = '/storage/' . $imagePath;
            } else {
                // Image par défaut si aucune image fournie
                $partenaire->image = '/images/Page index/default-partner.png';
                \Log::info('🖼️ Image par défaut utilisée');
            }

            $result = $partenaire->save();
            \Log::info('💾 Sauvegarde', ['success' => $result, 'id' => $partenaire->id]);

            return response()->json([
                'message' => 'Partenaire créé avec succès', 
                'partenaire' => $partenaire
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('❌ Erreur validation', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('❌ Erreur générale', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Erreur serveur: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Mettre à jour un partenaire
     */
    public function update(Request $request, $id)
    {
        $partenaire = Partenaire::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'lien' => 'required|url|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ordre' => 'integer|min:0',
            'actif' => 'boolean'
        ]);

        $partenaire->nom = $request->nom;
        $partenaire->lien = $request->lien;
        $partenaire->ordre = $request->ordre ?? $partenaire->ordre;
        $partenaire->actif = $request->actif ?? $partenaire->actif;

        // Gestion de l'upload d'image si nouvelle image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($partenaire->image && Storage::disk('public')->exists(str_replace('/storage/', '', $partenaire->image))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $partenaire->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = 'partenaires/' . $imageName;
            
            // Stocker l'image dans storage/app/public/partenaires
            $image->storeAs('partenaires', $imageName, 'public');
            $partenaire->image = '/storage/' . $imagePath;
        }

        $partenaire->save();

        return response()->json(['message' => 'Partenaire mis à jour avec succès', 'partenaire' => $partenaire]);
    }

    /**
     * Supprimer un partenaire
     */
    public function destroy($id)
    {
        $partenaire = Partenaire::findOrFail($id);

        // Supprimer l'image associée
        if ($partenaire->image && Storage::disk('public')->exists(str_replace('/storage/', '', $partenaire->image))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $partenaire->image));
        }

        $partenaire->delete();

        return response()->json(['message' => 'Partenaire supprimé avec succès']);
    }

    /**
     * Récupérer les partenaires actifs pour l'affichage public
     */
    public function getActifs()
    {
        $partenaires = Partenaire::actifs()->orderBy('ordre')->get();
        return response()->json($partenaires);
    }
}
