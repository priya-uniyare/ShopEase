@extends('maindesign')

@section('viewcart_products')




<div class="container mt-4">



    <h2 class="mb-4 text-center">Your Cart</h2>

    <div class="table-responsive shadow-sm">
        <table class="table table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Product Title</th>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>

                @php
                $price=0;
                @endphp
                @foreach($cart as $cart_product)
                <tr>
                    <td class="fw-semibold">{{ $cart_product->product->product_title }}</td>
                    <td class="text-success fw-bold">₹{{$cart_product->product->product_price }}</td>
                    <td>
                        <img src="{{asset('products/'.$cart_product->product->product_image)}}"
                            class="img-thumbnail" style="width:120px; height:auto;">
                    </td>
                    <td class="text-success fw-bold"> <a class="btn btn-danger" href="{{route('removecartproducts',$cart_product->id)}}">Remove</a></td>
                </tr>
                @php
                $price=$price+$cart_product->product->product_price;
                @endphp
                @endforeach
                <tr style="border-bottom: 1px solid #ddd; background-color:gray;">
                    <td>Total Price =</td>
                    <td>{{$price}}</td>
                    <td></td>
                    <td></td>
                </tr>


            </tbody>

        </table>


        @if(session('order_message'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert" style="max-width:600px;margin:auto;">
    <strong>Success</strong> {{ session('order_message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
</div>
@endif



        <!-- Order Form -->
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-header bg-secondary text-white text-center">
                            <h4 class="mb-0">Delivery Details</h4>
                        </div>

                        <div class="card-body p-4">
                            <form action="{{route('confirm_order')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Address</label>
                                    <input type="text" name="address" class="form-control form-control-lg" placeholder="Enter your address" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Phone Number</label>
                                    <input type="text" name="phone" class="form-control form-control-lg" placeholder="Enter your phone number" required>
                                </div>

                                <button type="submit" class="btn bg-secondary btn-lg w-100 mt-2">
                                    Confirm Order
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>
@endsection