<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['nom', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class Utilisateur extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function estAdmin(): bool
{
    return $this->role === 'admin';
}
public function estGestionnaire(): bool
{
    return in_array($this->role, ['gestionnaire', 'admin']);
}
public function estEmploye(): bool
{
    return in_array($this->role, ['employe', 'gestionnaire', 'admin']);
}
}
