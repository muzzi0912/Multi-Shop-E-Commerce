<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    <style>
        /* Add CSS styles for input elements */
        input[type="text"],
        input[type="number"],
        textarea {
            color: black;
            /* Change text color to black */
        }

        option {
            color: black;
            /* Change text color to black */
        }

        select.js-example-basic-single::selection {
            color: black;
            /* Change the text color to black */
        }
    </style>
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
                            <h4 class="card-title">UPDATE PRODUCT</h4>
                            <form class="forms-sample" action="{{ route('view.update.product', $product->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select name="product_category" class="js-example-basic-single"
                                        style="width:100%; color: black;">
                                        <option value="{{ old('product_discount_price') }}" selected="">
                                            {{ $product->product_category }}</option>
                                        @foreach ($category as $row)
                                            <option value="{{ $row->category_name }}">{{ $row->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_category')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Product Name</label>
                                    <input type="text" name="product_name"
                                        value="{{ old('product_name', $product->product_name) }}" class="form-control"
                                        id="" placeholder="Product Name">

                                    @error('product_name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Product Quantity</label>
                                    <input type="number"
                                        value="{{ old('product_quantity', $product->product_quantity) }}"
                                        name="product_quantity" class="form-control" id=""
                                        placeholder="Product Quantity">

                                    @error('product_quantity')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Product Price</label>
                                    <input type="number" value="{{ old('product_price', $product->product_price) }}"
                                        name="product_price" class="form-control" id=""
                                        placeholder="Product Price">

                                    @error('product_price')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Product Discount</label>
                                    <input type="number"
                                        value="{{ old('product_discount_price', $product->product_discount_price) }}"
                                        name="product_discount_price" class="form-control" id="productDiscount"
                                        placeholder="Product Discount Price">
                                </div>

                                {{-- Current Image  --}}
                                <div class="form-group">
                                    <label for="xampleInputName1" class="form-label">Current Product Image</label>
                                    <img src="/Product_Images/{{ $product->product_image }}" alt="Product"
                                        style="width: 50px;height: 50px;object-fit: cover;margin-left: 20px; border-radius: 1px">
                                </div>

                                <div class="form-group">
                                    <label for="xampleInputName1" class="form-label">Change Product Image</label>
                                    <input class="form-control" name="product_image" id="productImage" type="file">
                                    @error('product_image')
                                        <div class="alert alert-danger mt-2" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="exampleTextarea1">Product Description</label>
                                    <textarea class="form-control" name="product_description" id="exampleTextarea1" rows="4">{{ old('product_description', $product->product_description) }}</textarea>
                                    @error('product_description')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>



                                <button class="btn btn-success mr-2">Update Product</button>
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
