<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GigImage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['gig_id', 'image_name'];

    public function gig()
    {
        return $this->belongsTo(Gig::class);
    }
}
