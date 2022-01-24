<?php
function getRegexFormForStreet() 
{
    return "
        <form action='/' method='GET'>
            
            <fieldset class='user-fieldset'>
            <div>
            <legend id='street_form'>Please enter the following information: </legend>
            <h4><b>proper format for Street Address:</b></h4>
            <p><pre>
        first characters are digits between 3-5 in length ->
        second characters are letters, first one capital and the rest lowercase, limit 15 ->
        third characters are letters, first one capital and the rest lowercase, limit 15  -> 
        mandatory space in between the words ->
                            <b>123 Main Street</b>
                            <b>8888 Oak Street </b>
                            <b>*== NOT ALLOWED ==*</b>
                            <b>12345 Van Avenue</b>
                            <b>123 Argentina Boulevard</b>
                            <b>ABC123Argentina Boulevard</b>
                           
            </pre></p>
            </div>
            <div>
            <label for='street_address'>Street Address</label>
            <input type='text' id='street_address' name='street_address'><br>
            <input type='submit' name='street_address_submit' value='Submit'><br>
            </div>
            </fieldset>
        
        </form>
    "; 
}


echo getRegexFormForStreet();