<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FilmsController extends Controller
{
    public function index()
    {
        $films = Film::with('reviews')->get();
        return Inertia::render('Welcome', compact("films"));
    }

    public function review(Request $request, Film $film)
    {
        $film->load('reviews');
        $review = Review::where("user_id", $request->user()->id)->where('film_id', $film->id)->first();

        $canReview = $review === null;
        return Inertia::render('Review', compact('film', 'canReview', 'review'));
    }
}
