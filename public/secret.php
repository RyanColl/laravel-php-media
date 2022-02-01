<?php
ob_start();
require_once('constants.php');
session_start();

if(!isset($_SESSION['username']))
{
    $_SESSION['pageattempted'] = 'secret.php';
    die(LOGIN_URL);
}
if(!isset($_COOKIE['username'])) {
    die("Please login again, the current cookie you are using has expired<br><br><a href='login.php'><button>Login</button></a>");
}
else
{
    setcookie('username', $_SESSION['username'], time() + 8);
    $_SESSION['lastactivitytime'] = time();
    echo "thanks for logging in " . $_SESSION['username'];
    echo "here is a secret: ";
    echo "chickenwings are my favourite food!";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<a href='login.php'><button>Return</button></a>";
    echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>";
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
    echo "
        <style>
            #timestamp {
                position: absolute;
                top: 6%;
                right: 10%;
            }
            #kstimestamp {
                position: absolute;
                top: 40%;
                right: 50%;
                text-align: center;
            }
        </style>
        ";
    echo "<div id='timestamp'></div>";
    echo "<h1 id='kstimestamp'></h1>";
}


ob_end_flush();