@include('user.layout.header')

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        {{-- <th>Price</th> --}}
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    <?php $subtotalprice = 0; ?>
                    @foreach ($show_cart as $row)
                        <tr>
                            <td class="align-middle"><img src="/Product_Images/{{ $row->product_image }}" alt=""
                                    style="width: 50px;">{{ $row->product_name }}</td>
                            {{-- <td class="align-middle">{{ $row->product_price }}</td> --}}
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        {{-- <button class="btn btn-sm btn-primary btn-minus">
                        <i class="fa fa-minus"></i>
                    </button> --}}
                                    </div>
                                    <input type="text"
                                        class="form-control form-control-sm bg-secondary border-0 text-center"
                                        value="{{ $row->product_quantity }}" readonly disabled>
                                    <div class="input-group-btn">
                                        {{-- <button class="btn btn-sm btn-primary btn-plus">
                        <i class="fa fa-plus"></i>
                    </button> --}}
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">{{ $row->product_price }}</td>

                            <td class="align-middle">
                                <a href="{{ route('user.remove_cart', $row->id) }} "
                                    onclick="return confirm('Are you sure to remove this product ?')"><button
                                        class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></a>
                            </td>
                        </tr>
                        <?php $subtotalprice += $row->product_price; // Accumulate the total price ?>
                    @endforeach




                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-30" action="">
                <div class="input-group">
                    <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                    Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        @if ($show_cart->isEmpty())
                            <h6>0</h6>
                        @else
                            <h6>{{ $row->product_price }}</h6>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">100</h6>
                    </div>
                    <?php $shipping_price = 100; ?>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <?php $totalprice = $shipping_price + $subtotalprice; ?>
                        <h5>Total</h5>
                        <h5>{{ $totalprice }}</h5>
                    </div>

                    <a href="{{ route('user.checkout') }}">
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To
                            Checkout</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@include('user.layout.footer')
