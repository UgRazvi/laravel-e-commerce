<?php

namespace App\Http\Controllers;

use App\Models\TempImage;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $theme_instance = Theme::orderBy('id', 'desc')->get();
        return view("admin.themes.list", compact('theme_instance')); // Pass data to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.themes.create");
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'key' => 'required|string|max:255|unique:themes,key',
            'type' => 'required|string',
            'logo' => 'nullable|string', // Since you're receiving an image ID, validate as string
            'value' => 'nullable|string|max:255', // Optional value field
        ]);

        // If the type is 'logo', handle the image move and store logic
        if ($request->type == 'logo' && $request->has('image_id')) {
            $tempImage = TempImage::find($request->image_id);

            // Validate that the image exists
            if (!$tempImage) {
                return back()->withErrors(['image_id' => 'Invalid image ID provided.']);
            }

            // Ensure the file exists before moving
            $sPath = public_path("/tempImgs/$tempImage->name");
            if (!File::exists($sPath)) {
                return back()->withErrors(['image_id' => 'The image file does not exist.']);
            }

            $ext = pathinfo($tempImage->name, PATHINFO_EXTENSION);
            $newImageName = uniqid('theme_', true) . '.' . $ext; // Generate a unique image name
            $dPath = public_path("/uploads/Themes/$newImageName");

            // Try to move the file
            try {
                File::move($sPath, $dPath);
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Failed to move the image.']);
            }

            // Create the new theme with the image name
            $theme = Theme::create([
                'key' => $request->key,
                'type' => $request->type,
                'value' => $newImageName,
            ]);
        } else {
            // If it's not a logo, just create the theme with the provided value
            $theme = Theme::create([
                'key' => $request->key,
                'type' => $request->type,
                'value' => $request->value,
            ]);
        }

        // Redirect with success message
        return redirect()->route('themes.index')->with('success', 'Theme created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $theme_instance = Theme::findOrFail($id); // Find the theme by ID
        return view("admin.themes.show", compact('theme_instance')); // Pass theme data to the view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $theme_instance = Theme::findOrFail($id); // Get the theme to edit
        return view("admin.themes.edit", compact('theme_instance')); // Pass theme to edit view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'key' => 'required|string|max:255|unique:themes,key,' . $id, // Exclude the current theme's key from uniqueness check
            'type' => 'required|string',
            'logo' => 'nullable|string', // For logo updates, it's still just a string
            'value' => 'nullable|string|max:255', // Optional value for non-logo types
        ]);
    
        // Find the theme to update
        $theme = Theme::findOrFail($id);
    
        // Check if the type is 'logo' and handle the image update
        if ($request->type == 'logo' && $request->has('image_id')) {
            $tempImage = TempImage::find($request->image_id);
    
            // Validate that the image exists
            if (!$tempImage) {
                return back()->withErrors(['image_id' => 'Invalid image ID provided.']);
            }
    
            // Ensure the file exists before moving
            $sPath = public_path("/tempImgs/$tempImage->name");
            if (!File::exists($sPath)) {
                return back()->withErrors(['image_id' => 'The image file does not exist.']);
            }
    
            $ext = pathinfo($tempImage->name, PATHINFO_EXTENSION);
            $newImageName = uniqid('theme_', true) . '.' . $ext; // Generate a unique image name
            $dPath = public_path("/uploads/Themes/$newImageName");
    
            // Try to move the file
            try {
                File::move($sPath, $dPath);
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Failed to move the image.']);
            }
    
            // Update the theme with the new image name
            $theme->update([
                'key' => $request->key,
                'type' => $request->type,
                'value' => $newImageName, // Store the new image name in value
            ]);
        } else {
            // If it's not a logo, just update the theme with the provided value
            $theme->update([
                'key' => $request->key,
                'type' => $request->type,
                'value' => $request->value, // Update value as provided
            ]);
        }
    
        // Redirect with success message
        return redirect()->route('themes.index')->with('success', 'Theme updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $theme_instance = Theme::findOrFail($id); // Find the theme
        $theme_instance->delete(); // Delete the theme
        return redirect()->route('themes.index'); // Redirect to the themes list
    }
}
