<?php

// MovieController.php
namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        
        return view('index', compact('movies'));
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id); // Retrieve the movie by its ID
        return view('movies.show', compact('movie')); // Pass the movie data to the show view
    }
}
