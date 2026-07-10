<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Recipes;

class Planning extends Model
{
    protected $table = 'planning';

    protected $fillable = [
        'user_id',
        'recipe_id',
        'planned_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipes::class);
    }
}
