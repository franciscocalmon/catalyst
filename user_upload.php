<?php
ini_set('display_errors',1);
include_once "classes/User.php";

$shortopts  = "";
$shortopts .= "u:";  // Required value
$shortopts .= "p:";  // Required value
$shortopts .= "h:";  // Required value
$shortopts .= "v::"; // Optional value
$shortopts .= "abc"; // These options do not accept values

$longopts  = array(
    "file:",     // Required value
    "create_table::",    // Optional value
    "dry_run::",    // Optional value
    "help::",    // Optional value
    "option",        // No value
    "opt",           // No value
);
<<<<<<< HEAD

$options = getopt($shortopts, $longopts);
//var_dump($options);

$user = new User($options);

print_r($user->checkOptions());
=======
$options = getopt($shortopts, $longopts);
var_dump($options);

$user = new User();

print $user->test;
>>>>>>> 4f593f60b19465ba5287758697fa409b951ef0d3

 ?>
