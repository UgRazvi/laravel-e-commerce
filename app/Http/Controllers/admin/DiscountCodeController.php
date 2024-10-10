<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class DiscountCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Start with the query builder for DiscountCoupon
        $discountCoupon = DiscountCoupon::query();

        // Apply keyword search if provided
        if (!empty($request->get("keyword"))) {
            $keyword = $request->get("keyword");
            $discountCoupon = $discountCoupon
                ->where("code", "like", "%" . $keyword . "%")
                ->orWhere("name", "like", "%" . $keyword . "%");
        }

        // Paginate the results after applying conditions
        $discountCoupon = $discountCoupon->paginate(10);

        return view("admin.coupon.list", compact("discountCoupon"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.coupon.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'type' => 'required|in:Fixed,Percent',
            'discount_amount' => 'required|numeric',
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            if (!empty($request->starts_at) && !empty($request->expires_at)) {
                $now = Carbon::now();
                $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);
                $endAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->expires_at);

                if ($startAt->lt($now)) { // Check if 'starts_at' is less than the current time
                    return response()->json([
                        'status' => false,
                        'errors' => ["starts_at" => "Start Date ($startAt) Can't Be Less Than Current Time ($now)."],
                    ]);
                } else if ($endAt->lt($now)) { // Check if 'starts_at' is less than the current time
                    return response()->json([
                        'status' => false,
                        'errors' => ["expires_at" => "End Date ($endAt) Can't Be Less Than Current Time ($now)."],
                    ]);
                } else if ($endAt->lt($startAt)) { // Check if 'starts_at' is less than the current time
                    return response()->json([
                        'status' => false,
                        'errors' => ["expires_at" => "End Date ($startAt) Can't Be Less Than Start Date ($startAt)."],
                    ]);
                }
            }

            $discountCoupon = new DiscountCoupon();

            $discountCoupon->code = $request->code;
            $discountCoupon->name = $request->name;
            $discountCoupon->description = $request->description;
            $discountCoupon->max_usage = $request->max_usage;
            $discountCoupon->max_usage_user = $request->max_usage_user;
            $discountCoupon->type = $request->type;
            $discountCoupon->discount_amount = $request->discount_amount;
            $discountCoupon->min_amount = $request->min_amount;
            $discountCoupon->starts_at = $request->starts_at;
            $discountCoupon->expires_at = $request->expires_at;
            $discountCoupon->status = $request->status;
            $discountCoupon->save();

            $message = 'Discount Coupon Has Been Added Successfully!!!';
            session()->flash("success", $message);
            return response()->json([
                'status' => true,
                'message' => $message,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
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
     * Show the composer require intervention/image for editing the specified resource.
     */
    public function edit($couponId, Request $request)
    {

        // echo $couponId; // Testing Purpose
        $coupon = DiscountCoupon::find($couponId);
        if (empty($coupon)) {
            session()->flash('error', 'Record Not Found !!!');
            return redirect()->route('coupon.index');
        }
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($couponId, Request $request)
    {
        $coupon = DiscountCoupon::find($couponId);
        if (empty($coupon)) {
            session()->flash('error', 'Record Not Found !!!');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Category Not Found'
            ]);
        }
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'type' => 'required|in:Fixed,Percent',
            'discount_amount' => 'required|numeric',
            'status' => 'required',
        ]);
        if ($validator->passes()) {
            $coupon->code = $request->code;
            $coupon->name = $request->name;
            $coupon->description = $request->description;
            $coupon->max_usage = $request->max_usage;
            $coupon->max_usage_user = $request->max_usage_user;
            $coupon->type = $request->type;
            $coupon->discount_amount = $request->discount_amount;
            $coupon->min_amount = $request->min_amount;
            $coupon->starts_at = $request->starts_at;
            $coupon->expires_at = $request->expires_at;
            $coupon->status = $request->status;
            $coupon->save();

            return redirect()->route('coupon.index')->with('success', 'Coupon Has Been Updated Successfully');

            // session()->flash('success', 'Coupon Has Been Updated Successfully');
            // return response()->json([
            //     'status' => true,
            //     'message' => 'Coupon Has Been Updated Successfully'
            // ]);

        } else {

            // return redirect()->route('coupon.index')->with('success', 'Coupon Has Been Updated Successfully')->with('errors', $validator->errors());

            return response()->json([
                'status' => false,
                'message' => 'Sorry. The Coupon Could Not Be Updated.',
                'errors' => $validator->errors(), // Include validation errors

            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($couponId, Request $request)
    {
        $coupon = DiscountCoupon::find($couponId); // TO Find Category By Using ID
        if (empty($coupon)) {
            // return redirect()->route('categories.index');

            session()->flash("error", "Category Could Not Be Found.");

            return response()->json([
                "status" => false,
                "message" => "Category Could Not Be Deleted Successfully."
            ]);
        }

        $coupon->delete();


        session()->flash("success", "Category Has Been Successfully Deleted.");

        return response()->json([
            "status" => true,
            "message" => "Category Has Been Deleted Successfully !",
        ]);
    }
}
