<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function teams_avg_sizea()
    {
        return $this->hasMany(Team::class)
            ->select('country_id')
            ->selectRaw('AVG(size) as average_size')
            ->groupBy('country_id');
    }

    public function getTeamsAvgSizeAttribute()
    {
        return round($this->teams_avg_sizea->first()->average_size ?? 0);
    }
}
