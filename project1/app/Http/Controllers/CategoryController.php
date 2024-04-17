<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'time' => 'nullable|date_format:Y-m-d\TH:i',
        ]);

        // Parse and format the input time to the desired format
        $formattedTime = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('time'))->format('Y-m-d H:i:s');

        // Add the formatted time to the request data
        $requestData = $request->all();
        $requestData['time'] = $formattedTime;

        // Create the category using the modified request data
        Category::create($requestData);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Pass the category data to the view
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'time' => 'nullable|date_format:Y-m-d\TH:i',
        ]);

        // Parse and format the input time to the desired format
        $formattedTime = null;
        if ($request->has('time')) {
            $formattedTime = Carbon::createFromFormat('Y-m-d\TH:i', $request->input('time'))->format('Y-m-d H:i:s');
        }

        // Update the category with the modified request data
        $category->update([
            'name' => $request->input('name'),
            'time' => $formattedTime,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
