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
