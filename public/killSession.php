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