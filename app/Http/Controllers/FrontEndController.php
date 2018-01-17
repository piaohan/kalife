<?php

namespace App\Http\Controllers;

use App\Email;
//use App\Message;
use App\OnlinePayment;
use App\Package;
use App\PackageAttraction;
use App\Services\InterswitchConfig;
use App\Services\PaystackConfig;
use App\Services\SabreFlight;
use App\Services\SabreSessionManager;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class FrontEndController extends Controller
{
    public function __construct(){
        $this->SabreFlight = new SabreFlight();
        $this->SessionManager = new SabreSessionManager();
        $this->InterswitchConfig = new InterswitchConfig();
        $this->PaystackConfig = new PaystackConfig();
    }

    public function subscribe(Request $r){
        $this->validate($r, [
            'email' => 'required|string'
        ]);
        $email = $r->email;
       if(Email::getEmail($email)){
           return 2;
       }else{
           $store = Email::store($email);
               return 1;
       }
    }

    public function message(Request $r){
        $this->validate($r, [
            'email' => 'required|string',
            'name'  =>  'required|string',
            'message' => 'required|string'
        ]);
        if(\App\Message::getMessage($r)){
           return 2;
        }else{
            \App\Message::store($r);
            return 1;
        }

    }

    public function tokenRefresh(Request $r){
        $this->validate($r, [
            'refresh' => 'required|string'
            ]);

        return $this->SessionManager->refreshSessionToken();
    }

    public function pageTimeOut(Request $r){
        $this->validate($r, [
            'timeout' => 'required|string'
        ]);
        return 1;
    }

    public function activities(){

          $activities = Package::where('attraction',1)
              ->where('hotel', 0)
              ->where('flight', 0)
              ->simplePaginate(1);
          return view('frontend.activities',compact('activities'));
    }

}
