<?php
ob_start();
session_start();
$_SESSION['pageattempted'] = 'login.php';
echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>";

// 1. no GET data, no SESSION data: show form
// 2. GET data,    no SESSION data: start a session, show menu
// 3. no GET data, SESSION data: logout? show menu
// 4. GET data,    SESSION data: start session with new get data, show menu

// 1. no GET data, no SESSION data: show form
if(!isset($_GET['username']) && !isset($_SESSION['username']))
{
    echo '
        <form action="" method="get">
        username:<input type="text" name="username"><br>
        password:<input type="password" name="password"><br>
        <input type="submit">
        </form>
    ';
    die();
}
else if(isset($_GET['username']))
{
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
    echo "logging you in as " . $_GET['username'];
    $_SESSION['username'] = $_GET['username'];
    $_SESSION['password'] = $_GET['password'];
    $_SESSION['logintime'] = time();
    setcookie('username', $_GET['username'], time() + 8);
    if(isset($_SESSION['pageattempted']))
    {
        echo "<br><br>";
        echo "<a href='login.php'>redirect to " . $_SESSION['pageattempted'] . "</a>";
        echo "
            <script>
                $(document).ready(function() {
                    setTimeout(() => {
                        window.location.replace('login.php')
                    }, 3000)
                });
            </script>
            ";
        die();
    }else
    {
        echo "<a href='secret.php'>secret</a> | ";
        echo "<a href='private.php'>private</a>| ";
        echo "<a href='logout.php'>logout</a>| ";
       
    }
}
else if(!isset($_GET['username']) && isset($_SESSION['username']))
{
    setcookie('username', $_SESSION['username'], time() + 8);
    echo "hello you are logged in as " . $_SESSION['username'] . "<br>";
    echo "<a href='secret.php'>secret</a> | ";
    echo "<a href='private.php'>private</a> | ";
    echo "<a href='logout.php'>logout</a>";
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
    die();

}

ob_end_flush();