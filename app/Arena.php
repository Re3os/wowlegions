<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arena extends Model {

    protected $connection = 'characters';

    protected $table = 'arena_team';

    protected $fillable = [
        'captainGuid', 'name', 'type', 'rating', 'seasonGames', 'seasonWins', 'weekGames', 'weekWins', 'rank'
    ];

    public function characters() {
        return $this->belongsTo(Characters::class, 'captainGuid', 'guid');
    }
}