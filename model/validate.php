<?php

class  Validate {

    //validate name data
    static function validName(string $name){

        //if name contains 2 or more characters and is alphabetical
        if(strlen($name) >= 2 && ctype_alpha($name)){
            return true;
        }

        //else return false, data is invalid
        return false;
    }

//validate email data
    static function validEmail(string $email){

        //if email is contains at least 2 chars, an @ and a .com
        //can't use str_contains() function because our server runs php 7.0.33, str_contains was introduced in php 8 :(
        if(strlen($email) >= 2 && (strpos($email, '@') !== false) && (strpos($email, '.com') !== false)){
            return true;
        }

        return false;
    }

//validates phone number data
    static function validPhone(string $phone){

        //if phone contains no letters, minimum 10 characters, maximum 11 characters
        if(ctype_digit($phone) && strlen($phone) >=10 && strlen($phone) <= 11){
            return true;
        }

        return false;
    }

    static function validGithub($ghub){

        //if text includes "https://github.com/' and more than 19 characters
        if((strpos($ghub, 'https://github.com/') !== false) && strlen($ghub) > 19){
            return true;
        }

        return false;
    }

    static function validExperience($yrexp){

        //if yrexp == one of the possible values and nothing else
        if($yrexp == '0-2' || $yrexp == '2-4' || $yrexp == '4+'){
            return true;
        }

        return false;
    }

    static function validSelectionsJobs($jobOptions){

        $jobs = Datalayer::sDevJobs();

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

    static function validSelectionsVerticals($vertOptions){

        $verts = Datalayer::indVerts();

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
}