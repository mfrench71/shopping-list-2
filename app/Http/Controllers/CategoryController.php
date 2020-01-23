<?php

namespace App\Http\Controllers;

use Auth;
use Toastr;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller
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
        // Get all categories
        $categories = Category::with('products')->orderBy('sort_order')->paginate(10);

        // Load view
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Load view
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        // Store category
        $category = Category::create(
            $request->input()
        );

        // Message
        Toastr::success('Category has been created');

        // Redirect
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, Category $category)
    {
        // Update category
        $category->update(
            $request->input()
        );

        // Message
        Toastr::success('Category has been updated');

        // Redirect
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Get category
        $category = Category::findOrFail($id);

        // Delete category
        if ($request->ajax())
        {
            $category->delete();

            // Return response
            return response(['msg' => 'Category has been deleted', 'status' => 'success']);
        }
    }

    public function sort(Request $request)
    {
        // Get categories
        $categories = Category::orderBy('sort_order')->get();

        // Get query string parameters
        $category_id = request('category_id');
        $sort_order = request('sort_order');
        
        // Update sort order
        foreach ($categories as $category) {
            return Category::where('id', $category_id)->update(['sort_order' => $sort_order]);
        }
    }
}
