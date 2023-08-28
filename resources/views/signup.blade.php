<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href={{URL::asset('css/signup.css')}}  rel="stylesheet">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v6.4.2/css/all.css">
    <link rel = "icon" href ="../icon.png" type = "image/png">
    <title>Sign Up</title>
</head>
<body>
    <div class = "form_div">
        <h1 class = "form_div_header">Sign Up</h1>
        <form action="{{route('member.signup')}}" method="post" multiple enctype="multipart/form-data">
            @csrf
            @method('POST')
            <span class ="span_icon"><i class="fa-solid fa-user"></i></span>
            <input type="text" name="email" id="" class ="text_input"placeholder= "Email" value="{{old('email')}}">
            <span style="display: block;color:red;margin-top: -23px;">@error('email'){{$message}} @enderror</span>
            <br>

            <span class ="span_icon"><i class="fa-solid fa-pen"></i></span>
            <input type="text" name="name" id="" class ="text_input"placeholder= "Name" value="{{old('name')}}">
            <span style="display: block;color:red;margin-top: -23px;">@error('name'){{$message}} @enderror</span>
            <br>

            <span class ="span_icon"><i class="fa-solid fa-lock"></i></span>
            <input type="password" name="pass" id="" class ="text_input" placeholder = "Password" value = "{{old('pass')}}">
            <span style="display: block;color:red;margin-top: -23px;">@error('pass'){{$message}} @enderror</span>

            <div class = "check_user">
                <span class ="check_span">Admin</span>
                <input type="radio" name="check" id="" value="admin"class ="input_check" >


                <span class = "check_span">User</span>
                <input type="radio" name="check" id="" value="user" class  = "input_check" >

                <span style="display: block;
                color: red;
                text-align: left;">@error('check'){{$message}} @enderror</span>
            </div>

            <div class ="for_image">
                <span style="color:#32aeb7;display:inline-block;margin:4px 0px;">Choosr Your Picture</span>
                <input type="file" name="picture" id="" style="color:#32aeb7;display:inline-block;margin:7px 0px;" value = "{{old('picture')}}">
                <span style="display: block;color:red;">@error('picture'){{$message}} @enderror</span>

            </div>

            <div class = "submit_div">
                <input type="submit" name = "Login" class = "login_button">
                <span>Not a member <a href="{{Route('login.page')}}">Login</a></span>
            </div>
            @if(Session::has('success'))
                <div class="success_fail">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
                <div class="success_fail_wrong">{{Session::get('fail')}}</div>
            @endif
        </form>
    </div>
</body>
</html>
