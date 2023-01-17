<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id)->latest()->paginate(10);
        return view('transactions.index', compact('categories', 'transactions'));
    }
}
