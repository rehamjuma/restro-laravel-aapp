<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class,'product_ingredient')->withPivot('amount');
    }
}
