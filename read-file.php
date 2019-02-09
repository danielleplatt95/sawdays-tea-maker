<?php

$whoIsMakingTea = null;
$count = 0;
$plural = "s";

if($fh = fopen('assets/files/tea-people.txt', 'r')) 
{
    // Before the end of file is reached, write the file contents to var
    while (!feof($fh)) {
        $content = fgets($fh);
    }
    fclose($fh);
}



if($content){

    $names = explode(",", $content);

    $count = sizeof($names);

    if($count !== 0)
    {

        // Count needs 1 subtracted to deal with 0th index
        $random = rand(0, $count-1);

        $whoIsMakingTea = $names[$random];
    }

    if($count == 1)
    {
        $plural = "";
    }
}