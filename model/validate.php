<?php

class Validate{

    //Return true if name contains at least 2 characters and no numbers
    function validFname(string $fname){


        if(strlen($fname >= 2) && preg_match('~[0-9]+~', $fname)){
            return true;
        }

        return false;
    }

    //Return true if name contains at least 2 characters and no numbers
    function validLname($lname){

    }
}