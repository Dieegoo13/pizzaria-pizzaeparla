<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaSize extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'diameter'];

    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'pizza_size_prices')
            ->withPivot('price');
    }
}
