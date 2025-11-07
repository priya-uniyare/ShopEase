@extends('admin.maindesign')

@section('view_product')

@if(session('delete_product_message'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relatives">
    {{session('delete_product_message')}}
</div>
@endif

<div class="container mt-3">
    <form id="searchForm" action="{{ route('admin.searchproduct') }}" method="post" class="d-flex" role="search">
        @csrf
        <input class="form-control me-2" type="search" name="search" placeholder="What are you searching for..." aria-label="Search" required>
        <button class="btn btn-primary" type="submit">Search</button>
    </form>
</div>


<br>
<br>

@if(session('fail'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relatives">
    {{session('fail')}}
</div>
@endif
<table style="width:100%; border-collapse:collapse;font-family:Arial,sans-serif;">

    <thead>
        <tr style="background-color:#f2f2f2;">
            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Product ID
            </th>
            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Product Title
            </th>

            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Product Description
            </th>

            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Product Quantity
            </th>

            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Product Price
            </th>

            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Product Category
            </th>

            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Product Image
            </th>
            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Actions
            </th>
        </tr>
    </thead>

    <tbody>

        @foreach( $products as $product)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:12px;">{{$product->id}}</td>
            <td style="padding:12px;">{{$product->product_title}}</td>
            <td style="padding:12px;">{{Str::limit( $product->product_description,50,'.....')}}</td>
            <td style="padding:12px;">{{$product->product_quantity}}</td>
            <td style="padding:12px;"> ₹{{$product->product_price}}</td>
            <td style="padding:12px;">{{$product->product_category}}</td>
            <td style="padding:12px;"><img src="{{ asset('products/'.$product->product_image) }}" width="150px" alt="Product Image">
            </td>

            <td style="padding:12px;" class="row m-2">
                <form action="{{route('admin.deleteproduct',$product->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm  m-1" onclick="return confirm('Are you sure you want to delete this product?' )">Delete</button>
                </form>
                <a href="{{route('admin.updateproduct',$product->id)}}" style="background-color: green; 
          color: white; 
          text-decoration: none; 
          " class="btn btn-success btn-sm  m-1">Update</a>

            </td>
        </tr>
        @endforeach
        {{$products->links()}}
    </tbody>


</table>

@endsection