<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //must have this
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        //dd($user);
        // $user = User::findOrFail($user);
        
        // return view('profiles.index',[
        //     'user' => $user,
        // ]);
        $follows = (auth() -> user()) ? auth() -> user() -> following -> contains($user -> id) : false;
        //dd($follows);

       // $postCount = $user -> posts -> count();
        $postCount = Cache::remember(
            'count.posts.'.$user->id, //key
            now() -> addSeconds(30), //now + 30 sec
            function() use ($user) {
            return $user -> posts -> count();
        });

        $followersCount = $user -> profile -> followers -> count();
        $followingCount = $user -> following -> count();

        return view('profiles.index', compact('user','follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this -> authorize('update', $user -> profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $data = request() -> validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',

        ]);
        //$imagePath = "/jpg/oufeow-main.jpg";
        if(request('image')){
            $imagePath = request('image') -> store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}")) -> fit(1200,1200);
            $image -> save();
            auth() -> user() -> profile -> update(array_merge(
                $data,
                ['image' => $imagePath]
            ));
        }

        //dd($data);
        else{
            auth() -> user() -> profile -> update(
                $data
            );
        }

        //dd($data);

        return redirect("profile/{$user -> id}");

        //dd($data);
    }
}
