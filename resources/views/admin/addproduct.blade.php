@extends('admin.maindesign')


@section('add_product')

@if(session('added_product_message'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relatives">
    {{session('added_product_message')}}
</div>
@endif
<div class="container my-5">
    <div class="card shadow p-4" style="max-width: 600px; margin: auto;">
        <h3 class="text-center mb-4 text-primary">Add New Product</h3>
        <form action="{{ route('admin.postaddproduct') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Product Title</label>
                <input type="text" name="product_title" class="form-control" placeholder="Enter Product Name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Description</label>
                <textarea name="product_description" class="form-control" rows="3" placeholder="Enter Product Description" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Quantity</label>
                <input type="number" name="product_quantity" class="form-control" placeholder="Enter Quantity" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Price</label>
                <input type="number" name="product_price" class="form-control" placeholder="Enter Price" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product image</label>
                <input type="file" name="product_image" class="form-control" placeholder="Enter product image" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Select Category</label>
                <select name="product_category" class="form-select" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-sm" onclick="this.style.backgroundColor='green'">Add Product</button>
            </div>
        </form>
    </div>
</div>

@endsection