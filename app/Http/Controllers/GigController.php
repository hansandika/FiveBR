<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FavouriteGig;
use App\Models\Gig;
use App\Models\GigImage;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gigs = Gig::latest()->paginate(4);
        $categories = Category::get();

        if ($request->ajax()) {
            $view = view('gigs.data', compact('gigs'))->render();
            return response()->json(['html' => $view]);
        }


        return view('gigs.index', compact('gigs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gig = new Gig();
        $categories = Category::get();
        return view('gigs.create', compact('categories', 'gig'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required'],
            'about' => ['required', 'string'],
            'basic_price' => ['required', 'integer', 'lt:standard_price', 'lt:premium_price'],
            'basic_description' => ['required', 'string'],
            'standard_price' => ['required', 'integer', 'gt:basic_price', 'lt:premium_price'],
            'standard_description' => ['required', 'string'],
            'premium_price' => ['required', 'integer', 'gt:basic_price', 'gt:standard_price'],
            'premium_description' => ['required', 'string'],
            'images' => ['array'],
            'images.*' => ['required', 'file', 'image', 'max:1000']
        ]);

        $attr['user_id'] = auth()->user()->id;
        $attr['category_id'] = $request->category;

        $gig = Gig::create($attr);
        $images = $request->images;

        foreach ($images as $image) {
            $thumbnail = $image->hashName();
            $path = $image->store('public/gig-images');
            GigImage::create(['gig_id' => $gig->id, 'image_name' => $thumbnail]);
        }

        return redirect('/profile/' . $attr['user_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function show(Gig $gig)
    {
        $categories = Category::get();
        $reviews = $gig->reviews;
        $reviews = $reviews->paginate(5);

        $allRating = Review::where('gig_id', $gig->id)->get();
        $rating = $allRating->count();

        $avg_rate = 0;
        foreach ($allRating as $rate) {
            $avg_rate += $rate->rating;
        }
        if ($rating > 0) {
            $avg_rate = ceil($avg_rate / $rating);
        }

        if (Auth::user()) {
            $user_id = auth()->user()->id;
            $favourite_gig = FavouriteGig::where('gig_id', $gig->id)->where('user_id', $user_id)->get();
            return view('gigs.show', compact('gig', 'categories', 'reviews', 'favourite_gig', 'rating', 'avg_rate'));
        } else {
            return view('gigs.show', compact('gig', 'categories', 'reviews', 'rating', 'avg_rate'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function edit(Gig $gig)
    {
        $this->authorize('edit', $gig);
        $categories = Category::get();
        return view('gigs.edit', compact('gig', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gig $gig)
    {
        $this->authorize('edit', $gig);

        $attr = $request->validate([
            'title' => ['required', 'string'],
            'category' => ['required'],
            'about' => ['required', 'string'],
            'basic_price' => ['required', 'integer', 'lt:standard_price', 'lt:premium_price'],
            'basic_description' => ['required', 'string'],
            'standard_price' => ['required', 'integer', 'gt:basic_price'],
            'standard_description' => ['required', 'string'],
            'premium_price' => ['required', 'integer', 'gt:basic_price'],
            'premium_description' => ['required', 'string'],
            'images' => ['array'],
            'images.*' => ['required', 'file', 'image']
        ]);

        $attr['user_id'] = auth()->user()->id;
        $attr['category_id'] = $request->category;

        $gig->update($attr);

        $images = $request->images;
        if ($images) {
            foreach ($gig->gigImages as $image) {
                Storage::delete('public/gig-images/' . $image->image_name);
                $image->delete();
            }
            foreach ($images as $image) {
                $thumbnail = $image->hashName();
                $path = $image->store('public/gig-images');
                GigImage::create(['gig_id' => $gig->id, 'image_name' => $thumbnail]);
            }
        }
        return redirect('/profile/' . $attr['user_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gig $gig)
    {
        foreach ($gig->gigImages as $image) {
            Storage::delete('public/gig-images/' . $image->image_name);
            $image->delete();
        }
        $gig->delete();

        $id = auth()->user()->id;
        return redirect('/profile/' . $id)->with('success', 'Gig Deleted');
    }
}
