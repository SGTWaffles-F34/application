<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//OB-Start to get around header already sent error
ob_start();


//Start a session
session_start();

//Var dump for debugging
var_dump($_SESSION);
//var_dump($_POST);

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
        var_dump($_POST);
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

    echo "<p> jobs and mailing </p>";
    echo ($_SERVER['REQUEST_METHOD']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<p>POST </p>";
//        var_dump($_POST);

        //Add development jobs to session array
        $jobString = isset($_POST['dev']) ?
            implode(", ",$_POST['dev']) : "";

        $_SESSION['devJobs'] = $jobString;

        //Add industry verticals to session array
        $indString = isset($_POST['indV']) ?
            implode(", ",$_POST['indV']) : "";

        $_SESSION['indVerts'] = $indString;

        //Reroute to summary page
        $f3->reroute('summary');
    }

    $f3->set('devJobs', ['JavaScript', 'PHP', 'Java', 'Python', 'HTML', 'CSS', 'ReactJS', 'NodeJS']);
    $f3->set('indVerts', ['Saas', 'Health Tech', 'Ag tech', 'HR Tech', 'Industrial Tech', 'Cybersecurity']);

        //Instantiate a view
    $view = new Template();
    echo $view->render("views/jobsandmailing.html");
});

//Summary page route
$f3->route('GET|POST /summary', function() {
    //Instantiate a view
    $view = new Template();
    echo $view->render("views/summary.html");

    session_destroy();
});


//run fat-free
$f3->run();

//
ob_flush();

