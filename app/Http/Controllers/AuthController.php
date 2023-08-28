<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Temp;
use App\Models\Userproduct;
use App\Models\User;
use App\Models\Admin;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Hash;
use Session;

class AuthController extends Controller
{
    //
    function getThePage(){  // get the sign in page
        return view('login');
    }

    function getTheSignUp (){
        return view('signup');
    }
    function signingup(Request $request){
        $request->validate([
            'email' => 'required|email|unique:admins',
            'name'  => 'required',
            'pass'  => 'required|min:7|max:22',
            'check'  => 'required',
            'picture' =>  'required',

        ]);

        if ($request->check=="admin"){
            $image=$request->file('picture');
            $imageExtension = $image->getClientOriginalExtension();
            $extensions = ['jpg','png','jpeg'];
            if (!in_array($imageExtension,$extensions)){
                return  redirect()->route('registser', ['error' => 'is not a photo']);
            }
            $imageName = time().".".$imageExtension;
            $request->picture->move(public_path('images'),$imageName);
            $request->picture = $imageName;
            $dataArray = [
                'name'=>$request->name,
                'password'=>Hash::make($request->pass),
                'email'=>$request->email,
                'picture' =>$request->picture,
            ];

            $result=Admin::create($dataArray);
            if ($result){
                return back()->with('success','Registerd Successfully');
            } else {
                return back()->with('fail','Registerd wrongly');
            }


         } else {
            $image=$request->file('picture');
            $imageExtension = $image->getClientOriginalExtension();
            $extensions = ['jpg','png','jpeg'];
            if (!in_array($imageExtension,$extensions)){
                return  redirect()->route('registser', ['error' => 'is not a photo']);
            }
            $imageName = time().".".$imageExtension;
            $request->picture->move(public_path('images'), $imageName);
            $request->picture = $imageName;
            $dataArray = [
                'name'=>$request->name,
                'password'=>Hash::make($request->pass),
                'email'=>$request->email,
                'picture' =>$imageName,
            ];

            $result=User::create($dataArray);
            if ($result){
                return back()->with('success','Registerd Successfully');
            } else {
                return back()->with('fail','Registerd wrongly');
            }
        }
    }

    function loginprocess(Request $request){
        $request->validate([
            'email' => 'required|email',
            'pass' => 'required',
            'check' => 'required',
        ]);

        if ($request->check=='admin'){
            $data = Admin::where('email','=',$request->email)->first();
            if ($data){
                if (Hash::check($request->pass, $data->password)){
                        session(['loginemail' =>$data->email,'isadmin'=>'1']);
                        return redirect()->route('returnhomeedit.back');
                }else {
                    return back()->with('pass','The Password is Wrong');
                }
            }else {
                return back()->with('nodata','Eamil and password are wrong');
            }

        }else {
            $data = User::where('email','=',$request->email)->first();
            if ($data){
                if (Hash::check($request->pass, $data->password)){
                    session(['loginemail' =>$data->email,'isadmin'=>'0']);
                    return redirect()->route('returnhomeuser.back');
                }else {
                    return back()->with('pass','The Password is Wrong');
                }
            }else {
                return back()->with('nodata','Eamil and password are wrong');
            }
        }
    }
    function homepage(){
        $data=null;
        if (Session::has('loginemail')){

            if (Session::get('isadmin')=='0')
                $data = User::where('email','=',Session::get('loginemail'))->first();
            else
                $data = Admin::where('email','=',Session::get('loginemail'))->first();
        }

        $backgroundimage =Image::where('image_name','=','background');
        $imagesData = Image::get();
        $productDataMan = Product::where('category_id','=',3)->get();
        $productDataWoman = Product::where('category_id','=',4)->get();
        $productDatakids = Product::where('category_id','=',6)->get();
        $admin = Admin::where('email','=',Session::get('loginemail'))->get();
        // print_r($admin);
        return view('home-admin')->with(['backgroundimage'=>$backgroundimage,'imagesData'=>$imagesData,'productDataMan'=>$productDataMan,'productDataWoman'=>$productDataWoman,'productDatakids'=>$productDatakids,'admin'=>$admin]);
    }
    function gobacktohome (){
        $backgroundimage =Image::where('image_name','=','background');
        $imagesData = Image::get();
        $productDataMan = Product::where('category_id','=',3)->get();
        $productDataWoman = Product::where('category_id','=',4)->get();
        $productDatakids = Product::where('category_id','=',6)->get();
        $admin = Admin::where('email','=',Session::get('loginemail'))->get();
        // print_r($admin);

        return view('home-admin')->with(['backgroundimage'=>$backgroundimage,'imagesData'=>$imagesData,'productDataMan'=>$productDataMan,'productDataWoman'=>$productDataWoman,'productDatakids'=>$productDatakids,'admin'=>$admin]);
    }


    function logout(){
        Session::pull('loginemail','isadmin','fail');
        return view('login');
    }

}
