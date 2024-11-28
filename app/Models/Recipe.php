<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'introductions', 'ingredients', 'directions', 'image', 'category', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
