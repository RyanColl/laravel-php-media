<?php
function getRegexFormForSocial() {
    return "
        <form action='/' method='GET'>
            
            <fieldset class='user-fieldset'>
            <div>
            <legend id='social_form'>Please enter the following information: </legend>
            <h4><b>proper format for a social insurance number:</b></h4>
            <p><pre>
            9 digits in length, all together -> 
                            <b>123456789</b>
            9 digits in length, spaces between each set of 3 ->
                            <b>123 456 789</b>  
            9 digits in length, spaces optional only between sets of 3 ->
                            <b>123 456789</b>  
            9 digits in length, many spaces optional only between sets of 3 ->
                            <b>123 456       789</b>  
                            <b>*== Not Allowed ==*</b>
            using dashes ->
                            <b>123-456       789</b>  
            using length less than 9 ->
                            <b>23      456789</b>  
            
            </pre></p>
            </div>
            <div>
            <label for='regex_social'>Social Insurance Num(not actually)</label>
            <input type='text' id='regex_social' name='regex_social'><br>
            <input type='submit' name='regex_social_submit' value='Submit'><br>
            </div>
            </fieldset>
        
        </form>
    ";  
}
echo getRegexFormForSocial();