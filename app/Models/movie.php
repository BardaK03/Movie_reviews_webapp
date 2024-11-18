<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    public function reviews()
{
    return $this->hasMany(Review::class, 'movie_id', 'id');
    return $this->hasMany(Review::class);
}

    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movies';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'production',
        'genre',
        'description',
        'poster_url',
        'duration',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'duration' => 'integer',
    ];

    /**
     * Accessor to get the full URL for the poster.
     * Customize the logic as needed (e.g., append a base URL if stored locally).
     *
     * @return string
     */
    public function getPosterUrlAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    /**
     * Scope a query to only include movies of a certain genre.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $genre
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfGenre($query, $genre)
    {
        return $query->where('genre', $genre);
    }
}
