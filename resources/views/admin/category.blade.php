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
                    <div class="alert alert-success alert-dismissible fade show">

                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">ADD CATEGORY</h4>
                            <form class="forms-sample" action="{{ route('add.category') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id=""
                                        placeholder="Category Name" style="color: black">

                                    @error('category_name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <button class="btn btn-success mr-2">Submit</button>
                                <a href="{{ route('show.category') }}"><button class="btn btn-primary">Back To All
                                        Category</button></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


</body>

</html>
