<?php

namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Support\Facades\Request;

class SettingController extends Controller
{
    // Show the form for editing the settings
    public function edit()
    {
        // Retrieve color settings from the database (with default fallback)
        $buttonColor = Setting::where('key', 'button_color')->first()->value ?? '#ff3f6c';
        $outlineColor = Setting::where('key', 'outline_color')->first()->value ?? '#ddd';

        // Pass the settings to the view
        return view('admin.settings.edit', compact('buttonColor', 'outlineColor'));
    }

    // Update the color settings in the database
    public function update(Request $request)
    {
        // Validate the color inputs
        $validated = $request->validate([
            'button_color' => 'required|string|max:7',  // Ensure it's a valid color code (e.g., #ff3f6c)
            'outline_color' => 'required|string|max:7', // Ensure it's a valid color code (e.g., #ddd)
        ]);

        // Update or create the button color setting
        Setting::updateOrCreate(
            ['key' => 'button_color'],
            ['value' => $request->button_color]
        );

        // Update or create the outline button color setting
        Setting::updateOrCreate(
            ['key' => 'outline_color'],
            ['value' => $request->outline_color]
        );

        // Redirect back with a success message
        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully.');
    }
}

