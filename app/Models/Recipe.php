<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Recipe
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $body
 * @property int $user_id
 */
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
