<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                            <h4 class="card-title">All Trash Product</h4>
                            {{-- <p class="card-description"> Add class <code>.table-dark</code> --}}
                            </p>
                            <div class="table-responsive">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Product Category</th>
                                            <th> Product Name</th>
                                            <th> Product Image</th>
                                            <th> Product Description</th>
                                            <th> Product Price</th>
                                            <th> Discount Price</th>

                                            <th> Action </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->product_category }}</td>
                                                <td>{{ $row->product_name }}</td>
                                                <td>
                                                    <img src="/Product_Images/{{ $row->product_image }}" alt="Product"
                                                        style="width: 50px;height: 50px;object-fit: cover;margin-left: 20px; border-radius: 1px">
                                                </td>

                                                <td>{{ $row->product_description }}</td>
                                                <td>{{ $row->product_price }}</td>
                                                <td>{{ $row->product_discount_price }}</td>

                                                <td><a href="{{ route('restore.product', $row->id) }}"><button
                                                            class="btn btn-primary">Restore</button></a></td>
                                                <td><a onclick="return confirm('Are You Sure You Want To Delete This Product')"
                                                        href="{{ route('force.delete.product', $row->id) }}"><button
                                                            class="btn btn-danger">Delete</button></a> </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</body>

</html>
