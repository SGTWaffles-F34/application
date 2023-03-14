<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/../PDOConfig.php');

class DataLayer{

    //Database connection object
    private $_dbh;

    public function __construct(){

        try{
            //instantiate a PDO object
            $this->_dbh = new PDO(DB_DRIVER, USERNAME, PASSWORD);
            //echo 'Successful!';
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function insertApplicant($applicantObj){

        //if applicant is a subcribed applicant $maillist = 1 else $maillist = 0
        //determine type of user
        if($applicantObj instanceof ApplicantSubscribed){
            $mailList = 1; //denotes a subscribed user
        }else{
            $mailList = 0; //denotes an unsubscribed user
        }

        //if user is unsubscribed
        if($mailList == 0) {
            //1. Define the Query
            //Insert for applicant
            $sql = "INSERT INTO `applicant` (fname, lname, email, state, phone, github, experience, relocate, bio, mailing_lists_signup) VALUES
        (:fname, :lname, :email, :state, :phone, :github, :experience, :relocate, :bio, :mailing_lists_signup)";
            //Insert for subscribedApplicant

            //2. Prepare the statement
            $statement = $this->_dbh->prepare($sql);

            //3. Bind the parameters
            $statement->bindParam(':fname', $applicantObj->getFname());
            $statement->bindParam(':lname', $applicantObj->getLname());
            $statement->bindParam(':email', $applicantObj->getEmail());
            $statement->bindParam(':state', $applicantObj->getState());
            $statement->bindParam(':phone', $applicantObj->getPhone());
            $statement->bindParam(':github', $applicantObj->getGhub());
            $statement->bindParam(':experience', $applicantObj->getExp());
            $statement->bindParam(':relocate', $applicantObj->getRelocate());
            $statement->bindParam(':bio', $applicantObj->getBio());
            $statement->bindParam(':mailing_lists_signup', $mailList);

            //4. Execute the query
            $statement->execute();

            //5. Process the results
            $id = $this->_dbh->lastInsertId();
        }

        //if the user is subscribed
        if($mailList == 1){
            //1. Define the Query
            //Insert for applicant
            $sql = "INSERT INTO `applicant` (fname, lname, email, state, phone, github, experience, relocate, bio, mailing_lists_signup, mailing_lists_subscriptions) VALUES
        (:fname, :lname, :email, :state, :phone, :github, :experience, :relocate, :bio, :mailing_lists_signup, :mailing_lists_subscriptions)";
            //Insert for subscribedApplicant

            //2. Prepare the statement
            $statement = $this->_dbh->prepare($sql);

            //3. Bind the parameters
            $statement->bindParam(':fname', $applicantObj->getFname());
            $statement->bindParam(':lname', $applicantObj->getLname());
            $statement->bindParam(':email', $applicantObj->getEmail());
            $statement->bindParam(':state', $applicantObj->getState());
            $statement->bindParam(':phone', $applicantObj->getPhone());
            $statement->bindParam(':github', $applicantObj->getGhub());
            $statement->bindParam(':experience', $applicantObj->getExp());
            $statement->bindParam(':relocate', $applicantObj->getRelocate());
            $statement->bindParam(':bio', $applicantObj->getBio());
            $statement->bindParam(':mailing_lists_signup', $mailList);
            $statement->bindParam(':mailing_lists_subscriptions', $applicantObj->getSubscriptions());

            //4. Execute the query
            $statement->execute();

            //5. Process the results
            $id = $this->_dbh->lastInsertId();
        }

        return $id;
    }

    function getApplicants(){
        echo 'getting applicants...';

        //1. Define the query
        $sql = "SELECT * FROM 'applicant'";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the query
        $statement->execute();

        //5. Process the results
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    function getApplicant($applicant_id){

    }

    function getSubscriptions($applicant_id){

    }

    static function yearsExp(){

        return Array('0-2', '2-4', '4+');
    }

    static function sDevJobs(){
        return Array('JavaScript', 'PHP', 'Java', 'Python', 'HTML', 'CSS', 'ReactJS', 'NodeJS');
    }

    static function indVerts(){
        return Array('Saas', 'Health Tech', 'Ag tech', 'HR Tech', 'Industrial Tech', 'Cybersecurity');
    }
}