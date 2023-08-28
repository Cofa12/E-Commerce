<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "icon" href ="../icon.png" type = "image/png">
    <link href={{URL::asset('css/addproduct.css')}}  rel="stylesheet">

    <title>Add-Product</title>
</head>
<body>
    <div class ="overview">
        <header>
            <h2><span style="color: #32d5e0">•</span> Product Overview</h2>
        </header>
        <form action="{{route('saveproduct.admin')}}" method="post" multiple enctype="multipart/form-data">
            @csrf
            @method('POST')
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" placeholder="Product Name" class="need_style">
            <span style="color: red">@error('product_name'){{$message}} @enderror</span>

            <div class="pricing_div">
                <h3>Pricing</h3>
                <label for="product_price">Price</label>
                <input type="text" name="product_price" id="product_price" placeholder="Product Price" class="need_style">
                <span style="color: red">@error('product_price'){{$message}} @enderror</span>

            </div>

            <div class="pricing_div">
                <h3>Category</h3>
                <span>male</span>
                <input type="radio" name="type" id="" value="male" class="radio_type">
                <span>Female</span>
                <input type="radio" name="type" id="" value="female" class="radio_type">
                <span>kids</span>
                <input type="radio" name="type" id="" value="kids" class="radio_type">
            </div>
            <span style="color: red">@error('type'){{$message}} @enderror</span>


            <h3 style="margin-top: 40px;">Image Photo</h3>
            <div class="image-div">
                <input type="file" name="image" id="">
            </div>
            <span style="color: red;display:block">@error('product_picture'){{$message}} @enderror</span>

            <div class="link_send">
                <input type="submit" value="Save" class="save">
                <a href="{{route('returnhomeedit.back')}}">Back</a>
            </div>


        </form>
    </div>
</body>
</html>
