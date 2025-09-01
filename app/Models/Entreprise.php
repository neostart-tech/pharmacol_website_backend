<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    
    protected $table = 'entreprise';
    
    protected $fillable = [
        'nom',
        'description', 
        'logo',
        'secteur',
        'site_web',
        'telephone',
        'email',
        'adresse',
        'ville',
        'pays',
        'date_partenariat',
        'actif',
        'featured',
        'longitude',
        'latitude'
    ];
    
    protected $casts = [
        'date_partenariat' => 'date',
        'actif' => 'boolean',
        'featured' => 'boolean'
    ];
}


