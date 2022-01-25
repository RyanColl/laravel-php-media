<?php
$path = base_path();
$dir_handle = opendir("$path/public/uploads/");
if(is_resource($dir_handle))
{
    echo isset($_POST['file']);
    while(($file_name = readdir($dir_handle)) == true)
    {
        if(strlen($file_name)>2) {
            echo "<br>";
            echo("New File Name: " . $file_name);
        }
    }
    // closing the directory
    closedir($dir_handle);
}
else
{
    echo("Directory Cannot Be Opened.");
}
//
//for ($x=0; $x < count($f); $x++) {
//    echo "$f[$x]";
//}

//echo $_POST['fileupload'];
