<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    use HasFactory;

    protected $with = ['category'];

    protected $fillable = [
        'user_id', 'category_id', 'title', 'about', 'basic_price', 'basic_description',
        'standard_price', 'standard_description', 'premium_price',
        'premium_description'
    ];

    public function gigImages()
    {
        return $this->hasMany(GigImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favouriteGigs()
    {
        return $this->hasMany(FavouriteGig::class);
    }
}
