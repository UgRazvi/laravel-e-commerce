<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order E-Mail</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 600px;
            background-color: #ffffff;
            margin: 20px auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Branding Header */
        .header {
            background-color: #1a73e8;
            padding: 20px;
            color: #fff;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .content {
            padding: 20px;
        }

        h2,
        h3 {
            color: #1a73e8;
            font-weight: bold;
        }

        .order-info {
            margin: 20px 0;
            font-size: 15px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #1a73e8;
            color: white;
        }

        .grand-total {
            background-color: #1a73e8;
            font-weight: bold;
            color: #fff;
            font-size: 18px;
        }

        .footer {
            background-color: #f4f4f4;
            color: #888;
            font-size: 12px;
            text-align: center;
            padding: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; font-size:16px;">
    @php
        $order = $maildata['order'];
    @endphp

    <div class="container">
        <div class="header">

            @if ($maildata['userType'] == 'customer')
                <h1>Thank You for Your Order!</h1>
                <p>Your order has been successfully placed.</p>
                <p><strong>Your Order ID:</strong> #{{ $order->transaction_id }}</p>
            @else
                <h1>You've got an Order!</h1>
                <p><strong>Order ID:</strong> #{{ $order->transaction_id }}</p>
            @endif

        </div>

        <div class="content">
            <h2>Order Details</h2>
            <div class="order-info">

                <p><strong>Customer Name:</strong> {{ $order->name }}</p>
                <p><strong>Email:</strong> {{ $order->user_email }}</p>
                <p><strong>Mobile Number:</strong> {{ $order->mobile_no }}</p>
            </div>

            <h3>Order Items</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Shipping</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->shipping ?? '-' }}</td>
                            <td>{{ $item->discount ?? '-' }}</td>
                            <td>${{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="grand-total">Grand Total:</th>
                        <td colspan="2" class="grand-total">&#8377;{{ number_format($order->grand_total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="footer">
            <p>For questions about your order, contact our support at support@myntra.com.</p>
            <p>&copy; {{ date('Y') }} Usman Myntra . All rights reserved.</p>
        </div>
    </div>
</body>

</html>
