<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'fichier', 'description'];

    // Définir l'accessor pour le chemin complet du fichier
    public function getFichierAttribute($value)
    {
        return asset('storage/' . $value);
    }

}
