<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Orders</title>
</head>

<body>
    <table>
        <tr>
            <th>User Id</th>
            <th>User Name</th>
            <th>Order Id</th>
            <th>Product Id</th>
            <th>Product name</th>
            <th>Sub Total</th>
            <th>Shipping</th>
            <th>Coupon Code</th>
            <th>Coupon Code ID</th>
            <th>Discount</th>
            <th>Grand Total</th>
            <th>Address</th>
            <th>Locality/Town</th>
            <th>City</th>
            <th>State</th>
            <th>Pincode</th>
            <th>Order Time</th>
            <th>Order Status</th>
            <th>Payment Status</th>
            <th>Product Image</th>
        </tr>

        @foreach ($myOrders as $order)
            @foreach ($order->orderItems as $item)
                <tr align="center">
                    <td>{{ $order->user_id ?? '-' }}</td>
                    <td>{{ $order->name ?? '-' }}</td>
                    <td>{{ $order->id ?? '-' }}</td>
                    <td>{{ $item->product_id ?? '-' }}</td>
                    <td>{{ $item->product->title ?? '-' }}</td>
                    <td>{{ $order->subtotal ?? '-' }}</td>
                    <td>{{ $order->shipping ?? '-' }}</td>
                    <td>{{ $order->coupon_code ?? '-' }}</td>
                    <td>{{ $order->coupon_code_id ?? '-' }}</td>
                    <td>{{ $order->discount ?? '-' }}</td>
                    <td>{{ $order->grand_total ?? '-' }}</td>
                    <td>{{ $order->address ?? '-' }}</td>
                    <td>{{ $order->locality_town ?? '-' }}</td>
                    <td>{{ $order->city ?? '-' }}</td>
                    <td>{{ $order->state ?? '-' }}</td>
                    <td>{{ $order->pincode ?? '-' }}</td>
                    <td>{{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('d M,Y h:s:i') : '-' }}
                    </td>
                    <td>{{ $order->order_status ?? '-' }}</td>
                    <td>{{ $order->payment_status ?? '-' }}</td>
                    <td>
                        @if ($item->product && $item->product->product_images->first())
                            <img src="{{ asset('uploads/Products/' . $item->product->product_images->first()->image) }}"
                                alt="{{ $item->product->product_images->first()->image }}"
                                title="{{ $item->product->product_images->first()->image }}" style="width: 20px;" />
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                </tr>
                <br>
            @endforeach
        @endforeach
    </table>
</body>


</html>
