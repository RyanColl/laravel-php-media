<?php

function stripTags($username, $email, $password) 
{
    if(strip_tags($username) !== $username) {
        die("invalid username $username. <a href='/'>Try Again</a>.");
    }
    if(strip_tags($email) !== $email) {
        die("invalid email $email. <a href='/'>Try Again</a>.");
    }
    if(strip_tags($password) !== $password) {
        die("invalid password $password. <a href='/'>Try Again</a>.");
    }
}
function validateUsername($username)
{
    if(!(strlen($username))) {
        die("invalid username, please enter a non-empty string.&nbsp<a href='/'>Try Again</a>.");
    }
    if(str_contains(strtolower($username), "admin")) {
        die("invalid username, please enter a username without the word admin.&nbsp<a href='/'> Try Again</a>.");
    }
}
function validatePassword($password)
{
    if(strlen($password) > 20) {
        die("password must be less than 20 characters.&nbsp<a href='/'> Try Again</a>.");
    }
    if(strlen($password) < 6) {
        die("password must be greater than 6 characters.&nbsp<a href='/'> Try Again</a>.");
    }
    if(strtoupper($password) === $password) {
        die("password must contain at least one lowercase character.&nbsp<a href='/'> Try Again</a>.");
    }
    if(strtolower($password) === $password) {
        die("password must contain at least one uppercase character.&nbsp<a href='/'> Try Again</a>.");
    }
    if(!preg_match("#[0-9]+#",$password)) {
        die("password must contain at least one digit!&nbsp<a href='/'> Try Again</a>.");
    }
    if(!preg_match('/[\'^£$%&!*()}{@#~?><>,|=_+¬-]/', $password)) {
        die("password must contain at least one non alpha-neumeric character.&nbsp<a href='/'> Try Again</a>.");
    }
}
function validateEmail($email)
{
    if(!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        die("invalid email, please ensure email follows proper format including using @ and .com or something similar.&nbsp<a href='/'> Try Again</a>.");
    }
}
function getForm()
{
    return "
    <form action='/' method='GET'>
        <fieldset class='user-fieldset'>
        <legend>User Information</legend>
        <label for='username'>User Name</label>
        <input type='text' id='username' name='username'><br><br>
        <label for='email'>Email:</label>
        <input type='email' id='email' name='email'><br><br>
        <label for='password'>Password:</label>
        <input type='password' id='password' name='password'><br><br>
        <input type='submit' name='submit' value='Submit'>
        </fieldset>
    </form>
    ";
}
if(!isset($_GET['submit'])) {
    echo getForm();
} 
else 
{
    $username = $_GET["username"];
    $email = $_GET["email"];
    $password = $_GET["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if(strlen($hashed_password) !== 60) 
    {
        die("Error");
    }
    stripTags($username, $email, $password);
    validateUsername($username);
    validatePassword($password);
    validateEmail($email);


    // ALL VALIDATIONS HAVE PASSED, NOW WE CAN REQUIRE
    
    require_once(app_path().'/includes/verify.php');
    
};