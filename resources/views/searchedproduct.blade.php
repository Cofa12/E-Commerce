<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>
    <link rel = "icon" href ="../icon.png" type = "image/png">
    <link rel="stylesheet" href="{{URL::asset('css/searched.css')}}">
</head>
<body>
    <header>Search for &nbsp;<span>{{$keyword}}</span>
    </header>

    <div class ="man_product" id="man_div">
        @if(empty($products))
            <span>NO Result</span>
        @else
        @foreach ($products as $item)
        <div>
            <h2>{{$item->product_name}}</h2>
            <h3><span style="color: orange">price</span>  {{$item->product_price}}$</h3>
            <h3><span style="color: orange">category</span>  {{$item->category->category_name}}</h3>
            <img src="{{'./../manimages/'.$item->product_picture}}" alt="">
            <div class ="deleteDiv">
                <form action="{{route('addto.cart',$item->id)}}" class ="add_form">
                    <input type="submit" value="Add to Cart">
                </form>
                <form action="{{route('addlove',$item->id)}}">
                    @if(Session::get('id'.$item->id."".$userId)==$item->id)

                    <button onclick="myHeart()" id="myheart" type="submit">
                        <img src="../heart.png" alt="" id="img">
                    </button>
                    @else

                    <button onclick="myHeart()" id="myheart" type="submit">
                        <img src="../heart1.png" alt="" id="img">
                    </button>
                     @endif
                </form>
                <div class="lovers" style="width: 54px;
                height: 30px;
                margin-top: 2px;
                display: flex;
                justify-content: center;
                align-items: center;color:red">
                {{$item->loves}} loves
                </div>
            </div>
        </div>
        @endforeach
        @endif
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
