<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    protected $fillable = ['station_from_id', 'station_to_id', 'price', 'date_start', 'date_end',];

    public function stationFrom(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'station_from_id');
    }

    public function stationTo(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'station_to_id');
    }

    public function trains(): BelongsToMany
    {
        return $this->belongsToMany(Train::class, 'trains2routes', 'route_id', 'train_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
