<?php

class Controller{

    private $_f3;

    /**
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
    }

    function home()
    {
        //Instantiate a view
        $view = new Template();
        echo $view->render("views/home.html");
    }

    function personalInfo(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(isset($_POST['mlist'])){
                $currentApplication = new ApplicantSubscribed();
            }else{
                $currentApplication = new Applicant();
            }

            $fname = trim($_POST['fname']);
            $lname = trim($_POST['lname']);
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $state = $_POST['state'];

            $currentApplication->setState($state);

            if(Validate::validName($fname)) {

                $currentApplication->setFname($fname);

            }else{
                $this->_f3->set('errors["fname"]','Invalid name');
            }

            if(Validate::validName($lname)) {
                $currentApplication->setLname($lname);

            }else{
                $this->_f3->set('errors["lname"]','Invalid name');
            }

            if(Validate::validEmail($email)) {
                $currentApplication->setEmail($email);
            }else{
                $this->_f3->set('errors["email"]','Invalid email');
            }

            if(Validate::validPhone($phone)) {
                $currentApplication->setPhone($phone);
            }else{
                $this->_f3->set('errors["phone"]','Invalid Phone number');
            }

            if(empty($this->_f3->get('errors'))) {

                $_SESSION['newApplication'] = $currentApplication;

                $this->_f3->reroute('experience');
            }

        }

        //Instantiate a view
        $view = new Template();
        echo $view->render("views/personinfo.html");
    }


    function experience(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);

            $ghub = $_POST['ghub'];
            $yrexp = $_POST['yrexp'];

            $bio = $_POST['bio'];
            $relocate = $_POST['relocate'];

            $_SESSION['newApplication']->setBio($bio);
            $_SESSION['newApplication']->setRelocate($relocate);


            if(Validate::validGithub($ghub)) {

                $_SESSION['newApplication']->setGHub($ghub);

            }else{
                $this->_f3->set('errors["ghub"]','Invalid github link');
            }

            if(Validate::validExperience($yrexp)) {

                $_SESSION['newApplication']->setExp($yrexp);

            }else{
                $this->_f3->set('errors["yrexp"]','Invalid experience');
            }

            if(empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('jobsandmailing');
            }

        }

        $this->_f3->set('experience', Datalayer::yearsExp());

        //Instantiate a view
        $view = new Template();
        echo $view->render("views/experience.html");
    }

    function jobsAndMailing()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $jobOptions = $_POST['dev'];
            $vertOptions = $_POST['indV'];

            //Add development jobs to session array
            $jobString = isset($_POST['dev']) ?
                implode(", ",$_POST['dev']) : "";

            //Add industry verticals to session array
            $indString = isset($_POST['indV']) ?
                implode(", ",$_POST['indV']) : "";

            if(Validate::validSelectionsJobs($jobOptions)){
                if($_SESSION['newApplication'] instanceof applicantSubscribed) {
                    $_SESSION['newApplication']->setSelectionJobs($jobString);
                }
            }else{
                $this->_f3->set('errors["dev"]', 'Invalid job selected');
            }

            if(Validate::validSelectionsVerticals($vertOptions)){

                if($_SESSION['newApplication'] instanceof applicantSubscribed) {
                    $_SESSION['newApplication']->setSelectionVerticals($indString);
                }
            }else{
                $this->_f3->set('errors["indV"]', 'Invalid verticals selected');
            }

            //Reroute to summary page
            $this->_f3->reroute('summary');

        }

        $this->_f3->set('devJobs', Datalayer::sDevJobs());
        $this->_f3->set('indVerts', Datalayer::indVerts());

        //Instantiate a view
        $view = new Template();
        echo $view->render("views/jobsandmailing.html");
    }

    function summary()
    {
        //Write to Database
        $id = $GLOBALS['dataLayer']->insertApplicant($_SESSION['newApplication']);
        echo "$id inserted successfully";

        //Instantiate a view
        $view = new Template();
        echo $view->render("views/summary.html");

        session_destroy();
    }

    function administration()
    {
        //Get the data from the model
        $applicants = $GLOBALS['dataLayer']->getApplicants();
        $this->_f3->set('applicants', $applicants);

        $view = new Template();
        echo $view->render('views/administration.html');
    }
}
