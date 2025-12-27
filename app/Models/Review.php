<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 *
 * @property int $id
 * @property int $recipe_id
 * @property int $user_id
 * @property int $rating
 * @property string|null $comment
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
