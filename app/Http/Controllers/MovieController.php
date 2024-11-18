<?php

// MovieController.php
namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Review;


class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        
        return view('index', compact('movies'));
    }

    public function show($id)
{
    $movie = Movie::with('reviews.user')->findOrFail($id);
    return view('movies.show', compact('movie'));
    $movie = Movie::with('reviews')->findOrFail($id);

        // Pass movie and reviews to the view
        return view('movie.show', compact('movie'));
}

public function addReview(Request $request, $movieId)
{
    $request->validate([
        'comment' => 'required|string|max:255',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    Review::create([
        'user_id' => auth()->id(),
        'movie_id' => $movieId,
        'comment' => $request->comment,
        'rating' => $request->rating,
    ]);

    return redirect()->route('movies.show', $movieId)->with('success', 'Review added successfully!');
}

public function storeReview(Request $request, $movieId)
{
    // Validate input
    $validated = $request->validate([
        'comment' => 'required|string|max:500',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    // Save the review
    Review::create([
        'movie_id' => $movieId,
        'user_id' => auth()->id(), // Assuming user is logged in
        'comment' => $validated['comment'],
        'rating' => $validated['rating'],
    ]);

    // Redirect back with a success message
    return redirect()->route('movies.show', $movieId)->with('success', 'Review submitted successfully!');
}

}
