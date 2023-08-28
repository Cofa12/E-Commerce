<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Commerce</title>
    <link rel = "icon" href ="../icon.png" type = "image/png">
    <link rel="stylesheet" href="{{URL::asset('css/home.css')}}">

</head>
<body onload="showhidden()">
    <div class = "home_main_div">
        <header>
            <div class ="logo">
                <span>COFA</span>
            </div>
            <div class = "links">
                <div class ="search">
                    <img src="../search.png" alt="">
                    <form action="{{route('searchproduct.get')}}" method="post">
                        @csrf
                        @method('POST')
                        <input type="search" name="search" id="">
                    </form>
                </div>
                <div class="all_links">
                    <a href="{{route('adminprofile')}}" class="profile"><img src="{{'../../images/'.$admin[0]->picture}}" alt=""></a>
                </div>
            </div>
        </header>
        <div class ="content_picture">
            <div>
                <h1>E-Commerce website
                    <p>Welcome to the home page,hope a nice trip</p>
                </h1>

            </div>
            <div>
                @foreach ($imagesData as $item )
                    @if ($item->image_name=='background')
                        <img src ="{{'../../webimages/'.$item->image_path}}">
                        @endif
                @endforeach
            </div>
        </div>
        <a href="{{route('editback.forward')}}">Edit Photo</a>
    </div>
    <div class= "add-Button">
        <a href="{{route('addproduct.admin')}}">Add a product</a>
    </div>
    <!-- Man section-->
    <div class= "man_container" id="man_div_container">
        <h1>Man Fashion</h1>
        <div class ="man_product" id="man_div">
            @foreach ($productDataMan as $item)
            <div>
                <h2>{{$item->product_name}}</h2>
                <h3><span style="color: orange">price</span>  {{$item->product_price}}$</h3>
                <img src="{{'./../manimages/'.$item->product_picture}}" alt="">
                <div class ="deleteDiv">
                    <form action="{{route('deleteproduct.home',$item->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class ="delete">
                    </form>
                    <form action="{{route('geteditProduct.home',$item->id)}}">
                        <input type="submit" value="Edit" class ="edit">
                    </form>
                </div>
                <span class="lovers" style="    width: 54px;
                height: 30px;
                margin-top: 2px;
                display: flex;
                justify-content: center;
                align-items: center;
                color: red;
                display: block;
                margin: auto;">
                {{$item->loves}} loves
                </span>
            </div>
            @endforeach
        </div>
        <div class= "add-Button">
        </div>
    </div>
    <!-- Wemon section-->
    <div class= "man_container" id="man_div_container">
        <h1>Woman Fashion</h1>
        <div class ="man_product" id="woman_div">
            @foreach ($productDataWoman as $item)
            <div>
                <h2>{{$item->product_name}}</h2>
                <h3><span style="color: orange">price</span>  {{$item->product_price}}$</h3>
                <img src="{{'./../manimages/'.$item->product_picture}}" alt="">
                <div class ="deleteDiv">
                    <form action="{{route('deleteproduct.home',$item->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class ="delete">
                    </form>
                    <form action="{{route('geteditProduct.home',$item->id)}}">
                        <input type="submit" value="Edit" class ="edit">
                    </form>
                </div>
                <span class="lovers" style="    width: 54px;
                height: 30px;
                margin-top: 2px;
                display: flex;
                justify-content: center;
                align-items: center;
                color: red;
                display: block;
                margin: auto;">
                {{$item->loves}} loves
                </span>
            </div>
            @endforeach
        </div>
        <div class= "add-Button">
    </div>
    </div>

    <!-- kids section-->
    <div class= "man_container" id="man_div_container">
        <h1>Kids Fashion</h1>
        <div class ="man_product" id="kids_div">
            @foreach ($productDatakids as $item)
            <div>
                <h2>{{$item->product_name}}</h2>
                <h3><span style="color: orange">price</span>  {{$item->product_price}}$</h3>
                <img src="{{'./../manimages/'.$item->product_picture}}" alt="">
                <div class ="deleteDiv">
                    <form action="{{route('deleteproduct.home',$item->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class ="delete">
                    </form>
                    <form action="{{route('geteditProduct.home',$item->id)}}">
                        <input type="submit" value="Edit" class ="edit">
                    </form>
                </div>
                <span class="lovers" style="    width: 54px;
                height: 30px;
                margin-top: 2px;
                display: flex;
                justify-content: center;
                align-items: center;
                color: red;
                display: block;
                margin: auto;">
                {{$item->loves}} loves
                </span>
            </div>

            @endforeach
        </div>
        <div class= "add-Button">
    </div>
    </div>




    <a href="{{route('login.page')}}">logout</a>
    <footer>
        <h2><a href="{{route('returnhomeedit.back')}} "style="text-decoration:none;color:#FFF">Cofa.com</a></h2>
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
    <script src = "{{URL::asset('js/showmore.js')}}"></script>
</body>
</html>
