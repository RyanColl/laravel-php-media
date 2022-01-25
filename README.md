# PHP - Laravel

Today I am going to go over how this app works and what it is doing. 

#### Clone => 
1. Open a terminal and run the command ```git clone https://github.com/RyanColl/Laravel-React-Files-Regex.git```
#### Install => 
1. Open a terminal and execute the command ```npm i```
### Run => 
1. Open two terminals
2. In the first terminal, execute the command ```npm run watch```
3. In the second terminal, execute the command ```npm run serve```
4. Navigate to [localhost:8000](http://localhost:8000) to see results
## React Component

Our main page has a tiny React component implemented as an example of React in Laravel.

## File Upload In Laravel

Underneath that we have a file upload button that uses Laravel routing to capture the post data.
The original idea is to capture the event using just php files, but because of laravels MVC style architecture, we have to capture the event through the built in routing configuration in Laravel.
In routing, we create a new route that receives the post request from the form submit.
```php
Route::post('upload', [FileUploadController::class, 'fileUploadPost'])->name('file.upload.post');
```

Next we create a new controller to handle the file upload. We call it FileUploadController.php, and it is located at /app/Http/Controllers/FileUploadController.php
```php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fileUploadPost(Request $request)
    {
        $name = $request->file->getClientOriginalName();
        $ext = $request->file->extension();
        $originalName = str_replace(".$ext", "", $name);
        $fileuploadRegex = "/^[a-z][^0-9]*$/i";
        
        $fileNameMatch = preg_match($fileuploadRegex, $originalName);

        if($fileNameMatch) {
            return back()
            ->with('failure',"$name did not pass the regex. You Need to have a filename that matches the.")
            ->with('file',$name);
        }

        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv,png|max:4096',
        ]);

        $fileName = time().'.'.$request->file->extension();

        $request->file->move(public_path('uploads'), $fileName);

        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);
    }
}
```
When the file upload occurs, and the data is captured by laravel in the backend, the first step is to capture the filename, and run it through the regex:
```php
$name = $request->file->getClientOriginalName();
$ext = $request->file->extension();
$originalName = str_replace(".$ext", "", $name);
$fileuploadRegex = "/^[a-z][^0-9]*$/i";

$fileNameMatch = preg_match($fileuploadRegex, $name);

if($fileNameMatch) {
    return back()
    ->with('failure',"$name did not pass the regex. You Need to have a filename that matches the.")
    ->with('file',$name);
}
```
If the regex fails, then the response is returned and accepted on the front end using this code:
```php
@if ($message = Session::get('failure'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong value=>{{ Session::get('failure') }}</strong>
        <strong><a href="#file_constraints">constraints below</a></strong>
        <!-- <strong>{{ Session::get('file') }}</strong> -->
    </div>
@endif
```
If the regex were to pass, we could then add the file contents into a new file with a custom name based on the time, and add it to the uploads folder:
```php
$fileName = time().'.'.$request->file->extension();
$request->file->move(public_path('uploads'), $fileName);
```
We then return to the client a success message:
```php
return back()
    ->with('success','You have successfully upload file.')
    ->with('file',$fileName);
```
And it is received on the client with this code:
```php
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
        <?php
            require_once(app_path().'/includes/upload.php')
        ?>
    </div>
@endif
```
Inside of this code we requre upload.php, which uses file system to read through the list of files currently in the upload directory, and displays them on the screen. This is upload.php:
```php
<?php
$path = base_path();
$dir_handle = opendir("$path/public/uploads/");
if(is_resource($dir_handle))
{
    echo isset($_POST['file']);
    while(($file_name = readdir($dir_handle)) == true)
    {
        if(strlen($file_name)>2) {
            echo "<br>";
            echo("File Name: " . $file_name);
        }
    }
    // closing the directory
    closedir($dir_handle);
}
else
{
    echo("Directory Cannot Be Opened.");
}
```

We can also capture just the GET request from the file: 
```php
<form action="/upload" method="GET" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <input type="file" name="file" class="form-control">
        </div>
        <div class="col-md-6">
            <button type="submit" name="file_submit" class="btn btn-success">Upload</button>
        </div>
    </div>
</form>
```
I'm not sure why we would do that, but we could use an input tag type file inside of a form that has an action of ```'/upload'``` and a method of GET. Inside of web.php, we would capture the event in front of the routes, so that if our file name does not match the regex, we can run die on the program. Inside of web.php we write:
```php
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
```
The isset waits for the GET request, and before it can be given to a route, we verify if the regex has passed. We do this to avoid the file being uploaded if the regex doesn't pass. I did not look into how to get a file to upload with a GET request, and I am unsure if it is possible, so for this project, I will leave the form on POST.

That leads us to the forms!
## Other Regex Form Inputs

All logic for this app has been though out carfeully and seperated into pieces to allow for an easier read/follow along. In ```welcome.blade.php``` there is a section of code on line 106 that hosts all of our php work for regex forms: 
```php
    <?php include(app_path().'/includes/regex.php'); ?>
```

Inside of regex.php, we start off by defining all of the regexes we will be using (except for fileregex, it sits in the controller for the backend architecture):
```php
$sevenNumRegex = "/^\d{3}([-]?|[\s]*)\d{4}$/";
$tenNumRegex = '/(^\d{3}|^\(\d{3}\))([-]?|[\s]*)\d{3}([-]?|[\s]*)\d{4}$/';
$licenseRegex = "/(^[A-Z]{3}[\s]?[0-9]{3}$|^[0-9]{3}[\s]?[A-Z]{3}$)/";
$streetRegex = "/^[0-9]{3,5}[\s]{1}[A-Z]{1}[a-z]{0,14}[\s]{1}Street$/";
$birthdayRegex = "/(^([JAN]|[FEB]|[MAR]|[APR]|[MAY]|[JUN]|[JUL]|[AUG]|[SEP]|[OCT]|[NOV]|[DEC]){3}-([0-2]{1}[0-9]{1}|[3]{1}[0-1]{1})-([0-1]{1}[0-9]{3}|20[0-2]{1}[0-1]{1})$|^JAN-([0-1]{1}[0-9]{1}|2[0-5]{1})-2022)$/";
$socialRegex = "/^[1-9]{3}[\s]*[1-9]{3}[\s]*[1-9]{3}/";
```

Next we use isset and the GET request object to capture the form submitting for all forms. Here is an example of one of the issets. We have six in total, one for each regex:
```php
if(isset($_GET['license_plate_submit']))
{
    $license = $_GET['license_plate'];
    $matchlicense = preg_match($licenseRegex, $license);
    if($matchlicense) {
        echo "Submitted license: <h3><b>$license</b></h3> <h5><b>is</b></h5> a valid license plate number";
    } else {
        echo "Submitted license: <h3><b>$license</b></h3> <h5><b>is not</b></h5> a valid license plate number";
    }
    echo "<a href='/'>Clear</a>";
}
```
In this isset we are waiting for a submit button with a name of "license_plate_submit". When pressed, the license plate value that the user inputs is read from ```$license = $_GET['license_plate'];```. We then apply the input and the regex together in the preg match, and return the appropriate repsonse. We also indicate a "clear" option for simplicity.

We require all of the other forms from their individual files on lines 77-84:
```php
require_once(app_path().'/includes/regexes/userForm.php');
require_once(app_path().'/includes/regexes/sevenDigitRegex.php');
require_once(app_path().'/includes/regexes/tenDigitRegex.php');
require_once(app_path().'/includes/regexes/licenseRegex.php');
require_once(app_path().'/includes/regexes/streetRegex.php');
require_once(app_path().'/includes/regexes/birthdayRegex.php');
require_once(app_path().'/includes/regexes/socialRegex.php');
require_once(app_path().'/includes/regexes/fileRegex.php');
```
The first require, the user form, is the top form you see on the page. The other requires are the individual forms you see as you scroll down the page. The individual forms contain the rules for each specific form input, and the form at the top is linked to each one individually as an example of the correct input. 

If you enter into the form at the top all of the values and press submit, the form will tell you if all of the values pass their individual regexes, and if they do, say thank you and display the info. If any of the regexes fail, it will display failure and the reason for it. This time, we are importing the file conditionally, only after the userform has been submitted:
```php
if(isset($_GET["userform_submit"])) {
    require_once(app_path().'/includes/regexes/userFormRegex.php');
}
```

```userFormRegex.php``` gives us the logic we need to capture the individual inputs from the user form and run them against the regex. If there are errors at any step, then the user is made aware that specific step has failed.


That is the basis of my Laravel App! 

Thanks for reading!

Check out My Portfolio ==> [💻💻💻💻](www.rcoll-dev.com)

## Orignal Laravel README
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**
- **[Romega Software](https://romegasoftware.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
