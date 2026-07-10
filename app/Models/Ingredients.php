<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recipes;
use App\Models\Ingredients_Recipes;
use App\Models\User;

class Ingredients extends Model
{
    protected $table = 'ingredients';

    protected $fillable = [
        'name',
        'unit',
        'customer_id',
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipes::class)
            ->withPivot('amount');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('quantity');
    }
}
