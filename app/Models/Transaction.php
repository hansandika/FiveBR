<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['gig_id', 'user_id', 'seller_id', 'type', 'price', 'transaction_date'];
    protected $dates = ['transaction_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function gig()
    {
        return $this->belongsTo(Gig::class);
    }
}
