<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonneCollecte extends Model
{
    protected $table = 'personne_collectes';
    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'contact',
        'email',
        'lieu_residence',
        'lieu_vote'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
