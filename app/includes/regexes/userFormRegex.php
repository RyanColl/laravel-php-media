<?php

$ufSeven = $_GET['phone_number_7_userform'];
$ufTen = $_GET['phone_number_10_userform'];
$ufLicense = $_GET['license_plate_userform'];
$ufStreet = $_GET['street_address_userform'];
$ufBirthday = $_GET['birthday_userform'];
$ufSocial = $_GET['regex_social_userform'];

if(!preg_match($sevenNumRegex, $ufSeven)) {
    if($ufSeven === "") {
        echo "seven digit phone number is empty<br>";
    } else
    echo "The seven digit phone number you entered is not the correct format. <a href='#seven_form'>Check format below</a>";
}
if(!preg_match($tenNumRegex, $ufTen)) {
    if($ufTen === "") {
        echo "ten digit phone number is empty<br>";
    } else
    echo "The ten digit phone number you entered is not the correct format. <a href='#ten_form'>Check format below</a>";
}
if(!preg_match($licenseRegex, $ufLicense)) {
    if($ufLicense === "") {
        echo "license is empty<br>";
    } else
    echo "The license plate number you entered is not the correct format. <a href='#license_form'>Check format below</a>";

}
if(!preg_match($streetRegex, $ufStreet)) {
    if($ufStreet === "") {
        echo "address is empty<br>";
    } else {
        echo "The address you entered is not of the correct format. <a href='#street_form'>Check format below</a>";
    }
}
if(!preg_match($birthdayRegex, $ufBirthday)) {
    if($ufBirthday === "") {
        echo "birthday is empty<br>";
    } else {
        echo "The birthday you entered is not of the correct format. <a href='#birthday_form'>Check format below</a>";
    }
}
if(!preg_match($socialRegex, $ufSocial)) {
    if($ufSocial === "") {
        echo("social is empty<br>");
    } else {
        echo "The social insurance number you entered is not of the correct format. <a href='#social_form'>Check format below</a>";
    }
    
}
if(!preg_match($socialRegex, $ufSocial) && !preg_match($birthdayRegex, $ufBirthday) && !preg_match($streetRegex, $ufStreet) && !preg_match($licenseRegex, $ufLicense) && !preg_match($tenNumRegex, $ufTen) && !preg_match($sevenNumRegex, $ufSeven)) {
    echo "<h3><a href='/'>Clear</a></h3>";
}
else {
    echo "
        <h3>Submitted information is Valid!</h3>
        <h4>7 Digit Phone Number: <b>$ufSeven</b></h4>
        <h4>10 Digit Phone Number: <b>$ufTen</b></h4>
        <h4>License Plate: <b>$ufLicense</b></h4>
        <h4>Street Address: <b>$ufStreet</b></h4>
        <h4>Birthday: <b>$ufBirthday</b></h4>
        <h4>Social Insurance Number: <b>$ufSocial</b></h4>
    ";
}