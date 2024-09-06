<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::latest();
        if (!empty($request->get('keyword'))) {
            $categories = $categories->where('name', 'LIKE', '%' . $request->get('keyword') . '%');
        }
        $categories = $categories->paginate(10);

        return view('admin.categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // echo "<h1> Category Create Page </h1>";
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'status' => 'required|in:0,1', // Ensure status is either 0 or 1
        ]);

        if ($validator->passes()) {
            $category = new Category(); // Corrected to Category
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            // Save Temporary Image Permanently Here.
            if (!empty($request->image)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id . '.' . $ext;

                $sPath = public_path() . '/tempImages/' . $tempImage->name;
                $dPath = public_path() . '/uploads/categoryImages/' . $newImageName;

                File::copy($sPath, $dPath);

                $category->image = $newImageName;
                $category->save();


            }

            $request->session()->flash('success', 'Category Has Been Added Successfully');
            // return route('categories.index');

            return response()->json([
                'status' => true,
                'message' => 'Category Has Been Added Successfully'
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
