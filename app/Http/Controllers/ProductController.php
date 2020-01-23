<?php

namespace App\Http\Controllers;

use Auth;
use Toastr;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;

class ProductController extends Controller
{
    // Restrict this controller to authenticated users
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all products
        $products = Product::with('shoppingLists', 'category')->paginate(10);

        // Load view
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get categories to populate category select menu
        $categories = Category::orderBy('title')->pluck('title', 'id')->toArray();

        // Load view
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        // Store product
        $product = Product::create(
            $request->input()
        );

        // Message
        Toastr::success('Product has been created');

        // Redirect
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // Get categories to populate category select menu
        $categories = Category::orderBy('title')->pluck('title', 'id')->toArray();

        // Load view
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProductRequest $request, Product $product)
    {
        // Update product
        $product->update(
            $request->input()
        );

        // Message
        Toastr::success('Product has been updated');

        //Redirect
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Get product
        $product = Product::findOrFail($id);

        if ($request->ajax())
        {
            // Delete product
            $product->delete();

            // Return response
            return response(['msg' => 'Product has been deleted', 'status' => 'success']);
        }
    }
}
