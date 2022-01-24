<?php
function getRegexFormForLicensePlate() 
{
    return "
        <form action='/' method='GET'>
            
            <fieldset class='user-fieldset'>
            <div>
            <legend id='license_form'>Please enter the following information: </legend>
            <h4><b>proper format for Car License Plate:</b></h4>
            <p><pre>
        first 3 are either digits or letters, all capital, and other 3 are the opposite -> 
        one space is allowed ->
                            <b>123 ABC</b>
                            <b>ABC 123</b>
                            <b>123ABC</b>
                            <b>ABC123</b>
            </pre></p>
            </div>
            <div>
            <label for='license_plate'>License Plate Number</label>
            <input type='text' id='license_plate' name='license_plate'><br>
            <input type='submit' name='license_plate_submit' value='Submit'><br>
            </div>
            </fieldset>
        
        </form>
    "; 
}


echo getRegexFormForLicensePlate();