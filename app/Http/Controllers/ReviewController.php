<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Gig $gig)
    {
        $this->authorize('comment', $gig);

        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'description' => 'required'
        ]);

        $user_id = auth()->user()->id;
        Review::create([
            'gig_id' => $gig->id,
            'user_id' => $user_id,
            'rating' => $request->rating,
            'description' => $request->description,
            'review_date' => Carbon::now()
        ]);

        return redirect('/gig/' . $gig->id)->with('success', 'Review posted');
    }
}
