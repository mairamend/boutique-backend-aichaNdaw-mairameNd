<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
#[Fillable(['acheteur_id','produit_id','quantite', 'date_achat'])]
class Achat extends Model
{
    //
    public function acheteur() :BelongsTo
    {
        return $this->belongsTo(Acheteur::class);
    }
    public function produit() :BelongsTo
    {
        return $this->belongsTo(Produit::class);
    }
    protected function casts(): array
{
    return [
        'date_achat' => 'date',
    ];
}
}
