<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Http;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        return Film::paginate(50);
    }

    public function omdbQuery(Request $request)
    {
        $data = $request->validate([
            "title" => "required|string"
        ]);

        $response = Http::get("https://www.omdbapi.com/", [
            "apikey" => env("OMDB_KEY"),
            "s" => $data["title"],
            "type" => "movie"
        ]);

        return $response->json();
    }

    public function omdbQueryId(Request $request)
    {
        $data = $request->validate([
            "id" => "required|string"
        ]);

        $response = Http::get("https://www.omdbapi.com/", [
            "apikey" => env("OMDB_KEY"),
            "i" => $data["id"],
        ]);

        return $response->json();
    }
}
