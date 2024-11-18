<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Movie;
use Illuminate\Http\Request;

class ReviewController extends Controller // This is the key line
{
   

    // Store a new review
    public function store(Request $request, $movieId)
    {
        $validated = $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $movie = Movie::findOrFail($movieId);

        $review = new Review();
        $review->user_id = auth()->id();
        $review->movie_id = $movieId;
        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->save();

        return redirect()->route('movies.show', $movieId)
                         ->with('success', 'Review submitted successfully!');
    }

    // Show the form to edit the review
    public function edit(Review $review)
    {
        if ($review->user_id != auth()->id()) {
            return redirect()->route('movies.show', $review->movie_id)
                             ->with('error', 'You are not authorized to edit this review.');
        }

        return view('reviews.edit', compact('review'));
    }

    // Update an existing review
    public function update(Request $request, Review $review)
    {
        if ($review->user_id != auth()->id()) {
            return redirect()->route('movies.show', $review->movie_id)
                             ->with('error', 'You are not authorized to update this review.');
        }

        $validated = $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->save();

        return redirect()->route('movies.show', $review->movie_id)
                         ->with('success', 'Review updated successfully!');
    }

    // Delete a review
    public function destroy(Review $review)
    {
        if ($review->user_id != auth()->id()) {
            return redirect()->route('movies.show', $review->movie_id)
                             ->with('error', 'You are not authorized to delete this review.');
        }

        $review->delete();

        return redirect()->route('movies.show', $review->movie_id)
                         ->with('success', 'Review deleted successfully!');
    }
}
