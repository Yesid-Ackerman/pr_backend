<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['marca', 'modelo','people_id'];
    protected $table = 'vehicles';

    protected $allowIncluded = ['peoples', 'fines','accidents']; // Relaciones permitidas para inclusión
    public function Fines(): HasMany
    {
        return $this->hasMany(Fine::class, 'id_fine');
    }

    public function Accidents()
    {
        return $this->belongsToMany('App\Models\Accident','accident_vehicles');
    }

    // Scope para incluir relaciones
    public function scopeIncluded(EloquentBuilder $query)
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
