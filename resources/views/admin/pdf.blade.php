<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img.product-image {
            max-width: 100px;
            height: auto;
        }

        .product-container {
            border: 1px solid #ddd;
            padding: 20px;
            width: 400px;
            margin: 0 auto;
            text-align: center;
        }

        .product-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-description {
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 18px;
            color: #ff5722;
        }
    </style>
</head>

<body>
    <div class="product-container">
        <div class="product-title">CUSTOMER NAME: {{ $order->name }}</div>
        <div class="product-description">EMAIL: {{ $order->email }}</div>
        <div class="product-description">PHONE: {{ $order->phone }}</div>
        <div class="product-description">ADDRESS: {{ $order->address }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Quantity</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
                <th>Product Image</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order->product_name }}</td>
                <td>{{ $order->product_quantity }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>{{ $order->delivery_status }}</td>
                <td><img class="product-image"
                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/Product_Images/' . $order->product_image))) }}"
                        alt="Product Image"></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
