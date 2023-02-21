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
$f3->route('GET /', function (){
    //Instantiate a view
    $view = new Template();
    echo $view->render("views/home.html");
});

//run fat-free
$f3->run();