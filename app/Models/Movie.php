<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    /**
     * Get the user that owns the movie.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getLikesCount()
    {
        return $this->reactions()->where('type', 'like')->count();
    }

    public function getHatesCount()
    {
        return $this->reactions()->where('type', 'hate')->count();
    }

    public function reactions()
    {
        return $this->hasMany(\App\Models\Reaction::class);
    }
}
