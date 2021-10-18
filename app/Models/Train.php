<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    protected $fillable = [
        'number', 'max_seats_cnt'
    ];

    public function routes()
    {
        return $this->belongsToMany(Route::class, 'trains2routes', 'train_id', 'route_id');
    }
}
