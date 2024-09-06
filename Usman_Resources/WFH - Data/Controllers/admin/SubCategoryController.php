<?php

namespace App\Http\Controllers\admin;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function index()
    {
        // $subcategories = Category::latest()->paginatepaginate(10);
        return view("admin.subcategories.list");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // echo "<h1> Category Create Page </h1>";
        return view("admin.subcategories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:subcategories',
            'status' => 'required|in:0,1', // Ensure status is either 0 or 1
        ]);

        if ($validator->passes()) {
            $subcategory = new SubCategory(); // Corrected to Category
            $subcategory->name = $request->name;
            $subcategory->slug = $request->slug;
            $subcategory->status = $request->status;
            $subcategory->save();

            $request->session()->flash('success', 'Sub Category Has Been Added Successfully');

            return response()->json([
                'status' => true,
                'message' => 'Sub Category Has Been Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors() // Ensure the key is 'errors' to match your JavaScript
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
