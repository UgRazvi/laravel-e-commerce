<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

    $orderStatusCounts = DB::table('orders')
    ->select('order_status', DB::raw('COUNT(*) as total'))
    ->groupBy('order_status')
    ->get();




        // $totalOrders = Order::count();
        $totalOrders = Order::whereIn('order_status', ['pending', 'shipped', 'delivered'])->count();

        $totalCustomers = User::where('role', 1)->whereStatus(1)->count();
        $totalAdmins = User::where('role', 2)->whereStatus(1)->count();
        $totalProducts = Product::count();

        $totalSales = Order::where('order_status', '!=', 'pending')->sum('grand_total');

        $totalOrdersLast30Days = Order::where('order_status', '!=', 'pending')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(29))
            ->count();

        $totalSalesLast30Days = Order::where('order_status', '!=', 'pending')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(29))
            ->sum('grand_total');

        $totalOrdersLastYear = Order::where('order_status', '!=', 'pending')
            ->whereDate('created_at', '>=', Carbon::now()->subYear())
            ->count();

        $totalSalesLastYear = Order::where('order_status', '!=', 'pending')
            ->whereDate('created_at', '>=', Carbon::now()->subYear())
            ->sum('grand_total');


        // Total Orders This Month
        $totalOrdersThisMonth = Order::where('order_status', '!=', 'pending')
            ->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfDay()
            ])
            ->count();

        // Total Sales This Month
        $totalSalesThisMonth = Order::where('order_status', '!=', 'pending')
            ->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfDay()
            ])
            ->sum('grand_total');
        
        $pendingOrders = Order::where('order_status', '=', 'pending')->count();

        $pendingOrdersSales = Order::where('order_status', '=', 'pending')->sum('grand_total');
        $shippedOrders = Order::where('order_status', '=', 'shipped')->count();
        $shippedOrdersSales = Order::where('order_status', '=', 'shipped')->sum('grand_total');
        $deliveredOrders = Order::where('order_status', '=', 'delivered')->count();
        $deliveredOrdersSales = Order::where('order_status', '=', 'delivered')->sum('grand_total');
            
        // dd($totalSales);
        return view("admin.dashboard", compact(
            "totalOrders",
            "totalCustomers",
            "totalAdmins",
            "totalProducts",
            "totalSales",
            "totalOrdersLast30Days",
            "totalSalesLast30Days",
            "totalOrdersLastYear",
            "totalSalesLastYear",
            "totalOrdersThisMonth",
            "totalSalesThisMonth",
            "pendingOrders",
            "shippedOrders",
            "deliveredOrders",
            "pendingOrdersSales",
            "shippedOrdersSales",
            "deliveredOrdersSales",
            "orderStatusCounts",
        ));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->user();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
