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
        'product_image',
        'stock'
    ];

    public function commandes()
    {
        return $this->belongsToMany(Commande::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class, "cart_product")->withPivot('quantity');;
    }
    public function wishlists()
    {
        return $this->belongsToMany(WishList::class);
    }
}
