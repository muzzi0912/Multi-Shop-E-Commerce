@include('user.layout.header')

@foreach ($order as $row)
    <style>
        .container {
            margin-top: 20px;
        }

        .card {
            border: 1px solid #ccc;
            box-shadow: 2px 2px 5px #ccc;
        }

        .card-header {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        img.img-fluid {
            max-width: 100%;
            height: auto;
            max-height: 300px;
            /* Set the maximum height for the image */
        }

        .cancel-button {
            background-color: #ff3333;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .cancel-button i {
            margin-right: 5px;
        }
    </style>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order Details

                    </div>

                    <div class="card-body">
                        <h4>Order ID: {{ $row->id }} </h4>
                        <p><strong>Product Name:</strong>{{ $row->name }}</p>
                        <p><strong>Quantity:</strong>{{ $row->product_quantity }}</p>
                        <p><strong>Price:</strong>{{ $row->product_price }}</p>

                        <p><strong>Delivery Status:</strong>{{ $row->delivery_status }}</p>
                        <p><strong>Payment Status:</strong>{{ $row->payment_status }}</p>
                        <p><strong>Product Image:</strong></p>
                        <img src="{{ asset('Product_Images/' . $row->product_image) }}" alt="Product Image"
                            class="img-fluid">

                        @if ($row->delivery_status == 'Processing')
                            <a href="{{ route('user.cancel_order', $row->id) }}"><button class="cancel-button"
                                    onclick="return confirm('Are You Sure You Want TO Cancelled The Order')">
                                    <i class="fas fa-times"></i> Cancel
                                </button></a>
                        @else
                            <button class="btn btn-success" disabled="disabled">Your Order Has Been Sucessfully
                                Deliverd</button>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@include('user.layout.footer')
