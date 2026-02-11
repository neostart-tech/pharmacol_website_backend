<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        DB::table('utilisateur')->insert([
            'mail' => 'admin@pharmacol.com',
            'mot_de_passe' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create the user from the error message if needed
        DB::table('utilisateur')->insert([
            'mail' => 'mayoupatrick@gmail.com',
            'mot_de_passe' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
