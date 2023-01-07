<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $categories = Category::get();
        return view('auth.register', compact('categories'));
    }

    public function register(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ]);

        $attr['password'] = bcrypt($attr['password']);
        $attr['join_date'] = Carbon::now();
        User::create($attr);

        return redirect('/login')->with('success', 'Register Successfully');;
    }
}
