<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel = "icon" href ="../icon.png" type = "image/png">
    <link rel="stylesheet" href="{{URL::asset('css/profile-admin.css')}}">
    <script src = "{{URL::asset('js/showmore.js')}}"></script>

</head>
<body>
    <div class="main">
        <div class= "profile_image">
            <img src="{{'../../images/'.$admin_picture}}" alt="" class="pro_img">
            <span>{{$admin_name}}<span><img src="../../admin.png" alt="" style='width: 22px;margin-bottom: -3px;'></span></span>
        </div>
    </div>
    <div class ="info">
        <h2> <span style="color: #32d5e0">•</span>Info</h2>
        <form action="{{route('updateuser.info')}}" method="post">
            @csrf
            @method('PUT')
            <label for="">Your Name</label>
            <input type="text" name="name" id="" class="need" value="{{$admin_name}}">

            <label for="">Your Email</label>
            <input type="text" name="email" id="" class="need" value="{{$admin_email}}">

            <input type="submit" value="Update" class="sub">
        </form>

        <form action="{{route('resetpassword.user')}}" method="post">
            @csrf
            @method('PUT')
            <label for="">Old Password</label>
            <input type="password" name="old" id="" class="need">

            <label for="">New Password</label>
            <input type="password" name="new" id="" class="need">
            <input type="submit" value="Reset" class="sub">
            @if(Session::has('fail'))
                <div class="success_fail_wrong">{{Session::get('fail')}}</div>
            @endif
        </form>
    </div>
    <div class="content">
        <h2>
            <span><span style="color: #32d5e0">•</span> Order</span>
            {{-- <span class="items">{{$numberOrder}} orders</span> --}}
        </h2>
        @foreach($orders as $order)
        <div class='item_div'>
            <div class ="name_div">
                <h2>Order {{$order->id}}</h2>
                <span>{{$count = $userproduct->where('order_id','=',$order->id)->count()}} items</span>
                <h3>Order Price {{$order->order_price}} $</h3>
            </div>
            <div class ="photo_div">
                <form action="{{route('addreceipt',$order->id)}}">
                    <input type="submit" value="Reciept">
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <div class ="log_out">
        <a href="{{route('logout.profile')}}">
            <img src="../../logout.png" alt=""> &nbsp;logout
        </a>

    </div>
    <footer>
        <h2><a href="{{route('returnhomeuser.back')}}" style="text-decoration: none;color:#FFF">Cofa.com</a></h2>
        <div class="links">
            <a href="">home</a>
            <a href="man_div">Male</a>
            <a href="#woman_div">Female</a>
            <a href="#kids_div">Kids</a>
            <a href="">docs</a>
        </div>
        <div class=img_div>
            <img src="../../me.jpg" alt="">
        </div>

        <div class=img_social>
            <a href="https://www.facebook.com/profile.php?id=100049577781950&mibextid=b06tZ0"><img src="../../facebook.png" alt=""></a>
            <a href="https://wa.me/01018178072"><img src="../../whats.png" alt=""></a>
            <a href="https://www.linkedin.com/in/mahmoud-gamal-98a7b41b1"><img src="../../linked.png" alt></a>
            <a href="https://github.com/Cofa12"><img src="../../github.png" alt></a>
        </div>
        <div class="text">
            Copyright &copy; All rights reserved | This website is made by &hearts; <span>Cofa</span>
        </div>
    </footer>
</body>
</html>
