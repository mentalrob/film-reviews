<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FilmsController extends Controller
{
    public function index()
    {
        $films = Film::with('reviews')->get();
        return Inertia::render('Welcome', compact(("films")));
    }
}
