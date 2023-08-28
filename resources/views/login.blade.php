<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href={{URL::asset('css/login.css')}}  rel="stylesheet">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v6.4.2/css/all.css">
    {{-- <link rel="icon" href="https://www.flaticon.com/free-icon/shopping-online_4072313?term=ecommerce&related_id=4072313" type="image/icon type"> --}}
    <link rel = "icon" href ="../icon.png" type = "image/png">
    <title>Login</title>
</head>
<body>
    <div class = "form_div">
        <h1 class = "form_div_header">LOGIN</h1>
        <form action="{{route('login.validate')}}" method="post">
            @csrf
            @method('POST')
            <span class ="span_icon"><i class="fa-solid fa-user"></i></span>
            <input type="text" name="email" id="" class ="text_input"placeholder= "Email" value ="{{old('email')}}">
            <span style="display: block;color:red;margin-top: -23px;">@error('email'){{$message}} @enderror</span>
            <br>
            <span class ="span_icon"><i class="fa-solid fa-lock"></i></span>
            <input type="password" name="pass" id="" class ="text_input" placeholder = "Password">
            <span style="display: block;color:red;margin-top: -23px;">@error('pass') {{$message}}@enderror</span>

            <div class = "check_user">
                <span class ="check_span">Admin</span>
                <input type="radio" name="check" id="" value="admin"class ="input_check">

                <span class = "check_span">User</span>
                <input type="radio" name="check" id="" value="user" class  = "input_check">
            </div>
            <span style="display: block;color:red;margin-top: -23px;">@error('check') {{$message}}@enderror</span>

            <div class = "submit_div">
                <input type="submit" name = "Login" class = "login_button">
                <span>Not a member <a href="{{Route('signup.page')}}">Sign up</a></span>
            </div>
            @if(Session::has('pass'))
                <div class ="wrong">{{Session::get('pass')}}</div>
            @endif
            @if(Session::has('nodata'))
                <div class = "wrong">{{Session::get('nodata')}}</div>
            @endif
            @if(Session::has('needLogin'))
                <div class = "wrong">{{Session::get('needLogin')}}</div>
            @endif

        </form>
    </div>
</body>
</html>
