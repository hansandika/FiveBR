<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gig;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::get();
        $title = $request->title;
        $min_budget = (int) $request->min_budget;
        $max_budget = (int) $request->max_budget;
        $seller_name = $request->seller_name;

        $gigs = new Gig();

        if (strlen($title) > 0) {
            $gigs = Gig::where('title', 'like', '%' . $request->title . '%');
        }
        if ($request->category_id > 0) {
            $gigs = $gigs->where('category_id', $request->category_id);
        }
        if ($min_budget != 0) {
            $gigs = $gigs->where('basic_price', '>=', $min_budget);
        }
        if ($max_budget != 0) {
            $gigs = $gigs->where('premium_price', '<=', $max_budget);
        }
        if (strlen($seller_name) > 0) {
            $user = User::where('name', 'like', '%' . $seller_name . '%')->first();
            if ($user) {
                $gigs = $gigs->where('user_id', $user->id);
            } else {
                $gigs = $gigs->where('user_id', 0);
            }
        }

        $gigs = $gigs->paginate(10);

        return view('search.index', compact('categories', 'gigs'));
    }
}
