<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the necessary files
require_once('vendor/autoload.php');

//Start a session
session_start();

//Create an instance of the Base class
$f3 = Base::instance();

//create an instance of the controller class
$con = new Controller($f3);//hand it to our controller class to create an instance

//Define a default route
$f3->route('GET /', function() {
    $GLOBALS['con']->home(); //$GLOBALS gives access to global variables inside a php method
});