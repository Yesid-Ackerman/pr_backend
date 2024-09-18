<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accident extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'hora','lugar'];
    protected $table = 'accidents';

    protected $allowIncluded = ['accident_vehicles','vehicles']; // Relaciones permitidas para inclusión
    public function Accident_Vehicle()
    {
        return $this->belongsToMany('App\Models\Vehicle','accident_vehicles');
    }
    // Scope para incluir relaciones
    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included'));
        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {
            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }
        $query->with($relations);
        
    }
}
