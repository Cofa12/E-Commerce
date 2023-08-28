<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Temp;
use App\Models\Admin;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Userproduct;
use App\Models\Order;
use App\Models\Userlover;
use Elibyy\TCPDF\Facades\TCPDF;
use Session;
use Hash;

class AdminPageController extends Controller
{
    //
    function forward_to(){

            $data = Admin::where('email','=',Session::get('loginemail'))->first();
            $imagesData = Image::get();
            $backgroundimage =Image::where('image_name','=','background');
            return view('edit_photo',['adminData'=>$data,'imagesData'=>$imagesData,'backgroundimage'=>$backgroundimage]);
    }

    function applyimageedit(Request $request){
        $request->validate([
            'background'=>'required',
        ]);
            $record =Image::where('image_name','=','background');
            if (!$record){
                $image=$request->file('background');
                $imageExtension = $image->getClientOriginalExtension();
                $extensions = ['jpg','png','jpeg'];
                if (!in_array($imageExtension,$extensions)){
                    return  redirect()->route('registser', ['error' => 'is not a photo']);
                }
                $imageName = time().".".$imageExtension;
                $request->background->move(public_path('webimages'),$imageName);
                $request->background = $imageName;
                $adminId = Admin::where('email','=', Session::get('loginemail'))->firstOrFail()->id;



                $dataArray = [
                    'image_name'=>'background',
                    'image_path'=>$request->background,
                    'admin_id'=>$adminId,
                ];

                $record->create($dataArray);
            }else{
                $image=$request->file('background');
                $imageExtension = $image->getClientOriginalExtension();
                $extensions = ['jpg','png','jpeg'];
                if (!in_array($imageExtension,$extensions)){
                    return  redirect()->route('registser', ['error' => 'is not a photo']);
                }
                $imageName = time().".".$imageExtension;
                $request->background->move(public_path('webimages'),$imageName);
                $request->background = $imageName;
                $adminId = Admin::where('email','=', Session::get('loginemail'))->firstOrFail()->id;



                $dataArray = [
                    'image_name'=>'background',
                    'image_path'=>$request->background,
                    'admin_id'=>$adminId,
                ];
                $record->update($dataArray);

            }


            $backgroundimage =Image::where('image_name','=','background');
            $imagesData = Image::get();
            $productDataMan = Product::where('category_id','=',1)->get();
            $productDataWoman = Product::where('category_id','=',2)->get();
            $productDatakids = Product::where('category_id','=',3)->get();
            $admin = Admin::where('email','=',Session::get('loginemail'))->get();
            return view('home-admin')->with(['backgroundimage'=>$backgroundimage,'imagesData'=>$imagesData,'productDataMan'=>$productDataMan,'productDataWoman'=>$productDataWoman,'productDatakids'=>$productDatakids,'admin'=>$admin]);
        }

    function gobackfromedit(){
            $backgroundimage =Image::where('image_name','=','background');
            $imagesData = Image::get();
            $productDataMan = Product::where('category_id','=',1)->get();
            $productDataWoman = Product::where('category_id','=',2)->get();
            $productDatakids = Product::where('category_id','=',3)->get();
            $admin = Admin::where('email','=',Session::get('loginemail'))->get();
            // print_r($admin);
            return view('home-admin')->with([
            'backgroundimage'=>$backgroundimage,
            'imagesData'=>$imagesData,
            'productDataMan'=>$productDataMan,
            'productDataWoman'=>$productDataWoman,
            'productDatakids'=>$productDatakids,'admin'=>$admin]);
        }
    function addproduct(){
            return view ('add_product');
    }


    function saveproductValidate(Request $request){
        // $request->validate([
        //     'product_name' =>'required',
        //     'product_price' =>'required',
        //     'product_picture' =>'required',
        //     'type'=>'required',
        // ]);

            $image=$request->file('image');
            $imageExtension = $image->getClientOriginalExtension();
            $extensions = ['jpg','png','jpeg'];
            if (!in_array($imageExtension,$extensions)){
                return  redirect()->route('registser', ['error' => 'is not a photo']);
            }
            $imageName = time().".".$imageExtension;
            $request->image->move(public_path('manimages'),$imageName);
            $request->image = $imageName;
            $adminId = Admin::where('email','=', Session::get('loginemail'))->firstOrFail()->id;
            $categId = Category::where('category_name','=', $request->type)->firstOrFail()->id;

            $dataArray = [
                'product_name'=>$request->product_name,
                'product_price'=>$request->product_price,
                'product_picture'=> $imageName,
                'admin_id'=>$adminId,
                'category_id' =>$categId,
            ];


            Product::create($dataArray);
            return redirect()->route('returnhomeedit.back');

    }

    function deleteproduct($id){
        $userlover = Userlover::where('product_id','=',$id)->delete();
        $product =Userproduct::where('product_id','=',$id)->delete();
        $product =Product::where('id','=',$id)->delete();
        return redirect()->route('returnhomeedit.back');
    }

    function geteditproduct($id){
        $product = Product::where('id','=',$id)->get();
        return view('edit_product',['product'=>$product,'id'=>$id]);
    }

    function applyedit($id, Request $request){
        $product =Product::find($id);
        $image=$request->file('image');
        $imageExtension = $image->getClientOriginalExtension();
        $extensions = ['jpg','png','jpeg'];
        if (!in_array($imageExtension,$extensions)){
            return  redirect()->route('registser', ['error' => 'is not a photo']);
        }
        $imageName = time().".".$imageExtension;
        $request->image->move(public_path('manimages'),$imageName);
        $request->image = $imageName;

        $array = [
            'product_name' =>$request->product_name,
            'product_price' =>$request->product_price,
            'product_picture' =>$request->image,
        ];
        $product->update($array);
        return redirect()->route('returnhomeedit.back');

    }


    function adminprofile(){
        $admin_picture= Admin::where('email','=',Session::get('loginemail'))->first()->picture;
        $admin_name= Admin::where('email','=',Session::get('loginemail'))->first()->name;
        $admin_email= Admin::where('email','=',Session::get('loginemail'))->first()->email;



        $orders = Order::get();
        $userproduct = Userproduct::get();


        // foreach($orders as $order){
        //     $conditoin =$userproduct->where('order_id','=',$order->id);
        //     foreach($conditoin as $item){
        //         echo $item->product->product_name;
        //     }
        // }
        // $orders =$orders->toArray();
        // print_r($orders);
        $numberOrder = $orders->count();

        return view('profile-admin',['admin_name'=>$admin_name,'admin_picture'=>$admin_picture,'admin_email'=>$admin_email,'orders'=>$orders,'userproduct'=>$userproduct]);
    }

    function addreceipt($id){
        $products = Userproduct::where('order_id','=',$id)->get();
        $userId = Userproduct::where('order_id','=',$id)->first()->user_id;
        $userData = User::where('id','=',$userId)->get();
        $order = Order::where('id','=',$id)->get();
        $filename =$id.".pdf";
        $data = [
            'title' => 'Reciept of the order '.$id,
            'products' =>$products,
            'userData' =>$userData,
            'order'=>$order,
        ];

        $html = view()->make('pdfSample',$data)->render();
        $pdf  = new TCPDF;
        $pdf::SetTitle('hello world');
        $pdf::AddPage();
        $pdf::writeHTML($html,true,false,true,false,"");
        $pdf::Output(public_path($filename),"F");

        return response()->download(public_path($filename));
    }

}
