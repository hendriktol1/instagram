<?php

namespace App\Http\Controllers;

use App\instagram;
use Illuminate\Http\Request;

class InstagramController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function home(){
        $code = $_SERVER['REQUEST_URI'] . '&';
        $array = explode('&', $code);
        // dd($array);
        $i = 0;
        foreach($array as $string) {
           $string = explode('=', $string);
           $array[$i] = $string;
           $i++;
        }

        // dd($array);
        // $string = explode('=', $code);
        return view('welcome')->with('string', $array[0][1]);
     }

    public function index()
    {
        //
        $instagram = new Instagram;
        $instagram->new();
        $login = $instagram->getLoginUrl();
        if(!isset($userdata) || $isset($_GET['code'])){
           return redirect($login);
        } else {
           dd($_GET['code']);
           return view('welcome');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * @param  \App\instagram  $instagram
     * @return \Illuminate\Http\Response
     */
    public function show(instagram $instagram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\instagram  $instagram
     * @return \Illuminate\Http\Response
     */
    public function edit(instagram $instagram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\instagram  $instagram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, instagram $instagram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\instagram  $instagram
     * @return \Illuminate\Http\Response
     */
    public function destroy(instagram $instagram)
    {
        //
    }
}
