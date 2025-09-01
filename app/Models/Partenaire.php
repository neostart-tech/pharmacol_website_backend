<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'lien',
        'image',
        'ordre',
        'actif'
    ];

    protected $casts = [
        'actif' => 'boolean',
        'ordre' => 'integer'
    ];

    /**
     * Scope pour récupérer les partenaires actifs
     */
    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope pour ordonner par ordre
     */
    public function scopeOrdonnes($query)
    {
        return $query->orderBy('ordre')->orderBy('id');
    }
}
