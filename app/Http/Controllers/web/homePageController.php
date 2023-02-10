<?php

namespace App\Http\Controllers\web;
use Stevebauman\Location\Facades\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homePageController extends Controller
{
    public function index(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
        
        $json     = file_get_contents("http://www.geoplugin.net/json.gp?ip=112.134.195.215");
        $json     = json_decode($json, true);
        $country=$json['geoplugin_countryCode'];
        
        if($country == 'AE')
        {
            return view('web.UAE.index');
        }
        else if($country == 'LK'){
            return view ('web.SL.index');
        }
       
        else{
            return view('web.GL.index');
        }
      
        
    }

    
}
