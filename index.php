<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the necessary files
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();

//create an instance of the controller class
//$con = new Controller($f3);//hand it to our controller class to create an instance

//Define a default route
$f3->route('GET /', function (){
    //Instantiate a view
    $view = new Template();
    echo $view->render("views/home.html");
});


//Define a home route
$f3->route('GET /home', function (){
    //Instantiate a view
    $view = new Template();
    echo $view->render("views/home.html");
});

//personal info route
$f3->route('GET|POST /personinfo', function($f3) {

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {

       $_SESSION['fname'] = $_POST['fname'];
       $_SESSION['lname'] = $_POST['lname'];
       $_SESSION['email'] = $_POST['email'];
       $_SESSION['state'] = $_POST['state'];
       $_SESSION['phone'] = $_POST['phone'];

       //Redirect
       $f3->reroute('experience');
   }

   //Instantiate a view
   $view = new Template();
   echo $view->render("views/personinfo.html");
});

//previous experience route
$f3->route('GET|POST /experience', function($f3) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_SESSION['bio'] = $_POST['bio'];
        $_SESSION['ghub'] = $_POST['ghub'];
        $_SESSION['yrexp'] = $_POST['yrexp'];
        $_SESSION['relocate'] = $_POST['relocate'];

        //Redirect
        $f3->reroute('jobsandmailing');
    }

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/experience.html");
});

//Job Openings and Mailing List route
$f3->route('GET|POST /jobsandmailing', function($f3) {


    //Instantiate a view
    $view = new Template();
    echo $view->render("views/jobsandmailing.html");
});

//Summary page route
$f3->route('GET|POST /summary', function() {
    //Instantiate a view
    $view = new Template();
    echo $view->render("views/summary.html");
});


//run fat-free
$f3->run();