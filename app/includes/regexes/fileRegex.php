<?php

function getFileConstraints() {
    return "
        <p><pre>

<h1 id='file_constraints'>File Constraints</h1>
<h3>These are the constraints for filenames:</h3>
all file names allowed except names which include a number after a letter -> 
                <b>a.png</b>
                <b>ab.png</b>
                <b>a_b.png</b>
                <b>333.pdf</b>
            <b>*== Not Allowed ==*</b>
                <b>asdfE8ttt.txt</b>
                <b>a5.jpg</b>
        </pre></p>
    ";
}
echo getFileConstraints();