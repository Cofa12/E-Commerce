<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/pdf.css')}}">

    <title>Order pdf</title>
</head>
<body>
    <h1 style="width:100%;height:30px;text-align:center">{{$title}}</h1>
    <br>
    <div style="width: 100%;height:250px;border-top: solid #bdb9b9 1px;border-bottom: solid #bdb9b9 1px;">
        <div style="float:left;width:100px;height:100%">
            @foreach ($userData as $item)
                <span> Buyer Name: </span>{{$item->name}}
                <br>
                <span> Buyer Email: </span>{{$item->email}}
            @endforeach
        </div>
        <div style="float: left;width:100px;height:100%">
            @foreach ($order as $item)
                <span> Buyer phone: </span>{{$item->user_phone}}
                <br>
                <span> Buyer address: </span>{{$item->user_address}}
            @endforeach
        </div>
        <div>
            @foreach ($order as $item)
                <span> Order Id: </span>{{$item->id}}
                <br>
            @endforeach
        </div>
    </div>

    <div style="width:100%;height:250px">
        <table>
            <thead>
            <tr>
                <td style="border-bottom:solid 1px #bdb9b9;border-right:solid 1px #bdb9b9;border-left:solid 1px #bdb9b9; text-align:center">Item Id</td>
                <td style="border-bottom:solid 1px #bdb9b9;border-right:solid 1px #bdb9b9;text-align:center">Item Name</td>
                <td style="border-bottom:solid 1px #bdb9b9;border-right:solid 1px #bdb9b9;text-align:center">Unit price</td>
                <td style="border-bottom:solid 1px #bdb9b9;border-right:solid 1px #bdb9b9;text-align:center">Total price</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                <tr>
                    <td style="border-bottom:solid 1px #bdb9b9;border-right:solid 1px #bdb9b9;border-left:solid 1px #bdb9b9;text-align:center">{{$item->product->id}}</td>
                    <td style="border-bottom:solid 1px #bdb9b9;border-right:solid 1px #bdb9b9;text-align:center">{{$item->product->product_name}}</td>
                    <td style="border-bottom:solid 1px #bdb9b9;border-right:solid 1px #bdb9b9;text-align:center">{{$item->product->product_price}} $</td>
                    <td style="border-bottom:solid 1px #bdb9b9;border-right:solid 1px #bdb9b9;"></td>
                </tr>
            @endforeach
            <tr>
                <td style="border-bottom:solid 1px #bdb9b9;border-right:solid 1px #bdb9b9;border-left:solid 1px #bdb9b9"></td>
                <td style="border-bottom:solid 1px #bdb9b9;border-right:solid 1px #bdb9b9;"></td>
                <td style="border-bottom:solid 1px #bdb9b9;border-right:solid 1px #bdb9b9;"></td>
                <td style="border-bottom:solid 1px #bdb9b9;text-align:center;border-right:solid 1px #bdb9b9">{{$order[0]->order_price}} $</td>
            </tr>
        </tbody>
        </table>
    </div>
    <div style="text-align:center; margin-top:50px;width:100%">
        <span style="float: left">Recieving Signature <br>.................</span>
    </div>
    <p style="color: #32d5e0;font-size:90px;width:100%;text-align:center">Cofa.com</p>
</body>
</html>
