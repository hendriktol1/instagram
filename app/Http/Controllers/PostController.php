<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instagram;

class PostController extends Controller
{
   public function index(){
      $instagram = new Instagram;
      $instagram->getLoginUrl();
      
   }



   // public function postinsta(){
   //    $code = $_POST['code'];
   //    $client_id = '55cc1ce217eb43f7a8328d3bee0f3fec';
   //    $redirect = "http://localhost:8089";
   //    $client_id_secret = "7689df8897b749bc845a3fa5716e5f09";
   // }
}
