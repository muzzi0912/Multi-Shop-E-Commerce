<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Admin</title>
</head>

<body>
    <div class="container-scroller">

        @include('admin.partials.navbar')

        @include('admin.partials.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                    <div class="alert alert-danger alert-dismissible fade show">

                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Orders</h4>
                            <form class="d-flex justify-content-end mb-3" action="{{ route('view.search') }}"
                                method="GET">
                                <input class="me-2" type="search" name="search" placeholder="Search"
                                    aria-label="Search" style="color: black">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                            {{-- <p class="card-description"> Add class <code>.table-dark</code> --}}
                            </p>
                            <div class="table-responsive">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Product Name</th>
                                            <th>Product Quantity</th>
                                            <th>Product Price</th>
                                            <th>Product Image</th>
                                            <th>Payment Status</th>
                                            <th>Delivery Status</th>
                                            <th>Actions</th>
                                            {{-- <th>Send Email</th> --}}

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->name }}</td>
                                                <td>{{ $order->email }}</td>
                                                <td>{{ $order->phone }}</td>
                                                <td>{{ $order->address }}</td>
                                                <td>{{ $order->product_name }}</td>
                                                <td>{{ $order->product_quantity }}</td>
                                                <td>{{ $order->product_price }}</td>
                                                <td>
                                                    <img src="/Product_Images/{{ $order->product_image }}"
                                                        alt="Product Image" width="50">
                                                </td>
                                                <td>{{ $order->payment_status }}</td>
                                                <td>{{ $order->delivery_status }}</td>
                                                <td>
                                                    @if ($order->delivery_status == 'Processing')
                                                        <a href="{{ route('deliverd.order', $order->id) }}">
                                                            <i class="fas fa-truck fa-lg mr-2"></i>
                                                            <!-- Truck icon for "Delivered" -->
                                                        </a>
                                                        <a href="mailto:{{ $order->email }}">
                                                            <i class="fas fa-envelope fa-lg mr-2"></i>
                                                            <!-- Email icon for sending an email -->
                                                        </a>
                                                        <a href="{{ route('view.pdf', $order->id) }}">
                                                            <i class="fas fa-print fa-lg"></i>
                                                            <!-- Print icon for "Print" -->
                                                        </a>
                                                    @else
                                                        <i class="fas fa-check-circle fa-lg"
                                                            style="color: green; margin-right: 10px;"></i>
                                                        <!-- Green checkmark icon for "Delivered" -->
                                                        <a href="{{ route('view.notify', $order->id) }}">
                                                            <i class="fas fa-envelope fa-lg mr-2"></i>
                                                            <!-- Email icon for sending an email -->
                                                        </a>
                                                        <a href="{{ route('view.pdf', $order->id) }}">
                                                            <i class="fas fa-print fa-lg"></i>
                                                            <!-- Print icon for "Print" -->
                                                        </a>
                                                    @endif
                                                </td>

                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="12" class="table-danger text-light"
                                                    style="text-align: center">NO DATA FOUND</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                                <div class="col-12">
                                    <nav>
                                        {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!}
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</body>

</html>
