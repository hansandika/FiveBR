<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gig;
use App\Models\Review;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request, Gig $gig)
    {
        $type = $request->type;
        $type_price = $type . '_price';
        $price = $gig->$type_price;

        $allRating = Review::where('gig_id', $gig->id)->get();
        $rating = $allRating->count();

        $avg_rate = 0;
        foreach ($allRating as $rate) {
            $avg_rate += $rate->rating;
        }
        if ($rating > 0) {
            $avg_rate = ceil($avg_rate / $rating);
        }

        $categories = Category::get();
        return view('checkouts.index', compact('categories', 'gig', 'price', 'type', 'rating', 'avg_rate'));
    }

    public function store(Request $request, Gig $gig)
    {
        $this->authorize('purchase', $gig);

        $user = auth()->user();

        Transaction::create(
            [
                'gig_id' => $gig->id,
                'user_id' => $user->id,
                'seller_id' => $gig->user->id,
                'type' => $request->type,
                'price' => $request->price,
                'transaction_date' => Carbon::now()
            ]
        );
        return redirect('/gig/' . $gig->id)->with('success', 'Checkout success');
    }
}
