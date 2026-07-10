<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Ingredients;

class Recipes extends Model
{
    protected $table = 'recipes';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image_url',
        'total_time',
        'servings',
        'steps',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredients::class)
            ->withPivot('weight');
    }
}
