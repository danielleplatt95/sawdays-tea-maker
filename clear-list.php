<?php

// Redirect info
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$redirectToPage = 'index.php';

// Open and clear file contents
if($fh = fopen('assets/files/tea-people.txt', 'r')) 
{
    file_put_contents("assets/files/tea-people.txt", "");

    fclose($fh);
}

// Redirect
header("Location: http://$host$uri/$extra");
exit;






