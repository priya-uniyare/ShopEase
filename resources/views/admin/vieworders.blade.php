@extends('admin.maindesign')

@section('view_orders')
<table style="width:100%; border-collapse:collapse;font-family:Arial,sans-serif;">

    <thead>
        <tr style="background-color:#f2f2f2;">
            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Customer Name
            </th>
            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Address
            </th>

            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Phone
            </th>

            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Product
            </th>

            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Price
            </th>

            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Product Image
            </th>


            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Actions
            </th>

            <th style="padding:12px;text-align:left; border-bottom:1px solid #ddd;">
                Download
            </th>
        </tr>
    </thead>

    <tbody>

        @foreach( $orders as $order)
        <tr style="border-bottom:1px solid #ddd;">
            <td style="padding:12px;">{{$order->user->name}}</td>
            <td style="padding:12px;">{{$order->address}}</td>
            <td style="padding:12px;">{{$order->phone}}</td>
            <td style="padding:12px;">{{$order->product->product_title}}</td>
            <td style="padding:12px;"> ₹{{$order->product->product_price}}</td>
            <td style="padding:12px;"><img src="{{ asset('products/'.$order->product->product_image) }}" width="150px" alt="Product Image">
            </td>
            <td style="padding:12px;" class="row m-2">
                <form action="{{ route('admin.change_status', $order->id) }}" method="post" class="p-3 rounded shadow-sm bg-light border" style="max-width: 350px;">
                    @csrf
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold text-secondary">Change Order Status</label>
                        <select name="status" id="status" class="form-select border-primary">
                            <option value="pending">{{ $order->status }}</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success btn-sm px-3" onclick="return confirm('Are you sure you want to change the status?')">
                            <i class="bi bi-check-circle me-1"></i> Update
                        </button>
                    </div>
                </form>
            </td>

            <td style="padding:12px;">
                <a href="{{route('admin.downloadpdf',$order->id)}}" class="btn btn-primary ">
                    Download PDF
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>


</table>
@endsection