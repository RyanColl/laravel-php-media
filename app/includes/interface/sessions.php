<?php
session_start();
$id = session_id();

function getLoginForm() {
    $id = session_id();
    return "
        <form action='/' method='GET'>
            <input class='hidden' value=".$id." type='text' name='id' id='id'>
            <label for='username'>Please Enter Your Username</label>
            <input type='text' id='username' name='username'><br>
            <label for='password'>Please Enter Your Password</label>
            <input type='text' id='password' name='password'><br>
            <input type='submit' name='login_submit' value='Submit'><br>
        </form>
    ";
}

function getSignInForm() {
    return "
        
    ";
}

if(!isset($_GET['username'])) {
    echo getLoginForm();
} 
if (isset($_GET['username']) && !isset($_SESSION['username'])) {
    $_SESSION['username'] = $_GET['username'];
    echo "user logged in with id: $id";
}
if (isset($_SESSION['username'])) {
    require_once(app_path().'/includes/interface/loggedin.php');
}