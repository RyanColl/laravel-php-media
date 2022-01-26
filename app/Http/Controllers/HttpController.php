<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HttpController extends Controller
{
    public function handleLogin(){
        return back()
            ->with('id', "session beginning....");
    }
}
