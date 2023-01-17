<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FavouriteGig;
use App\Models\Gig;
use App\Models\User;
use Illuminate\Http\Request;

class FavouriteGigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $user_id = auth()->user()->id;
        $favourite_gigs = FavouriteGig::where('user_id', $user_id)->get();


        return view('gigs.loved-gigs', compact('categories', 'favourite_gigs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Gig $gig)
    {
        FavouriteGig::create([
            'gig_id' => $gig->id,
            'user_id' => $user->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FavouriteGig  $favouriteGig
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Gig $gig)
    {
        $favourite_gig = FavouriteGig::where('user_id', $user->id)->where('gig_id', $gig->id)->delete();
    }
}
