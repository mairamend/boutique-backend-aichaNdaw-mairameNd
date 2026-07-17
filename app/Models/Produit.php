<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
#[Fillable(['categorie_id','nom','prix','stock','description'])]
class Produit extends Model
{
    //
    public function categorie() : BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }
    public function achats() : HasMany
    {
        return $this->hasMany(Achat::class);
    }
    protected function casts(): array
{
    return [
        'prix' => 'decimal:2',
    ];
}
}
