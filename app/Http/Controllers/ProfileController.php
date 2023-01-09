<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $categories = Category::get();
        return view('profile.index', compact('user', 'categories'));
    }

    public function update(Request $request, User $user)
    {
        $attr = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_image' => ['file', 'image']
        ]);

        if (request()->file('profile_image')) {
            Storage::delete('public/profile-pictures/' . $user->profile_image);
            $thumbnail = request()->file('profile_image')->hashName();
            $path = request()->file('profile_image')->store('public/profile-pictures');
        } else {
            $thumbnail = $user->profile_image;
        }

        $attr['profile_image'] = $thumbnail;
        $attr['about'] = $request->about;
        $attr['description'] = $request->description;
        $user->update($attr);

        return redirect('/profile/' . $user->id);
    }

    public function edit(User $user)
    {
        $categories = Category::get();
        return view('profile.edit', compact('user', 'categories'));
    }
}
