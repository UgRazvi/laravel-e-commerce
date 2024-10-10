<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress; // Adjust according to your model's namespace;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    //

    public function destroy($id)
    {
        // Find the address by ID
        $address = CustomerAddress::findOrFail($id);

        // Delete the address
        $address->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Address removed successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:15',
            'pincode' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'locality_town' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'type' => 'required|string|in:home,work',
            'default_address' => 'nullable|boolean', // Validate the default address
        ]);

        // Find the address by ID
        $address = CustomerAddress::findOrFail($id);

        // If this address is marked as default, reset others to not default
        if ($request->default_address == 1) {
            // Reset other addresses for this user
            CustomerAddress::where('user_id', $address->user_id)
                ->update(['default_address' => 0]);
        }

        // Update the address
        $address->update($request->all());

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Address updated successfully.');
    }


}
