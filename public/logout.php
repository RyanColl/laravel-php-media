<?php

ob_start();
require_once('constants.php');
session_start();

if (!isset($_SESSION['username'])) {
    echo "you can't log out! you haven't logged in!";
    $_SESSION['pageattempted'] = 'logout.php';
    die(LOGIN_URL);
}
function logData() {
    $time = date('h:ia M. d', time());
    $txt = "".$_SESSION['username']." with password ".$_SESSION['password']." logged out at ".$time."\n";
    file_put_contents("log.txt", $txt, FILE_APPEND);
}
logData();
// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
echo "bye";
echo "<br>";
echo "<br>";
echo "<br>";
echo "";
echo LOGIN_URL;


ob_end_flush();