<?php

session_start();

include('read-file.php');

$name = $_POST["name"];

// Redirect info
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$redirectToPage = 'index.php';

/**
 * Validation
 */

// Remove punctuation  and spaces
$name = preg_replace( '/[^\w\']+|\'(?!\w)|(?<!\w)\'/', '', $name );

$len = strlen($name);

if($name == null)
{
    $_SESSION['error'] = "Please enter a name!";
    header("Location: http://$host$uri/$extra");
    exit;
} elseif($len > 20) {
    $_SESSION['error'] = "Please enter a name that's less than 20 characters!";
    header("Location: http://$host$uri/$extra");
    exit;
} elseif(in_array($name,$names)){
    $_SESSION['error'] = "Oops! Somebody called $name is already a teamaker! Try something a little more original next time ;-)";
    header("Location: http://$host$uri/$extra");
    exit;
}else {
    $file = fopen("assets/files/tea-people.txt", "a") or die("Unable to open file!");
   
    // If this is the first name, do not put a comma before
    // So that an empty string isn't included as a name
    if($count == 0){
        fwrite($file, $name);
    } else {
        fwrite($file, ',' . $name);
        fclose($file);
    }

    $_SESSION['success'] = "We've got you down as '$name' on the list now! :-)";
    header("Location: http://$host$uri/$extra");
    exit;
}