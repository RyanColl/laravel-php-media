<?php
function getRegexFormFor7DigitPhoneNumber() {
    return "
        <form action='/' method='GET'>
            
            <fieldset class='user-fieldset'>
            <div>
            <legend id='seven_form'>Please enter the following information: </legend>
            <h4><b>proper format for 7 digit phone number:</b></h4>
            <p><pre>
        first 3 and second 4 numbers seperated by dash -> 
                            <b>xxx-xxxx</b>
        first 3 and second 4 numbers seperated by space ->
                            <b>xxx xxxx</b>  
        first 3 and second 4 numbers seperated by many spaces ->
                            <b>xxx      xxxx</b>
        first 3 and second 4 numbers seperated by nothing ->
                            <b>xxxxxxx</b>
            </pre></p>
            </div>
            <div>
            <label for='phone_number_seven'>7 Digit Phone Number</label>
            <input type='text' id='phone_number_seven' name='phone_number_seven'><br>
            <input type='submit' name='phone_number_seven_submit' value='Submit'><br>
            </div>
            </fieldset>
        
        </form>
    ";  
}
echo getRegexFormFor7DigitPhoneNumber();