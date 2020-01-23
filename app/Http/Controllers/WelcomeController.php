<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\Product;
use App\ShoppingList;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        if (Auth::check()){
            $categories_count = Category::where('title', '!=', 'Uncategorised')->count();
            $products_count = Product::all()->count();
            $shopping_lists_count = ShoppingList::all()->count();
        } else {
            $categories_count = null;
            $products_count = null;
            $shopping_lists_count = null;
        }

        // Load view
        return view('welcome', compact('categories_count', 'products_count', 'shopping_lists_count'));
    }
}
