<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Toastr;
use App\ShoppingList;
use Illuminate\Http\Request;
use App\Mail\ShoppingListEmail;
use App\Http\Requests\CreateShoppingListRequest;

class ShoppingListController extends Controller
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
        // Get all shopping lists
        $shoppingLists = ShoppingList::with('products')->paginate(5);

        // Load view
        return view('shopping-lists.index', compact('shoppingLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Load view
        return view('shopping-lists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShoppingListRequest $request)
    {
        // Store shopping list
        $shoppingList = ShoppingList::create(
            $request->input()
        );

        // Message
        Toastr::success('List has been created');

        // Redirect
        return redirect()->route('shopping-lists.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingList $shoppingList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingList $shoppingList)
    {
        return view('shopping-lists.edit', compact('shoppingList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function update(CreateShoppingListRequest $request, ShoppingList $shoppingList)
    {
        // Update shopping list
        $shoppingList->update(
            $request->input()
        );

        // Message
        Toastr::success('List has been updated');

        // Redirect
        return redirect()->route('shopping-lists.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Get shopping list
        $shoppingList = ShoppingList::findOrFail($id);

        if ($request->ajax())
        {
            // Delete shopping list
            $shoppingList->delete();

            // Return response
            return response(['msg' => 'List has been deleted', 'status' => 'success']);
        }
    }

    public function email($shoppingList)
    {
        // Get logged in user
        $user = auth()->user();

        // Get shopping list
        $shoppingList = ShoppingList::find($shoppingList);

        // Send email
        Mail::to($user)->send(new ShoppingListEmail($user, $shoppingList));

        // Message
        Toastr::success('List has been emailed');

        // Redirect
        return back();
    }
}
