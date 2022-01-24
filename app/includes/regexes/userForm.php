<?php

function getUserForm() 
{
    return "
        <form action='/' method='GET'>
            <fieldset class='user-fieldset'>
                <div>
                    <legend>Please enter your information: </legend>
                    <label for='phone_number_7_userform'>Please enter your 7 Digit Phone Number</label>
                    <a href='#seven_form'>See Below</a>
                    <input type='text' id='phone_number_7_userform' name='phone_number_7_userform'><br>
                    <label for='phone_number_userform'>Please enter your 10 Digit Phone Number</label>
                    <a href='#ten_form'>See Below</a>
                    <input type='text' id='phone_number_10_userform' name='phone_number_userform'><br>
                    <label for='license_plate_userform'>Please enter your License Plate Number</label>
                    <a href='#license_form'>See Below</a>
                    <input type='text' id='license_plate_userform' name='license_plate_userform'><br>
                    <label for='street_address_userform'>Street Address</label>
                    <a href='#street_form'>See Below</a>
                    <input type='text' id='street_address_userform' name='street_address_userform'><br>
                    <label for='birthday_userform'>Please enter your birthday</label>
                    <a href='#birthday_form'>See Below</a>
                    <input type='text' id='birthday_userform' name='birthday_userform'><br>
                    <label for='regex_social_userform'>Please enter your social</label>
                    <a href='#social_form'>See Below</a>
                    <input type='text' id='regex_social_userform' name='regex_social_userform'><br>
                    <input type='submit' name='birthday_submit' value='Submit'><br>
                </div>
            </fieldset>
        </form>
    ";
}

echo getUserForm();