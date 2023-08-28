<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit photo</title>
    <link rel = "icon" href ="../icon.png" type = "image/png">
    <link rel="stylesheet" href="{{URL::asset('css/editproduct.css')}}">

</head>
<body>
    <div class = "home_main_div">
        <div>
            <img src="{{'../../manimages/'.$product[0]->product_picture}}" alt="">
        </div>
        <form action="{{route('applyeditproduct',$product[0]->id)}}" method="post" multiple enctype="multipart/form-data">
            @csrf
            @method('POST')
            <label for="name" class="label">Product Name</label>
            <input type="text" name="product_name" id="name" class ="textinput" value="{{$product[0]->product_name}}">

            <label for="price">Product price</label>
            <input type="text" name="product_price" id="price" class ="textinput" value="{{$product[0]->product_price}}">

            <label for="image">Product Picture</label>
            <div class="image_div">
                <input type="file" name="image" id="">
            </div>

            <div class ="buttons">
                <input type="submit" value="Edit">
                <a href="{{route('returnhomeedit.back')}}">Back</a>
            </div>

        </form>
    </div>
</body>
</html>
