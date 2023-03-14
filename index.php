<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the necessary files
require_once('vendor/autoload.php');
//require_once('model/validate.php');

$validator = new Validate();

//OB-Start to get around header already sent error
//ob_start();

//Start a session
session_start();

//Var dump for debugging
//var_dump($_SESSION);
//var_dump($_POST);


//Create an instance of the Base class
$f3 = Base::instance();

//Create instances of Controller and DataLayer Objects
$con = new Controller($f3);
$dataLayer = new DataLayer();

//$myApplicant = new Applicant("Jedidiah");
//$dataLayer->insertApplicant($myApplicant); tested, works fine

//create an instance of the controller class
//$con = new Controller($f3);//hand it to our controller class to create an instance

//Define a default route
$f3->route('GET /', function (){
   $GLOBALS['con']->home();
});

//Define a home route
$f3->route('GET /home', function (){
    $GLOBALS['con']->home();
});

//personal info route
$f3->route('GET|POST /personinfo', function($f3) {

    $GLOBALS['con']->personalInfo();
});

//previous experience route
$f3->route('GET|POST /experience', function($f3) {

    $GLOBALS['con']->experience();
});

//Job Openings and Mailing List route
$f3->route('GET|POST /jobsandmailing', function($f3) {

    $GLOBALS['con']->jobsAndMailing();
});

//Summary page route
$f3->route('GET|POST /summary', function() {

    $GLOBALS['con']->summary();
});

$f3->route('GET /administration', function(){

   $GLOBALS['con']->administration();
});

//run fat-free
$f3->run();

//
//ob_flush();

