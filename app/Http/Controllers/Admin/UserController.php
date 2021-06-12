<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('updated_at', 'desc')->paginate(10);
        return Inertia::render('Admin/Users/Index', compact("users"));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            unset($data['photo']);
            $file = $request->file('photo');
            $path = Storage::disk('public')->putFileAs(
                'profile_photos',
                $file,
                uniqid() . $file->getClientOriginalExtension()
            );
            $data['profile_photo_path'] = $path;
        }
        $user->update($data);
        return redirect()->back()
            ->with('message', 'User Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->comments()->delete();
        $user->reviews()->delete();
        $user->delete();
        return redirect()->back()
            ->with('message', 'User Removed Successfully.');
    }
}
