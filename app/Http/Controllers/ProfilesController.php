<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        return view('profiles.index', compact('user'));
    }
    
    public function edit(User $user) {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user) {
        $this->authorize('update', $user->profile);

        
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url|required',
            'image' => 'image',
        ]);
        
        if (request('image')) {
            $image_path = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$image_path}"))->fit(1200,1200, function($constraint) {
            $constraint->upsize();
            });
            $image->save();
        }
        
        
        auth()->user()->profile->update(array_merge(
            $data,
            ['image' => $image_path]
        ));
        
        return redirect('/profile/'.$user->id);
    }
}
