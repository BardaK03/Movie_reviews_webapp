<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
  
     protected $fillable = ['movie_id', 'user_id', 'comment', 'rating'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Define relationship to User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define relationship to Movie.
     */
    public function movie()
{
    return $this->belongsTo(Movie::class, 'movie_id', 'id');
    return $this->belongsTo(Movie::class);
}
public $timestamps = false; // Disable timestamps


    /**
     * Accessor to limit the displayed length of the comment.
     */
    public function getShortCommentAttribute()
    {
        return \Illuminate\Support\Str::limit($this->comment, 50);
    }
}
