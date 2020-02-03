<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    
    ///
    /*
    compact('user') is just a shorter form of passing ['user' = $user].
    */
    ///
    public function index(User $user)
    {
        return view('profiles.index', compact('user'));
    }
    
    public function edit(User $user) {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }
    
    ///
    /*
    update(User $user) is just telling Laravel that $user is an instance of the \App\User class (we don't need \App\ because we're already use-ing \App\User above). 
    This has the added benefit that instead of findOrDie($user) to give a 404 if /profile/$user doesn't exist, it'll automatically do it.
    */
    ///
    
    public function update(User $user) {
        $this->authorize('update', $user->profile);

        
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url|required',
            'image' => 'image',
        ]);
        
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            
            ///
            /*
            Using Intervention Image (use-d above) to resize the image to a square without up-sizing it (ie if the image passed is 400x300, it'll return an image of either 300x300 or 400x400, not sure which, but definitely not 1200x1200.
            
            Note also because I changed it during this update that I've changed $image_path to $imagePath to follow a Laravel convention I just heard about. (https://webdevetc.com/blog/laravel-naming-conventions)
            */
            ///
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200, function($constraint) {
                $constraint->upsize();
            });
            $image->save();
        }
        
        ///
        /*
        array_merge is merging $data and either writing or re-writing 'image' as $image_path.
        */
        ///
        auth()->user()->profile->update(array_merge(
            $data,
            ['image' => $imagePath]
        ));
        
        return redirect('/profile/'.$user->id);
    }
}
