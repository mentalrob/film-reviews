<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Film;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FilmsController extends Controller
{
    public function index()
    {
        $films = Film::with('reviews', 'comments')->get();
        return Inertia::render('Welcome', compact("films"));
    }

    public function review(Request $request, Film $film)
    {
        $film->load('reviews');
        $film->load('comments.user');
        $review = Review::where("user_id", $request->user()->id)->where('film_id', $film->id)->first();

        $canReview = $review === null;
        return Inertia::render('Review', compact('film', 'canReview', 'review'));
    }

    public function rate(Request $request, Film $film)
    {
        $request->validate([
            "rate" => "required|numeric"
        ]);

        $film->reviews()->create([
            "rate" => $request->rate,
            "user_id" => $request->user()->id
        ]);
        return redirect()->back();
    }

    public function comment(Request $request, Film $film)
    {
        $film->comments()->create([
            "body" => $request->input('comment'),
            "user_id" => $request->user()->id
        ]);
        return redirect()->back();
    }
}
