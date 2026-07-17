<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
#[Fillable(['nom','description'])]
class Categorie extends Model
{
    //
    use HasFactory;
    public function produits(): HasMany{
        return $this->hasMany(Produit::class);
    }

}
