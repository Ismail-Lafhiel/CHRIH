<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'product_image'
    ];

    public function commandes()
    {
        return $this->belongsToMany(Commande::class);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function wishlist()
    {
        return $this->belongsTo(WishList::class);
    }
}
