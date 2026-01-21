<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'description', 'image', 'active'];

    public function sizes()
    {
        return $this->belongsToMany(PizzaSize::class, 'pizza_size_prices')
            ->withPivot('price');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
}
