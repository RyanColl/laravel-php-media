<?php

use App\Http\Controllers\FileUploadController;
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
    return view('welcome');
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
