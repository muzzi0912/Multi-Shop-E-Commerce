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
                            <h4 class="card-title">All Category</h4>
                            {{-- <p class="card-description"> Add class <code>.table-dark</code> --}}
                            </p>
                            <div class="table-responsive">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Category Name</th>
                                            <th> Action </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category as $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->category_name }} </td>
                                                <td><a onclick="return confirm('Are You Sure You Want To Delete This Category')"
                                                        href="{{ route('delete.category', $row->id) }}"><button
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
