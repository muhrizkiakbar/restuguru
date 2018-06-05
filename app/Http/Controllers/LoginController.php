<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function  postLogin(Request $request){
        if (Auth::attempt([
            'username'=>$request->username,
            'password'=>$request->password
        ])){
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

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
