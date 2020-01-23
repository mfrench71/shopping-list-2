<?php

namespace App\Http\Controllers\ShoppingList;

use Toastr;
use App\Product;
use App\ShoppingList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($shoppingList)
    {
        // Get shopping list
        $shoppingList = ShoppingList::find($shoppingList);

        // Get available products (not in list)
        $products_available = Product::available($shoppingList);

        // Get products in list
        $products_in_list = $shoppingList->products->all();

        // Load view
        return view('shopping-lists.products.edit', compact('shoppingList', 'products_available', 'products_in_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $shoppingList)
    {
        // Get shopping list
        $shoppingList = ShoppingList::find($shoppingList);

        // Get notes
        $notes = request('notes');

        switch ($request->input('action')) 
        {
            case 'add_products':

                // Check if any product checkboxes ticked
                if (request('products'))
                {
                    // Get products to add
                    $products = request('products');

                    // Add products with notes to list
                    foreach ($products as $id)
                    {
                        $shoppingList->products()->attach(
                            $shoppingList->id,
                            [
                                'product_id' => $id,
                                'note' => $notes[$id]
                            ]
                        );
                    }
                
                    // Message
                    Toastr::success('Your products have been added to your list.');

                } else {
                    // If no checkboxes ticked
                    Toastr::info('No products selected.');
                }

                // Redirect
                return redirect()->route('shopping-lists-products.edit', $shoppingList);

                break;

            case 'add_essentials':

                // Get essential products to add
                $products = Product::essential()->available($shoppingList)->pluck('id');

                // Check if any essential products to add
                if ($products->count())
                {
                    // Add products with notes to list
                    foreach ($products as $id)
                    {
                        $shoppingList->products()->attach(
                            $shoppingList->id,
                            [
                                'product_id' => $id,
                                'note' => $notes[$id]
                            ]
                        );
                    }
                
                    // Message
                    Toastr::success('Your essential products have been added to your list.');

                } else {
                    // If no checkboxes ticked
                    Toastr::info('No essential products to add.');
                }

                // Redirect
                return redirect()->route('shopping-lists-products.edit', $shoppingList);

                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($shoppingList)
    {
        // Check if any product checkboxes ticked
        if (request('products'))
        {
            // Get shopping list
            $shoppingList = ShoppingList::find($shoppingList);

            // Get products to remove
            $products = request('products');

            // Remove products from list
            $shoppingList->products()->detach($products);

            // Message
            Toastr::success('The selected products have been removed from list.');

        } else {
            // If no checkboxes ticked
            Toastr::info('No products selected.');
        }
        // Redirect
        return redirect()->route('shopping-lists-products.edit', $shoppingList);
    }
}
