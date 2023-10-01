<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

     // Define una relación: Un registro "Todo" pertenece a una categoría "Category".
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Define otra relación: Un registro "Todo" pertenece a una descripción "Description".
    public function description()
    {
        return $this->belongsTo(Description::class, 'description_id');
    }
}
