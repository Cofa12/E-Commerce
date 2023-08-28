<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "icon" href ="../icon.png" type = "image/png">
    <link rel="stylesheet" href="{{URL::asset('css/cart.css')}}">
    <title>Your-Cart</title>
</head>
<body>
    <div class="all" id ="man_div_container">
        <div class ="products" id="man_div">
            <h2><span>•</span>Your Cart <form action="{{route('removeall.cart')}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit"><span class="remove_all_span"style="color: #ff5959;">Remove all</span></button>
                </form>
            </h2>
            <table>
                <tbody>
                @foreach($product as $item)
                <tr>
                    <td class="x"><form action="{{route('removeproduct.cart',$item->id)}}" style="margin-top: -34px;" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="cursor: pointer"><img src="../../x.png" alt=""></button>
                    </form>
                </td>
                    <td class ="img"><img src="{{'../../manimages/'.$item->product->product_picture}}" alt=""></th>
                    <td class ="name"><h2>{{$item->product->product_name}}</h2><span>{{$item->product->category->category_name}}</span></td>
                    <td class ="size">small</td>
                    <td class ="price"><h2>price</h2><span>{{$item->product->product_price}}</span>$</td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class= "add-Button">
            <h2 style="padding-left: 32px;
            width: 73px;
            float: left;">Total</h2>
            <h2 style="color:#32d5e0">{{$total}} $</h2>
            <span style="padding-left: 37px;
            font-size: 14px;
            color: #c4c1c1;">{{$countproduct}} items</span>
        </div>
        <div class ="user_info">
            <h3 style="margin-bottom:15px ">Info</h3>
            <form action="{{route('checkout.cart',$total)}}" method="post">
                @csrf
                @method('POST')
                <label for="phone">Your phone</label>
                <img src="../../phone.png" alt="">
                <input type="text" name="phone" id="address"placeholder ="Type Your Phone" class="need">
                <label for="address">Your Address</label>
                <textarea name="address" id="address" cols="30" rows="10" placeholder ="Type Your Address" ></textarea>

                <input type="submit" value="Check Out" class="check_out">
            </form>
        </div>
    </div>
<script src="{{URL::asset('js/showmorecart.js')}}"></script>
</body>
</html>
