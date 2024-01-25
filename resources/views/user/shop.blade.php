@include('user.layout.header')
@include('sweetalert::alert')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shop List</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Product Start -->
        <div class="col-lg-12 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="col-lg-3 col-md-4 col-sm-6 text-left">
                            <form action="{{ url('/Searchs') }}" method="GET">
                                @csrf
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control"
                                        placeholder="Search for products">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <button><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="ml-2">
                            <!-- Sorting and Showing options -->
                        </div>
                    </div>
                </div>

                @foreach ($product as $row)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 pb-1">
                        <a href="{{ route('user.detail', $row->id) }}" class="text-decoration-none">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <a href="{{ route('user.detail', $row->id) }}">
                                        <img class="card-img-top product-image"
                                            src="Product_Images/{{ $row->product_image }}" alt="">
                                    </a>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate"
                                        href="{{ route('user.detail', $row->id) }}">{{ $row->product_name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        @if ($row->product_discount_price != null)
                                            <span>Price : </span>
                                            <br>
                                            <h5 class="text-danger">{{ $row->product_discount_price }}</h5>
                                            <h6 class="text-muted ml-2"><del>{{ $row->product_price }}</del></h6>
                                        @else
                                            <span>Price : </span>
                                            <h6 class="text-muted ml-2">{{ $row->product_price }}</h6>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="far fa-star text-primary mr-1"></small>
                                        <small class="far fa-star text-primary mr-1"></small>
                                        <small>(99)</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                <div class="col-12">
                    <nav>
                        {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->



@include('user.layout.footer')
