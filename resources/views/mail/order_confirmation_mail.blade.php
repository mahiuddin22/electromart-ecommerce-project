<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMU2LfjOe1AAwU1M9RyoqZ8IzDkz5Kf7R5d7cD" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            display: flex;
            justify-content: center;
            /* Center the text */
            align-items: center;
            font-size: 24px;
            /* Font size for the header text */
            font-weight: bold;
            /* Make the header text bold */
        }

        .email-body {
            padding: 30px;
        }

        .email-body h4 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .order-details {
            margin-bottom: 30px;
            width: 100%;
            border-collapse: collapse;
        }

        .order-details th,
        .order-details td {
            padding: 12px 15px;
            border: 1px solid #dddddd;
            vertical-align: middle;
        }

        .order-details th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .order-details td {
            text-align: center;
        }

        .product-image {
            max-width: 50px;
            height: auto;
            border-radius: 8px;
        }

        .total {
            font-weight: bold;
            font-size: 18px;
        }

        .btn-confirm {
            background-color: #28a745;
            /* Confirm button color */
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-confirm:hover {
            background-color: #218838;
        }

        .btn-print {
            background-color: #111d2e;
            /* Print button color */
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-print:hover {
            background-color: #c70000;
            /* Darker shade on hover */
        }

        .email-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }

        /* Info block styling */
        .info-block {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }

        .info-block .left,
        .info-block .right {
            width: 48%;
        }

        .info-block p {
            margin: 0;
            padding: 0;
        }

        /* Removed margin from printable area */
        #printable-area {
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 8px;
        }

        /* Full-width background for logo */
        .logo-background {
            width: 100%;
            padding: 10px 0;
            /* Padding around the logo */
            text-align: center;
            /* Center align logo */
            margin-bottom: 20px;
            /* Space below logo */
        }

        /* Additional styling for the logo */
        .print-logo {
            max-width: 150px;
            /* Set max width for logo */
            height: auto;
            /* Auto height to maintain aspect ratio */
        }
    </style>
    <script>
        function printInvoice() {
            var printContent = document.getElementById("printable-area").innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
</head>

<body>
        <?php
         $orders  = \App\Models\OrderHistory::where('user_id',$checkout->user_id)->where('checkout_id',$checkout->id)->get();
         $user    = \App\Models\User::where('id',$checkout->user_id)->first();
        ?>
    <div class="email-container">
        <div class="email-header">
            <!-- Header text instead of image -->
            Electromart
        </div>

        <div class="email-body">
            <h4>Thank you for your order!</h4>
            <p>Your order has been confirmed. Here are the details:</p>

            <!-- Printable area (Order Table and Customer Info) -->
            <div id="printable-area">
                <!-- Full-width background for logo -->
                <div class="logo-background">
                    <!-- Logo Image -->
                    <img src="{{url('public/uploads/system/'.$settings->logo)}}" alt="Electromart Logo" class="print-logo">
                </div>

                <!-- Customer Info -->
                <div class="info-block">
                    <!-- Left aligned information: Name and Phone -->
                    <div class="left">
                        <p><strong>Name:</strong> {!! $user->name !!}</p>
                        <p><strong>Phone Number:</strong> {!! $user->mobile !!}</p>
                    </div>
                    <!-- Right aligned information: Order Date and Shipping Address -->
                    <div class="right" style="text-align: right;">
                        <p><strong>Order Date:</strong> {!! $checkout->created_at->todatestring() !!}</p>
                        <p><strong>Shipping Address:</strong> {!! $checkout->shipping_address !!}</p>
                    </div>
                </div>

                <table class="table order-details">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Product</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key=>$order)
                        <?php
                            $product = \App\Models\Product::where('id', $order->product_id)->first();
                        ?>
                        <tr>
                            <td>{!! $key+1 !!}</td>
                            <td><img src="{{url('public/uploads/product/'.$product->image)}}" alt="Product 1" class="product-image"></td>
                            <td>{!! $product->name!!}</td>
                            <td>{!! $order->product_price!!}</td>
                            <td>{!! $order->product_quantity!!}</td>
                            <td>{!! $order->product_subtotal!!}</td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="5" class="total">Grand Total</td>
                            <td class="total">BDT {!! $checkout->grand_total !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <a href="{!! route('order.details', $checkout->id) !!}" class="btn btn-confirm">View Order</a>
            <!-- Print Button with Font Awesome Icon -->
        </div>

        <div class="email-footer">
            <p>If you have any questions, feel free to contact our support team.</p>
        </div>
    </div>

</body>

</html>