<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory;

    protected $table = 'wishlists';

    protected $fillable =[
        'product_id',
        'user_id'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

}
