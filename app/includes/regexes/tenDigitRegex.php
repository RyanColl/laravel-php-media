<?php
function getRegexFormFor10DigitPhoneNumber() {
    return "
        <form action='/' method='GET'>
            <fieldset class='user-fieldset'>
            <div>
            <legend id='ten_form'>Please enter the following information: </legend>
            <h4><b>proper format for 10 digit phone number:</b></h4>
            <p><pre>
                                    first 3, second 3 and third 4 numbers seperated by nothing -> 
                                                        <b>xxxxxxxxxx</b>
                                    first 3, second 3 and third 4 numbers seperated by nothing, or dash -> 
                                                        <b>xxx-xxxxxxx</b>
                                                        <b>xxxxxx-xxxx</b>
                                    first 3, second 3 and third 4 numbers seperated dashes -> 
                                                        <b>xxx-xxx-xxxx</b>
                                    first 3, second 3 and third 4 numbers seperated spaces -> 
                                                        <b>xxx xxx xxxx</b>
                                    first 3, second 3 and third 4 numbers seperated by dashes and spaces -> 
                                                        <b>xxx      xxx-xxxx</b>
                                    first 3 numbers wrapped in brackets, second 3 and third 4 numbers seperated by a dash or space -> 
                                                        <b>(xxx)xxx-xxxx </b>
                                                        <b>(xxx)xxx xxxx </b>
                                                        <b>(xxx)xxx     xxxx </b>
                                                        <b>(xxx)xxxxxxx</b>
                                                    *== CANNOT BE THE FOLLOWING ==*
                                    brackets not closed
                                                        <b>(xxxxxx-xxxx  </b>
                                                        <b>xxx)xxx-xxxx  </b>

            </pre></p>
            </div>
            <div>
            <label for='phone_number_ten'>10 Digit Phone Number</label>
            <input type='text' id='phone_number_ten' name='phone_number_ten'><br>
            <input type='submit' name='phone_number_ten_submit' value='Submit'><br>
            </div>
            </fieldset>
        </form>
    ";  
}
echo getRegexFormFor10DigitPhoneNumber();