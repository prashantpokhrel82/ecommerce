<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect(){
      $user_type = Auth::user()->user_type;
      if($user_type == 1){
        return view('admin.index');
      }else{
        return view('user.index');
      }


    }

    public function index(){

      if(Auth::id()){
          return redirect('redirect');
      }else{
          return view('user.index');
      }
    }
}
