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


## Cookies and Sessions In Laravel

This week, we have been asked to cover cookies and sessions in PHP. As usual, I will be using Laravel, so some of my routing may be different, but it should work the same on any system.

Here is a list of things that the app is required to do, and how I solved them.

1. login.php must dynamically figure out its own name for the action setting for the form

My interpretation of this is to create a dynamic action for the form. In this case, I have chosen to leave my form action blank, meaning whatever file the form is in, the action will return. In this case, because the form is in login.php, then the action will become login.php.
```html
<form action="" method="get">
username:<input type="text" name="username"><br>
password:<input type="password" name="password"><br>
<input type="submit">
</form>
```

2. each page should have at the top: logged in for 1h 13m 15s since 4:08pm Jan. 25

This was fun to implement. I utilized the login time of the user and hints of JQuery to create a frontend to backend api. I have a php file, updateTime.php, that when called using JQuery like an api, echoes out the time since logged in for the user, on every page where the session exists!

I will break down the following code in login.php:

This is the request to bring JQuery libraries into the document.
```php
echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>";
```

This code injects a script tag into the DOM that utilizes JQuery. Here, we run some javascript that awaits for the loading of the DOM, and then runs our timestamp function. It then sets an interval for every second to run the funtion again. The function timestamp makes an ajax request to updateTime.php. updateTime.php's echo is interpreted by the JQuery as a response, and the repsonse is injected into the inner html of a div with the id of 'timestamp'. 
 ____
```php
echo "
    <script>
        $(document).ready(function() {
            timestamp();
            setInterval(timestamp, 1000);
        });

        function timestamp() {
            $.ajax({
                url: '/updateTime.php',
                success: function(data) {
                    $('#timestamp').html(data);
                },
            });
        }
    </script>
";
```

Inside of updateTime.php, we gather the time of the login for the user, and echo a string. As said before, this echo is interpreted by the JQuery as a response, and injected directly into the inner html of a div with the id of 'timestamp'. In updateTime.php, 3 functions are created to handle the time. If the user is not in a session, the response 'User is not logged in!' is sent back. If the user is logged in, the session login time is compared with the current time and placed nicely into a string for the user to see on the client.
```php
<?php
session_start();
function getHour($secs){ return floor($secs/(60*60)); }
function getMinute($secs) { return floor($secs/(60)); }
function getSecond($secs) { return $secs-(floor($secs/(60))*60); }

if(isset($_SESSION['logintime'])) {
    $h = getHour(time() - $_SESSION['logintime']);
    $m = getMinute(time() - $_SESSION['logintime']);
    $s = getSecond(time() - $_SESSION['logintime']);
    $date = date('h:ia, M. d', $_SESSION['logintime']);
    echo "User ".$_SESSION['username']." has been logged in for ".$h."h, ".$m."m, and ".$s."s, since $date"; 
} else {
    echo "User is not logged in!";
}
```

3. If the user delays more than 8 seconds, kill the session, tell the user you logged them out for security reasons, and offer a link to login.php

I tackled this issue again by using JQuery. JQuery allows us to use ajax to make api calls to our php files. Whatever the PHP file echoes out, is returned to ajax as a response. This response can be inserted into the inner html of a div. 

The following script is rather large, so I will break it down piece by piece. 

1. First, we have our timestamp logic that was implemented above. 
2. Then we have a new function called killSessionTimeStamp. 
3. I created another setinterval with this function, as it serves as an 8 second count down for our user
4. We also have another function called killSession. This creates an ajax call to another php file called killSession.php. 

The result of the following code displays an h1 tag to the screen when a user logs in that explains to the user they have 8 seconds until they are logged out due to inactivity. The countdown is live, and when the countdown is complete, another function is called that clears the interval and calls killSession.php.
```php
echo "
<script>
    $(document).ready(function() {
        timestamp();
        killSessionTimeStamp();
        setInterval(timestamp, 1000);
        let interval = setInterval(killSessionTimeStamp, 1000);
        setTimeout(() => {
            clearInterval(interval);
            killSession();
        }, 8000)
    });

    function timestamp() {
        $.ajax({
            url: '/updateTime.php',
            success: function(data) {
                $('#timestamp').html(data);
            },
        });
    }
    let i = 8;
    function killSessionTimeStamp(){
            let htmlString = ('You will be logged off after' + ' ' + i + ' ' + 'seconds of inactivity') 
            $('#kstimestamp').html(htmlString);
            i--;
    }
    function killSession(){
        $.ajax({
            url: '/killSession.php'
        });
        $('#kstimestamp').html(\"The Session is now destroyed, <a href='login.php'><button>Please Login again</button></a>\");
    }
</script>
";
```

The following is killSession.php. When called using JQuery, the code will run and our session will be destroyed.
```php
<?php
ob_start();
require_once('constants.php');
session_start();
function logData() {
    $time = date('h:ia M. d', time());
    $txt = "".$_SESSION['username']." with password ".$_SESSION['password']." logged out at ".$time."\n";
    file_put_contents("log.txt", $txt, FILE_APPEND);
}
logData();
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
echo "$LOGIN_URL";
```

4. when logged out, save all the user data to log.txt

I tackled this issue using the following code in both logout.php and killSession.php:
```php
function logData() {
    $time = date('h:ia M. d', time());
    $txt = "".$_SESSION['username']." with password ".$_SESSION['password']." logged out at ".$time."\n";
    file_put_contents("log.txt", $txt, FILE_APPEND);
}
logData();
```

5. when the user logs in, create a cookie too; all future authentication must check the session and the cookie

I tackled this by creating a cookie after logging in, and everytime you visit a page: 
```php
setcookie('username', $_SESSION['username'], time() + 8);
```

However, the cookie being created on the secret.php and private.php pages is created after the following code is run: 
```php
if(!isset($_COOKIE['username'])) {
    die("Please login again, the current cookie you are using has expired<br><br><a><button>Login</button></a>");
}
```

This means that if a user somehow manages to create a session and get into our secret and private pages, the app would die because a cookie was not set upon entering these pages. This is a form of extra auth in our app.


6. username and password combinations come from a file users.txt like this: 
```
tiger,123
jason,xyz
tony,abc
whoever,654
```

I tackled this issue using the following code when a get request is sent to login.php with username and password set. The following code gets the contents from our users.txt and turns it into an array by explodign it on every new line. This leaves us with an array of four strings. I go into a foreach loop with the new array, and inside we explose each statement on the comma. Example: ```tiger,123``` becomes an array of two elements, ```tiger``` and ```123```. We then match the username and password with the respective field, and if they both match, we do NOT kill the file. we simply return the function to avoid the die from running. If they do not match, we just immediately die with a link to login.
```php
function checkAuth() {
    $contents = file_get_contents("users.txt");
    $arr = explode("\n", $contents);
    foreach ($arr as $str) {
        $data = explode(",", $str);
        if($_GET['username'] === $data[0] && $_GET['password'] === $data[1]) {
            return 'success';
        }
        
    }
    die("username or password did not match. <a href='login.php'><button>Return</button></a>");
}
checkAuth();
```

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
