<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the necessary files
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

//create an instance of the controller class
//$con = new Controller($f3);//hand it to our controller class to create an instance

//Define a default route
$f3->route('GET /home', function (){
    //Instantiate a view
    $view = new Template();
    echo $view->render("views/home.html");
});

//personal info route
$f3->route('GET /personinfo', function() {
    //Instantiate a view
    $view = new Template();
    echo $view->render("views/personinfo.html");
});

//previous experience route
$f3->route('GET /experience', function() {
    //Instantiate a view
    $view = new Template();
    echo $view->render("views/experience.html");
});

//Job Openings and Mailing List route
$f3->route('GET /jobsandmailing', function() {
    //Instantiate a view
    $view = new Template();
    echo $view->render("views/jobsandmailing.html");
});

//Summary page route
$f3->route('GET /summary', function() {
    //Instantiate a view
    $view = new Template();
    echo $view->render("views/summary.html");
});


//run fat-free
$f3->run();