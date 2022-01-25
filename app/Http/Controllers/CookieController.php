<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CookieController extends Controller {
   public function setCookie(Request $request) {
      $minutes = 100;
    //   $response = new Response('Hello World');
    //   $response->withCookie(cookie('name', 'virat', $minutes));
    //   $response->view('welcome');
      return back()->withCookie(cookie('name', 'virat', $minutes));
   }
   public function getCookie(Request $request) {
      $value = $request->cookie('name');
      return back()
        ->with('cookie', "$value");
    //   return view('welcome', ['cookie' => "$value"]);
   }
}