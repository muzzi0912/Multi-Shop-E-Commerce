@include('user.layout.header')


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

@if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show w-50">

        {{ session()->get('message') }}
    </div>
@endif
<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing
                    Address</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="row">
                    @foreach ($checkout as $item)
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" readonly disabled
                                placeholder="{{ $item->name }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" readonly disabled
                                placeholder="{{ $item->email }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input class="form-control" type="text" readonly disabled
                                placeholder="{{ $item->address }}">
                        </div>
                    @endforeach





                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                    Total</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom">
                    <h6 class="mb-3">Products</h6>
                    @foreach ($checkout as $item)
                        <div class="d-flex justify-content-between">
                            <p>{{ $item->product_name }}</p>
                            <p>{{ $item->product_price }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="border-bottom pt-3 pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6>{{ $subtotal }}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">{{ $shipping }}</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>{{ $total }}</h5>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3"><span
                        class="bg-secondary pr-3">Payment</span></h5>
                <div class="bg-light p-30">
                    {{-- <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-primary mx-2">
                            <a href="{{ route('user.place_order') }}"><input type="radio" name="payment"
                                    id="paypal"> Cash On Delivery</a>
                        </label>
                        <label class="btn btn-outline-primary mx-2">
                            <input type="radio" name="payment" id="directcheck"> Direct Check
                        </label>
                        <label class="btn btn-outline-primary mx-2">
                            <input type="radio" name="payment" id="banktransfer"> Bank Transfer
                        </label>
                    </div> --}}
                    <a href="{{ url('/Order') }}"><button
                            class="btn btn-block btn-primary font-weight-bold py-3 mt-3">Cash On delivery</button></a>
                    <a href="{{ route('user.stripe', $total) }}"><button
                            class="btn btn-block btn-primary font-weight-bold py-3 mt-3">Pay Using Card</button></a>
                </div>
            </div>

        </div>

    </div>
</div>
</div>
<!-- Checkout End -->


@include('user.layout.footer')
