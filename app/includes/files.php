<?php

$path = app_path();
$fullpath = "$path/includes/text.txt";
$f = fopen("$fullpath", "w");

fwrite($f, "chicken wing\n");

//echo "chicken wing printed to file at $fullpath";

function getForm()
{
    return "
        <form action='/upload' method='post' class='file-form'>
            <label for='fileupload'>Upload a File</label>
            <input id='fileupload' name='fileupload' type='file'>
            <input type='submit' name='submit'>
        </form>
    ";
}

echo getForm();
