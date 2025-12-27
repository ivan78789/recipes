<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'body',
        'user_id',
        'category_id',
        'image',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
