<?php

namespace App\Policies;

use App\Models\Utilisateur;
use Illuminate\Auth\Access\Response;

class UtilisateurPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Utilisateur $utilisateur): bool
    {
        return $utilisateur->estAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Utilisateur $utilisateur, Utilisateur $cible): bool
    {
        return $utilisateur->estAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Utilisateur $utilisateur): bool
    {
        return $utilisateur->estAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Utilisateur $utilisateur, Utilisateur $cible): bool
    {
        return $utilisateur->estAdmin() ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Utilisateur $utilisateur, Utilisateur $cible): bool
    {
        return $utilisateur->estAdmin() && $utilisateur->id !== $cible->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Utilisateur $utilisateur, Utilisateur $cible): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Utilisateur $utilisateur, Utilisateur $cible): bool
    {
        return false;
    }
}
