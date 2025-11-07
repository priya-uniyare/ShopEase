@extends('admin.maindesign')


@section('add_category')

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relatives">
    {{session('success')}}
</div>
@endif
<div class="container my-5">
    <div class="card shadow p-4" style="max-width: 500px; margin: auto; border-radius: 15px;">
        <h4 class="text-center text-success mb-4">Add New Category</h4>

        <form action="{{ route('admin.postaddcategory') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-semibold">Category Name</label>
                <input type="text" name="category" class="form-control" placeholder="Enter Category Name" required>
            </div>

            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-success btn-sm px-4" onclick="ChangeColor(this)">
                    Add Category
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function ChangeColor(btn) {
        btn.style.backgroundColor = "darkgreen";
        btn.style.color = "white";
    }
</script>

@endsection