<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plantes extends Model
{
    

  public $fillable = [
        'common_name',
        'watering_general_benchmark',
        'api_id',
        'watering',
        'watering_period',
        'flowers',
        'fruits',
        'leaf',
        'growth_rate',
        'maintenance'
    ];

     public $casts =  [
          'watering_general_benchmark'=> 'array'
     ];

     public function users(): BelongsToMany
     {
          return $this->belongsToMany(User::class, 'users_plantes', 'plante_id', 'user_id');
     }
}
