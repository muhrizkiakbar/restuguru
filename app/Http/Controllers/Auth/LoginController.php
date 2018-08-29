<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function index()
    {
        return view('login');
    }

    protected $redirectTo = '/home';

    public function  postLogin(Request $request){
        if (Auth::attempt([
            'username'=>$request->username,
            'password'=>$request->password
        ])){

            $isi=Auth::user()->username." telah login di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
            $save=$this->createlog($isi,"login");
            return redirect('/home');
          // dd(Auth::user()->role->namaRole="kadis");
        //   if (Auth::user()->role->namaRole=="kadis"){
        //     return redirect('/home/pegawai');
        //   }
        //   elseif (Auth::user()->role->namaRole=="sekda"){
        //     return redirect('/dashboard');
        //   }
        //   elseif (Auth::user()->role->namaRole=="pegawai"){
        //     return redirect('/user/pegawai');
        //   }
        //   elseif (Auth::user()->role->namaRole=="gubernur"){
        //     return redirect('/dashboard/gub');
        //   }
        //   elseif ((Auth::user()->role->namaRole=="karu")){
        //     return redirect('/home/ruangan');
        //   }
        //   else {
        //     // dd(Auth::user()->role->namaRole="pegawai");
        //     return redirect('/home');
        //   }
        }else{
            return redirect()->back()->with('error', 'Login gagal !!');
        }
    }

    public function logout()
    {
        Auth::logout();
        $isi=Auth::user()->username." telah logout di Cabang ".Auth::user()->cabangs->Nama_Cabang.".";
        $save=$this->createlog($isi,"logout");
        return redirect('/login')->with('error', 'Logout Berhasil');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
