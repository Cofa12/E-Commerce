<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit photo</title>
    <link rel = "icon" href ="../icon.png" type = "image/png">
    <link rel="stylesheet" href="{{URL::asset('css/editphoto.css')}}">

</head>
<body>
    <div class = "home_main_div">
        <div>
            @foreach ($imagesData as $item )
            @if ($item->image_name=='background')
                <img src ="{{'../../webimages/'.$item->image_path}}">
                @endif
        @endforeach
        </div>
        <form action="{{route('applyimage.edit')}}" method="post" multiple enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="file" name="background" id="">
            <span style="color: red;display:block;margin:auto">@error('background'){{$message}} @enderror</span>
           <input type="submit" value="Edit" class="sub">
           <a href="{{route('returnhomeedit.back')}}">Back</a>
        </form>
    </div>
</body>
</html>
