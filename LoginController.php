<?php

namespace App\Http\Controllers;
use App\Login;
use DB;
use Illuminate\Http\Request;
use Session;

use Redirect;

class LoginController extends Controller
{
    public function index()
    {
        //
    }
	public function login()
	{
		return view('Login.login');
	
	}
	public function create()
    {
        //
    }
	 public function logs(Request $req)
	 {
		 $username=$req->input('username');
         $password=$req->input('password');
		 $checkLogin=DB::table('logins')->where(['username'=>$username,'password'=>$password,'u_type'=>0])->get();
		$checkLogin1=DB::table('logins')->where(['username'=>$username,'password'=>$password,'u_type'=>1,'u_status'=>1])->get();
		$checkLogin2=DB::table('logins')->where(['username'=>$username,'password'=>$password,'u_type'=>2,'u_status'=>0])->get();
		if(count($checkLogin) >0)
		{
			
			 session_start();
            $req->session()->put('username', $username);
			
			return redirect('/adminindex');
				}
		
		elseif(count($checkLogin1) >0)
		{
			session_start();
			 $req->session()->put('username', $username);
			return view('teacher.teacherhome');
			
		}
		elseif(count($checkLogin2) >0)
		{
			session_start();
			 $req->session()->put('username', $username);
			return view('userhome');
		}
			else
		{
			
		return redirect('/index.php')->with('alert','Invalid User Login');
		
		
		}
	 }
}
