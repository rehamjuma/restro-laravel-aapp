<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'current_amount',
        'initial_amount',
        'is_alert_email_sent'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_ingredient');
    }

}
