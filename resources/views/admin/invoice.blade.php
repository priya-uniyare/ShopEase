<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <center>
    Customer Name : {{$data->user->name}} <br> <br>
    Customer Address : {{$data->address}}<br> <br>
    Customer Phone :{{$data->phone}}<br> <br>
    Product :{{$data->product->product_title}}<br> <br>
    Product Price :{{$data->product->product_price}}<br> <br>
  </center>
</body>

</html>