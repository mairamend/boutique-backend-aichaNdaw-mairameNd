<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
#[Fillable(['nom','email','telephone'])]
class Acheteur extends Model
{
    //
    public function achats() : HasMany
    {
        return $this->hasMany(Achat::class);
    }
}
