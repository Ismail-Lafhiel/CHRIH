<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy("id", "desc")->paginate(10);
        return view("index", compact("products"));
    }
}
