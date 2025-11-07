@extends('admin.maindesign')

<base href="/public">
@section('update_category')

@if(session('Category_updated_message'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relatives">
    {{session('Category_updated_message')}}
</div>
@endif
<div class="container my-5">
    <div class="card shadow p-4" style="max-width: 500px; margin: auto; border-radius: 15px;">
        <h4 class="text-center text-primary mb-4">Update Category</h4>

        <form action="{{ route('admin.postupdatecategory', $category->id) }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Category Name</label>
                <input type="text" name="category" value="{{ $category->category }}" class="form-control" placeholder="Enter Category Name" required>
            </div>

            <div class="text-center">
                <input type="submit" name="submit" value="Update Category" 
                       class="btn btn-light btn-sm px-4" 
                       onclick="ChangeColor(this)">
            </div>
        </form>
    </div>
</div>

<script>
    function ChangeColor(btn) {
        btn.style.backgroundColor = "black";
        btn.style.color = "white";
    }
</script>

@endsection