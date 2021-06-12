<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::orderBy('updated_at', 'desc')->paginate(10);
        return Inertia::render('Admin/Films/Index', compact("films"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Films/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "poster" => "required|file",
            "title" => "required|string",
            "writer" => "required|string",
            "actors" => "required|string",
            "director" => "required|string",
            "genre" => "required|string",
            "published_at" => "required|date",
            "year" => "required|numeric",
            "plot" => "required|string"
        ]);
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $path = Storage::disk('public')->putFileAs(
                'posters',
                $file,
                uniqid() . $file->getClientOriginalExtension()
            );
            $data['poster'] = Storage::disk('public')->url($path);
        }
        Film::create($data);
        return redirect()->back()
            ->with('message', 'Film Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        return $film;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        return Inertia::render('Admin/Films/Edit', compact("film"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        $data = $request->all();
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $path = Storage::disk('public')->putFileAs(
                'posters',
                $file,
                uniqid() . $file->getClientOriginalExtension()
            );
            $data['poster'] = Storage::disk('public')->url($path);
        }
        $film->update($data);
        return redirect()->back()
            ->with('message', 'Film Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $film->delete();
        return redirect()->back()
            ->with('message', 'Film Removed Successfully.');
    }
}
