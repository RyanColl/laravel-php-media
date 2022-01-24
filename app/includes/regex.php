<?php
$sevenNumRegex = "/^\d{3}([-]?|[\s]*)\d{4}$/";
$tenNumRegex = '/(^\d{3}|^\(\d{3}\))([-]?|[\s]*)\d{3}([-]?|[\s]*)\d{4}$/';
$licenseRegex = "/(^[A-Z]{3}[\s]?[0-9]{3}$|^[0-9]{3}[\s]?[A-Z]{3}$)/";
$streetRegex = "/^[0-9]{3,5}[\s]{1}[A-Z]{1}[a-z]{0,14}[\s]{1}Street$/";
$birthdayRegex = "/(^[JFMASONDEBRYPILUGSOCTVD]{3}-([0-2]{1}[0-9]{1}|[3]{1}[0-1]{1})-([0-1]{1}[0-9]{3}|20[0-2]{1}[0-1]{1})$|JAN-([0-1]{1}[0-9]{1}|2[0-5]{1})-2022)/";
$socialRegex = "/a/";

if(isset($_POST['file'])) {
    $file = $_POST['file'];
    echo "<h1>$file</h1>";
}

if(isset($_GET['phone_number_seven_submit']))
{
    $phonenum7 = $_GET['phone_number_seven'];
    $match7 = preg_match($sevenNumRegex, $phonenum7);
    if($match7) {
        echo "Submitted number: <h3><b>$phonenum7</b></h3> <h5><b>is</b></h5> a valid seven digit phone number";
    } else {
        echo "Submitted number: <h3><b>$phonenum7</b></h3> <h5><b>is not</b></h5> a valid seven digit phone number";
    }
    echo "<a href='/'>Clear</a>";
}
if(isset($_GET['phone_number_ten_submit']))
{
    $phonenum10 = $_GET['phone_number_ten'];
    $match10 = preg_match($tenNumRegex, $phonenum10);
    if($match10) {
        echo "Submitted number: <h3><b>$phonenum10</b></h3> <h5><b>is</b></h5> a valid ten digit phone number";
    } else {
        echo "Submitted number: <h3><b>$phonenum10</b></h3> <h5><b>is not</b></h5> a valid ten digit phone number";
    }
    echo "<a href='/'>Clear</a>";
}
if(isset($_GET['license_plate_submit']))
{
    $license = $_GET['license_plate'];
    $matchlicense = preg_match($licenseRegex, $license);
    if($matchlicense) {
        echo "Submitted license: <h3><b>$license</b></h3> <h5><b>is</b></h5> a valid license plate number";
    } else {
        echo "Submitted license: <h3><b>$license</b></h3> <h5><b>is not</b></h5> a valid license plate number";
    }
    echo "<a href='/'>Clear</a>";
}
if(isset($_GET['street_address_submit']))
{
    $address = $_GET['street_address'];
    $matchaddress = preg_match($streetRegex, $address);
    if($matchaddress) {
        echo "Submitted address: <h3><b>$address</b></h3> <h5><b>is</b></h5> a valid address";
    } else {
        echo "Submitted address: <h3><b>$address</b></h3> <h5><b>is not</b></h5> a valid address";
    }
    echo "<a href='/'>Clear</a>";
}
if(isset($_GET['birthday_submit']))
{
    $birthday = $_GET['birthday'];
    $matchbirthday = preg_match($birthdayRegex, $birthday);
    if($matchbirthday) {
        echo "Submitted birthday: <h3><b>$birthday</b></h3> <h5><b>is</b></h5> a valid birthday";
    } else {
        echo "Submitted birthday: <h3><b>$birthday</b></h3> <h5><b>is not</b></h5> a valid birthday";
    }
    echo "<a href='/'>Clear</a>";
}
if(isset($_GET['birthday_submit']))
{
    $birthday = $_GET['birthday'];
    $matchbirthday = preg_match($birthdayRegex, $birthday);
    if($matchbirthday) {
        echo "Submitted birthday: <h3><b>$birthday</b></h3> <h5><b>is</b></h5> a valid birthday";
    } else {
        echo "Submitted birthday: <h3><b>$birthday</b></h3> <h5><b>is not</b></h5> a valid birthday";
    }
    echo "<a href='/'>Clear</a>";
}

require_once(app_path().'/includes/regexes/userForm.php');


    require_once(app_path().'/includes/regexes/sevenDigitRegex.php');
    require_once(app_path().'/includes/regexes/tenDigitRegex.php');
    require_once(app_path().'/includes/regexes/licenseRegex.php');
    require_once(app_path().'/includes/regexes/streetRegex.php');
    require_once(app_path().'/includes/regexes/birthdayRegex.php');
    require_once(app_path().'/includes/regexes/socialRegex.php');
    require_once(app_path().'/includes/regexes/fileRegex.php');




