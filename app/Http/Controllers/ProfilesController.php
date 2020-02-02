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
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user) {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url|required',
            'image' => 'image|required',
        ]);
        
        $image_path = request('image')->store('uploads', 'public');
        
        $image = Image::make(public_path("storage/{$image_path}"))->fit(1200,1200, function($constraint) {
            $constraint->upsize();
        });
        $image->save();
        
        $user->profile->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'url' => $data['url'],
            'image' => $image_path,
        ]);
        
        return redirect('/profile/'.$user->id);
    }
}
