<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class People extends Model
{
    protected $fillable = ['name', 'email'];
    protected $table = 'peoples';

    protected $allowIncluded = ['vehicles', 'fines']; // Relaciones permitidas para inclusión
    public function Fines(): HasMany
    {
        return $this->hasMany(Fine::class, 'id_fine');
    }

    public function Vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'id_vehicle');
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
