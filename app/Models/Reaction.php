<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
        'type',
    ];

    /**
     * Get the user that owns the reaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the movie that this reaction belongs to.
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
