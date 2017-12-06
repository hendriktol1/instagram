<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class instagram extends Model
{
   private $apiSecret = '7689df8897b749bc845a3fa5716e5f09';
   private $apiCallback = 'http://localhost:8089/user';

   private $apioauthurl = 'https://api.instagram.com/oauth/authorize';
   private $apioauthtokenurl = 'https://api.instagram.com/oauth/access_token';

   public function new(){
      $this['apiKey'] = '55cc1ce217eb43f7a8328d3bee0f3fec';
      $this['apiSecret'] = '7689df8897b749bc845a3fa5716e5f09';
      $this['apiCallback'] = 'http://localhost:8089/user';
      $this['apioauthurl'] = 'https://api.instagram.com/oauth/authorize';
      $this['apioauthtokenurl'] = 'https://api.instagram.com/oauth/access_token';
   }


    public function getLoginUrl() {
      // dd($this);
      return $this->apioauthurl . '?client_id=' . $this['apiKey'] . '&redirect_uri=' . urlencode($this->apiCallback) . '&response_type=code';
   }
}
