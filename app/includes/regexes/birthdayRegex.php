<?php
function getRegexFormForBirthday() 
{
    return "
        <form action='/' method='GET'>
            <fieldset class='user-fieldset'>
            <div>
            <legend id='birthday_form'>Please enter the following information: </legend>
            <h4><b>proper format for Birthday:</b></h4>
            <p><pre>
        starting with MMM, then DD, then YYYY -> 
        one hyphen in between each section is mandatory ->

                    <b>JAN-01-2002</b>
                    <b>FEB-30-2022</b>
                    <b>MAY-30-1933</b>
                    <b>*== Not Allowed ==*</b>
                    <b>OCT01-1999</b>
                    <b>Jan12 2022</b>
                    <b>Feb-27-2022</b>
                    <b>FEB-01-2022</b>
                    <b>DEC-25-2525</b>
            </pre></p>
            </div>
            <div>
            
            <label for='birthday'>Birthday</label>
            <input type='text' id='birthday' name='birthday'><br>
            </div>
            </fieldset>
        </form>
    "; 
}


echo getRegexFormForBirthday();