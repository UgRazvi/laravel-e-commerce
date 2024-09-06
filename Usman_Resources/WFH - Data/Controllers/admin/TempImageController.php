<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Http\Request;

class TempImageController extends Controller
{

    public function create(Request $request)
    {

        // Usman Multiple images
        // Validate each file in the request
        $request->validate([
            'file' => 'required',
            'file.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Modify as needed
        ]);

        $imagePaths = []; // Array to hold paths of uploaded images


        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                // Store each file and save the path
                $path = $file->store('tempImages', 'public');
                $imagePaths[] = $path; // Store the path in an array
            }
        }

        // Return a response with the paths of the uploaded images
        return response()->json([
            'success' => true,
            'image_paths' => $imagePaths,
        ]);

        // Usman Multiple images

        // $image = $request->image;
        // if (!empty($image)) {
        //     $ext = $image->getClientOriginalExtension();
        //     $newName = time() . '.' . $ext;
        //     $tempImage = new TempImage();
        //     $tempImage->name = $newName;
        //     $tempImage->save();
        //     $image->move(public_path() . '/tempImages', $newName);
        //     return response()->json([
        //         'status' => true,
        //         'image_id' => $tempImage->id,
        //         'message' => 'Image Has Been Uploaded Successfully.'
        //     ]);
        // }
    }
}
