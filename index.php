<?php
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the necessary files
require_once('vendor/autoload.php');
require_once('model/validate.php');


//OB-Start to get around header already sent error
ob_start();

//Start a session
session_start();

//Var dump for debugging
var_dump($_SESSION);
var_dump($_POST);


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

//validate name data
function validName(string $name){

    //if name contains 2 or more characters and is alphabetical
    if(strlen($name) >= 2 && ctype_alpha($name)){
        return true;
    }

    //else return false, data is invalid
    return false;
}

//validate email data
function validEmail(string $email){

    //if email is contains at least 2 chars, an @ and a .com
    //can't use str_contains() function because our server runs php 7.0.33, str_contains was introduced in php 8 :(
    if(strlen($email) >= 2 && (strpos($email, '@') !== false) && (strpos($email, '.com') !== false)){
        return true;
    }

    return false;
}

//validates phone number data
function validPhone(string $phone){

    //if phone contains no letters, minimum 10 characters, maximum 11 characters
    if(ctype_digit($phone) && strlen($phone) >=10 && strlen($phone) <= 11){
        return true;
    }

    return false;
}

function validGithub($ghub){

    //if text includes "https://github.com/' and more than 19 characters
    if((strpos($ghub, 'https://github.com/') !== false) && strlen($ghub) > 19){
        return true;
    }

    return false;
}

function validExperience($yrexp){

    //if yrexp == one of the possible values and nothing else
    if($yrexp == '0-2 years' || $yrexp == '2-4 years' || $yrexp == '4+ years'){
        return true;
    }

    return false;
}

function validSelectionsJobs($jobOptions){

    $jobs = ['JavaScript', 'PHP', 'Java', 'Python', 'HTML', 'CSS', 'ReactJS', 'NodeJS'];

    //test array to see what happens if invalid option ends up in the array
    //$testJobs =['Java', 'HTML', 'C++'];

    if(count($jobOptions) >= 1) {
        //if the string contains only options from the provided array
        foreach ($jobOptions as $input) {
            if (!in_array($input, $jobs)) {
                return false;
            }
        }
    }
    return true;
}

function validSelectionsVerticals($vertOptions){

    $verts = ['Saas', 'Health Tech', 'Ag tech', 'HR Tech', 'Industrial Tech', 'Cybersecurity'];

    //test array
    //$testVerts = ['Saas', 'Health Tech', 'Ag tech', 'debugging'];

    if(count($vertOptions) >= 1) {
        //if the string contains only options from the provided array
        foreach ($vertOptions as $input) {
            if (!in_array($input, $verts)) {
                return false;
            }
        }
    }

    return true;
}

//personal info route
$f3->route('GET|POST /personinfo', function($f3) {

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {

       $fname = trim($_POST['fname']);
       $lname = trim($_POST['lname']);
       $email = $_POST['email'];
       $phone = $_POST['phone'];



       if(validName($fname) && validName($lname) && validEmail($email) && validPhone($phone)){

           $_SESSION['fname'] = $fname;
           $_SESSION['lname'] = $lname;
           $_SESSION['email'] = $email;
           $_SESSION['state'] = $_POST['state'];
           $_SESSION['phone'] = $phone;

           //Redirect
           $f3->reroute('experience');
       }

   }

   //Instantiate a view
   $view = new Template();
   echo $view->render("views/personinfo.html");
});

//previous experience route
$f3->route('GET|POST /experience', function($f3) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        $ghub = $_POST['ghub'];
        $yrexp = $_POST['yrexp'];

        if(validGithub($ghub) && validExperience($yrexp)) {
            $_SESSION['bio'] = $_POST['bio'];
            $_SESSION['ghub'] = $ghub;
            $_SESSION['yrexp'] = $yrexp;
            $_SESSION['relocate'] = $_POST['relocate'];

            //Redirect
            $f3->reroute('jobsandmailing');
        }
    }

    //Instantiate a view
    $view = new Template();
    echo $view->render("views/experience.html");
});

//Job Openings and Mailing List route
$f3->route('GET|POST /jobsandmailing', function($f3) {

//    echo "<p> jobs and mailing </p>";
//    echo ($_SERVER['REQUEST_METHOD']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //echo "<p>POST </p>";
//        var_dump($_POST);

        $jobOptions = $_POST['dev'];
        $vertOptions = $_POST['indV'];

        //Add development jobs to session array
        $jobString = isset($_POST['dev']) ?
            implode(", ",$_POST['dev']) : "";

        $_SESSION['devJobs'] = $jobString;

        //Add industry verticals to session array
        $indString = isset($_POST['indV']) ?
            implode(", ",$_POST['indV']) : "";

        $_SESSION['indVerts'] = $indString;

        if(validSelectionsJobs($jobOptions)){
            //Reroute to summary page
            $f3->reroute('summary');
        }
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

