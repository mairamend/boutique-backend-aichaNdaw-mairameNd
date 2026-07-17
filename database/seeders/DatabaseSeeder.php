<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Acheteur;
use App\Models\Achat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Utilisateur::create([
            'nom' => 'Admin',
            'email' => 'admin@boutique.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
         Utilisateur::create([
            'nom' => 'gestionnaire',
            'email' => 'Gestionnaire@boutique.com',
            'password' => bcrypt('password123'),
            'role' => 'gestionnaire',
        ]);
         Utilisateur::create([
            'nom' => 'Employe',
            'email' => 'employe@boutique.com',
            'password' => bcrypt('password123'),
            'role' => 'employe',
        ]);
        Categorie::create([
            'nom' => 'Electronique'
           
        ]);
        Categorie::create([
            'nom' => 'Alimentaire'
           
        ]);
        Produit::create([
            'categorie_id' => 1,
            'nom' => "Ordinateur Portable Hp",
            'prix' => 250000,
            'stock' => 10
        ]);
        Produit::create([
            'categorie_id' => 2,
            'nom' => "Farine de blé",
            'prix' => 15000,
            'stock' => 20
        ]);
        Acheteur::create([
            'nom' => 'Fatima Sall',
            'email' => 'sallfatima@gmail.com',
            'telephone' => '774569878'
        ]);
         Acheteur::create([
            'nom' => 'Malick Diawara',
            'email' => 'malickdiawara@gmail.com',
            'telephone' => '773467146'
        ]);
        Achat::create([
            'acheteur_id' => 1,
            'produit_id' => 2,
            'quantite' => 2,
            'date_achat' => now(),
            
        ]);
        Produit::find(2)->decrement('stock', 2);
         Achat::create([
            'acheteur_id' => 2,
            'produit_id' => 1,
            'quantite' => 1,
            'date_achat' => now(),
            
        ]);
        Produit::find(1)->decrement('stock', 1);

    }
}
