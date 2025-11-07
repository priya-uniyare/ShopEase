@extends('admin.maindesign')

@section('view_category')

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relatives">
    {{session('success')}}
</div>
@endif

@if(session('fail'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relatives">
    {{session('fail')}}
</div>
@endif
<table style="width:100%; border-collapse:collapse;font-family:Arial,sans-serif;">

    <thead>
        <tr style="background-color:#f2f2f2;">
            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Category ID
            </th>
            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Category Name
            </th>

            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Actions
            </th>
        </tr>
    </thead>

    <tbody>

        @foreach( $categories as $category)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:12px;">{{$category->id}}</td>
            <td style="padding:12px;">{{$category->category}}</td>
            <td style="padding:12px;" class="row m-2">

                <form action="{{route('admin.deletecategory',$category->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm  m-1" onclick="return confirm('are you sure' )">Delete</button>
                </form>


                <a href="{{ route('admin.updatecategory', $category->id) }}" style="background-color: green; 
          color: white; 
          text-decoration: none; 
          " class="btn btn-success btn-sm  m-1">Update</a>


            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection