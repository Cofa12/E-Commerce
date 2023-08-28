<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "icon" href ="../icon.png" type = "image/png">
    <link rel="stylesheet" href="{{URL::asset('css/delivey.css')}}">
    <title>Your-Cart</title>
</head>
<body>
    <div class="all" id ="man_div_container">
        <img src="../../delivery1.png" alt="">
        <h1>The Order will be recived in one week </h1>
        <a href="{{route('returnhomeuser.back')}}">Back</a>
    </div>
<script src="{{URL::asset('js/showmorecart.js')}}"></script>
</body>
</html>
