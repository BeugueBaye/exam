<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function addProduit(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'fichier' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
            'description' => 'required|string',
        ]);

        // Gérer l'upload du fichier
        $fichierPath = 'fichiers/produits/' . $request->file('fichier')->getClientOriginalName();
        $request->file('fichier')->storeAs('public/fichiers/produits', $request->file('fichier')->getClientOriginalName());

        // Créer le produit dans la base de données avec le chemin du fichier
        $produit = Produit::create([
            'nom' => $validatedData['nom'],
            'fichier' => $fichierPath,
            'description' => $validatedData['description'],
        ]);

        return response()->json(['message' => 'Produit ajouté avec succès'], 200);
    }

    public function getProduits()
    {
        $produits = Produit::all();
        return response()->json($produits, 200);
    }
}
