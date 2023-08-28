<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\Admin;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use App\Models\Temp;
use App\Models\Category;
use App\Models\Userlover;
use App\Models\Order;
use App\Models\Userproduct;
use Hash;
use Session;



class UserController extends Controller
{
    //
    function gobacktohome(){
        $backgroundimage =Image::where('image_name','=','background');
        $imagesData = Image::get();
        $productDataMan = Product::where('category_id','=',1)->get();
        $productDataWoman = Product::where('category_id','=',2)->get();
        $productDatakids = Product::where('category_id','=',3)->get();
        $userId = User::where('email','=',Session::get('loginemail'))->first()->id;
        $countproduct = Temp::where('user_id','=',$userId)->get()->count();
        $user_picture= User::where('email','=',Session::get('loginemail'))->first()->picture;
        $userId = User::where('email','=',Session::get('loginemail'))->first()->id;
        return view('home')->with([
        'backgroundimage'=>$backgroundimage,
        'imagesData'=>$imagesData,
        'productDataMan'=>$productDataMan,
        'productDataWoman'=>$productDataWoman,
        'productDatakids'=>$productDatakids,
        'countproduct'=>$countproduct,
        'user_picture' =>$user_picture,
        'userid'=>$userId,
    ]);
    }

    function searchto(Request $request){
        $keyword = $request->search;

        $products = Product::where('product_name','like','%'.$request->search.'%')->get();
        $userId = User::where('email','=',Session::get('loginemail'))->first()->id;

        return view('searchedproduct',['products'=>$products,'keyword'=>$keyword,'userId'=>$userId]);

    }

    function addlovefun($id){
        $userId = User::where('email','=',Session::get('loginemail'))->first()->id;
        $product = Userlover::where('product_id','=',$id)->where('user_id','=',$userId)->get();
        if (Session::get('id'.$id."".$userId)){
            Session::pull('id'.$id."".$userId);
            $productlove = Product::where('id','=',$id)->first();
            $love = $productlove->loves;
            $love -=1;
            $array = ['loves'=>$love];
            $productlove->update($array);
            $product->each->delete();
         }else
         {
            $userID = User::where('email','=',Session::get('loginemail'))->first()->id;
            $array = ['user_id'=>$userID,'product_id'=>$id];
            $productlove = Product::where('id','=',$id)->first();
            $love = $productlove->loves;
            $love +=1;
            $array2 = ['loves'=>$love];
            $productlove->update($array2);
            Userlover::create($array);
            session(['id'.$id."".$userId=>$id]);
         }

        return redirect()->route('returnhomeuser.back');
    }

    function addtocart($id){
        $userId = User::where('email','=',Session::get('loginemail'))->get();
        $array=[
            'user_id'=>$userId[0]->id,
            'product_id'=>$id,
        ];
        Temp::create($array);

        // $backgroundimage =Image::where('image_name','=','background');
        // $imagesData = Image::get();
        // $productDataMan = Product::where('category_id','=',1)->get();
        // $productDataWoman = Product::where('category_id','=',2)->get();
        // $productDatakids = Product::where('category_id','=',3)->get();

        // $countproduct = Temp::get()->count();
        return redirect()->route('returnhomeuser.back');
    }

    function gotocart(){
        $userId = User::where('email','=',Session::get('loginemail'))->first()->id;
        $product = Temp::where('user_id','=',$userId)->get();        // to do
        $countproduct =Temp::where('user_id','=',$userId)->count();
        $total =0;
        foreach($product as $item){
            $total += $item->product->product_price;
        }
        return view('cart',['product'=>$product,'countproduct'=>$countproduct,'total'=>$total]);
    }

    function deleteproductcart($id){
        Temp::where('id','=',$id)->delete();
        return redirect()->route('gotocart.user');

    }

    function removeallcart(){
        $userid= User::where('email','=',Session::get('loginemail'))->first()->id;
        Temp::where('user_id','=',$userid)->delete();
        return redirect()->route('gotocart.user');
    }

    function delivery(){
        return view('delivey');
    }

    function checkoutfun(Request $request, $total){

        // create order first
        $userId = User::where('email','=',Session::get('loginemail'))->first()->id;
        $array = [
            'user_id'=> $userId,
            'user_address' =>$request->address,
            'order_price' =>$total,
            'user_phone' =>$request->phone,
        ];

        $userid= User::where('email','=',Session::get('loginemail'))->first()->id;
        $tempproducts = Temp::where('user_id','=',$userid)->get();
        $tempproducts = $tempproducts->toArray();

        if (!$tempproducts){
            return redirect()->route('returnhomeuser.back');
        }



        // link the order to the products
        $order = Order::create($array);
        $order_id = $order->id;


        for($i = 0; $i<count($tempproducts); $i++){
            $tempproducts[$i] =array_merge($tempproducts[$i],  ['order_id'=>$order_id]);
            unset($tempproducts[$i]['id']);
            $Userproduct = Userproduct::create($tempproducts[$i]);
            // print_r($tempproducts);
        }
        $userid= User::where('email','=',Session::get('loginemail'))->first()->id;
        Temp::where('user_id','=',$userid)->delete();           // to do
        return redirect()->route('delivery.cart');

    }

    function userprofile(){
        $user_picture= User::where('email','=',Session::get('loginemail'))->first()->picture;
        $user_name= User::where('email','=',Session::get('loginemail'))->first()->name;
        $user_email= User::where('email','=',Session::get('loginemail'))->first()->email;

        $userID = User::where('email','=',Session::get('loginemail'))->first()->id;
        $orders = Order::where('user_id','=',$userID)->get();
        $userproduct = Userproduct::where('user_id','=',$userID)->get();


        // foreach($orders as $order){
        //     $conditoin =$userproduct->where('order_id','=',$order->id);
        //     foreach($conditoin as $item){
        //         echo $item->product->product_name;
        //     }
        // }
        // $orders =$orders->toArray();
        // print_r($orders);
        $numberOrder = $orders->count();

        return view('prfile-user',['user_name'=>$user_name,'user_picture'=>$user_picture,'user_email'=>$user_email,'numberOrder'=>$numberOrder,'orders'=>$orders,'userproduct'=>$userproduct]);
    }

    function updateuserinfo(Request $request){
        $array =['name'=>$request->name,'email'=>$request->email];
        $user= User::where('email','=',Session::get('loginemail'))->update($array);
        session(['loginemail'=>$request->email]);
        return redirect()->route('userprofile');
    }

    function resetpassword(Request $request){
        $userpass = User::where('email','=',Session::get('loginemail'))->first()->password;
        $user = User::where('email','=',Session::get('loginemail'))->first();
        if (Hash::check($request->old, $userpass)){
            $array = ['password'=>Hash::make($request->new)];
            $user->update($array);
            session(['fail'=>'']);
            return redirect()->route('userprofile');
        } else {
            session(['fail'=>"the old password doesn't match"]);

            return redirect()->route('userprofile');
        }
     }
}
