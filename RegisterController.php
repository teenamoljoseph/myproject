<?php

namespace App\Http\Controllers;
use App\Register;
use App\Login;

use Illuminate\Http\Request;
use DB;

class RegisterController extends Controller
{
    public function index()
    {
        //
    }
	public function store(Request $request)
    {
         $user_email=$request->input('user_email');
		//$msg="";
		 $check=DB::table('registers')->where(['user_email'=>$user_email])->get();
		 if(count($check)==0)
			 
		 {
			$users=new Register([
						 'user_name'=>$request->get('user_name'),
	                     'user_mobile'=>$request->get('user_mobile'),
						 'user_email'=>$request->get('user_email'),
						 'user_password'=>$request->get('user_password'),
						 'user_status'=>1
	                  ]); 
					  $users->save();
					  $user_email=$request->input('user_email');
					  $user_password=$request->input('user_password');
					  $result=DB::insert("insert into logs(username,password,u_status,u_type)values(?,?,?,?)",[$user_email,$user_password,1,1]);
					     $test = "1";
						 return redirect('/index.php')->with('alert1','Successfully Registered');
         }
		 else
		{
			         //    $msg= "User Already Registered";
						 
						//return redirect('/index');
						echo "haii";
		}	
	}
}