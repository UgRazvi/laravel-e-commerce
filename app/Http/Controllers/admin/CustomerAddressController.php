<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress; // Adjust according to your model's namespace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAddressController extends Controller
{
    //

    public function destroy($id)
    {
        $address = CustomerAddress::findOrFail($id);
        $address->delete();
        return redirect()->back()->with('success', 'Address removed successfully.');
    }

    public function update(Request $request, $id)
    {
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

        $address = CustomerAddress::findOrFail($id);
        if ($request->default_address == 1) {
            CustomerAddress::where('user_id', $address->user_id)
                ->update(['default_address' => 0]);
        }
        $address->update($request->all());
        return redirect()->back()->with('success', 'Address updated successfully.');
    }

    public function viewUserAddress()
    {
        $user = Auth::user();
        $customerAddress = CustomerAddress::where('user_id', $user->id)->first();
        return view("front.account.myAddress", compact("customerAddress"));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_no' => 'required|string|min:10|max:15',
            'pincode' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'locality_town' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'type' => 'required|in:home,work',
            'default_address' => 'nullable|boolean',
        ]);

        if ($request->default_address) {
            CustomerAddress::where('user_id', Auth::id())->update(['default_address' => 0]);
        }

        CustomerAddress::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'pincode' => $request->pincode,
            'address' => $request->address,
            'locality_town' => $request->locality_town,
            'city' => $request->city,
            'state' => $request->state,
            'type' => $request->type,
            'default_address' => $request->default_address ?? 0,
        ]);

        return redirect()->back()->with('success', 'New address added successfully!');
    }

}
