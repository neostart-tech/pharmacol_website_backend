<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partenaire;

class PartenaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partenaires = [
            [
                'nom' => 'Crosspharm',
                'lien' => 'https://www.crosspharm.com',
                'image' => 'images/Page index/Crosspharm_logo.png',
                'ordre' => 1,
                'actif' => true,
            ],
            [
                'nom' => 'Ferrer',
                'lien' => 'https://www.ferrer.com',
                'image' => 'images/Page index/ferrer_logo.png',
                'ordre' => 2,
                'actif' => true,
            ],
            [
                'nom' => 'Salvat',
                'lien' => 'https://www.salvat.com',
                'image' => 'images/Page index/salvat_logo.png',
                'ordre' => 3,
                'actif' => true,
            ],
            [
                'nom' => 'Laboratoire Biodim',
                'lien' => 'https://www.biodim.com',
                'image' => 'images/Page index/biodim_logo.png',
                'ordre' => 4,
                'actif' => true,
            ],
            [
                'nom' => 'PharmAccess',
                'lien' => 'https://www.pharmaccess.org',
                'image' => 'images/Page index/pharmaccess_logo.png',
                'ordre' => 5,
                'actif' => true,
            ],
            [
                'nom' => 'Novartis',
                'lien' => 'https://www.novartis.com',
                'image' => 'images/Page index/novartis_logo.png',
                'ordre' => 6,
                'actif' => true,
            ],
        ];

        foreach ($partenaires as $partenaire) {
            Partenaire::create($partenaire);
        }
    }
}
