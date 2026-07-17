<?php

namespace App\Policies;

use App\Models\Produit;
use App\Models\Utilisateur;
use Illuminate\Auth\Access\Response;

class ProduitPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Utilisateur $utilisateur): bool
    {
        return $utilisateur->estEmploye();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Utilisateur $utilisateur, Produit $produit): bool
    {
        return $utilisateur->estEmploye();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Utilisateur $utilisateur): bool
    {
        return $utilisateur->estGestionnaire();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Utilisateur $utilisateur, Produit $produit): bool
    {
         return $utilisateur->estGestionnaire();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Utilisateur $utilisateur, Produit $produit): bool
    {
         return $utilisateur->estGestionnaire();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Utilisateur $utilisateur, Produit $produit): bool
    {
         return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Utilisateur $utilisateur, Produit $produit): bool
    {
        return false;
    }
}
