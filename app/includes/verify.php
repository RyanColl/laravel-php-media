<?php

    $username = $_GET["username"];
    $email = $_GET["email"];
    $password = $_GET["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if(strlen($hashed_password) !== 60) 
    {
        die("Error");
    }
    function displayInfo($username, $email, $password)
    {
        return "
            <div class='info'>
                <h2>here is our info:</h2>
                <p>username: <b>$username</b></p>
                <p>email: <b>$email</b></p>
                <p>password hash: <b>$password</b></p>
            </div>
        ";
    }
    echo displayInfo($username, $email, $hashed_password);
    echo "<div><h1>THANKS</h1></div>";
    echo "<a href='/'>Return</a>";