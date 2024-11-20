<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reviews = $user->reviews()->with('movie')->get();

        return view('dashboard', compact('reviews'));
    }
}
