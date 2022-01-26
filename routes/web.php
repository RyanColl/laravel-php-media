<?php

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\HttpController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(isset($_SESSION['username'])) {
        return view('welcome')
            ->with('session', 'empty');
    } else {
        return view('welcome')
            ->with('session', 'empty');
    }
    
});
if(isset($_GET['file'])) {
    $name = $_GET['file'];
    $ext = pathinfo($name)['extension'];
    $originalName = str_replace(".$ext", "", $name);
    $fileuploadRegex = "/^[a-z][^0-9]*$/i";
    // dd($name['extension']);
    if(preg_match($fileuploadRegex, $originalName)) {
        die('regex for file is incorrect. <a href="/">Return</a>');
    }
}
Route::get('upload', [FileUploadController::class, 'createForm']);

Route::post('upload', [FileUploadController::class, 'fileUploadPost'])->name('file.upload.post');

Route::get('/cookie/set', [CookieController::class, 'setCookie']);
Route::get('/cookie/get', [CookieController::class, 'getCookie']);

Route::get('/login', [HttpController::class, 'handleLogin']);