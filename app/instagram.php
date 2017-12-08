<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;


class instagram extends Model
{
   private $apiCallback = 'http://localhost:8089/user';

   private $apioauthurl = 'https://api.instagram.com/oauth/authorize';
   private $apioauthtokenurl = 'https://api.instagram.com/oauth/access_token';

   public function new(){
      $this['apiCallback'] = 'http://localhost:8089/user';
      $this['apioauthurl'] = 'https://api.instagram.com/oauth/authorize';
      $this['apioauthtokenurl'] = 'https://api.instagram.com/oauth/access_token';
   }

   public function getApiKey() {
      return $this['apiKey'];
   }

   public function getApiSecret() {
      return $this['apiSecret'];
   }

   public function getApiCallback() {
      return $this['apiCallback'];
   }

   public function getLoginUrl() {
      // dd($this);
      return $this->apioauthurl . '?client_id=' . env('INSTA_CLIENT_ID') . '&redirect_uri=' . urlencode($this->apiCallback) . '&response_type=code';
   }

   public function getOAuthToken($code, $token = false)
    {
        $apiData = array(
            'code' => $code
        );
        $result = $this->_makeOAuthCall($apiData);
        return !$token ? $result : $result->access_token;
    }

    private function _makeOAuthCall($apiData)
    {
      // $apiHost = $this['apioauthtokenurl'];
        $apiHost = $this['apioauthtokenurl'];
        $response = Curl::to($apiHost)
          ->withData( array( 'client_id' => env('INSTA_CLIENT_ID'),
                             'client_secret' => env('INSTA_CLIENT_SECRET'),
                             'grant_type' => 'authorization_code',
                             'redirect_uri' => $this->getApiCallback(),
                             'code' => $apiData['code']) )
          ->returnResponseObject()
          ->post();

          return view('welcome')->with('data', $response->content);

        // $apiHost = 'http://youtube.com';
        // $response = Curl::to($apiHost)
        //  ->returnResponseObject()
        //   ->get();
        //
        //   return dd($response->content);
        //
        //
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $apiHost);
        // curl_setopt($ch, CURLOPT_POST, count($apiData));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($apiData));
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        // $jsonData = curl_exec($ch);
        // if (!$jsonData) {
        //     return 'Error: _makeOAuthCall() - cURL error: ' . curl_error($ch);
        // }
        // curl_close($ch);
        // return json_decode($jsonData);
    }
}
