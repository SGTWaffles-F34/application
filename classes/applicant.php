<?php

class Applicant{
    private $_fname;
    private $_lname;
    private $_state;
    private $_email;
    private $_phone;
    private $_ghub;
    private $_exp;
    private $_relocate;
    private $_bio;

    /**
     * @param $_fname
     * @param $_lname
     * @param $_state
     * @param $_email
     * @param $_phone
     * @param $_ghub
     * @param $_exp
     * @param $_relocate
     * @param $_bio
     */
    public function __construct($_fname="", $_lname="", $_state="", $_email="", $_phone="", $_ghub="", $_exp="", $_relocate="", $_bio="")
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_state = $_state;
        $this->_email = $_email;
        $this->_phone = $_phone;
        $this->_ghub = $_ghub;
        $this->_exp = $_exp;
        $this->_relocate = $_relocate;
        $this->_bio = $_bio;
    }

    /**
     * @return string
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param string $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return string
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param string $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return string
     */
    public function getGhub()
    {
        return $this->_ghub;
    }

    /**
     * @param string $ghub
     */
    public function setGhub($ghub)
    {
        $this->_ghub = $ghub;
    }

    /**
     * @return string
     */
    public function getExp()
    {
        return $this->_exp;
    }

    /**
     * @param string $exp
     */
    public function setExp($exp)
    {
        $this->_exp = $exp;
    }

    /**
     * @return string
     */
    public function getRelocate()
    {
        return $this->_relocate;
    }

    /**
     * @param string $relocate
     */
    public function setRelocate($relocate)
    {
        $this->_relocate = $relocate;
    }

    /**
     * @return string
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param string $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }



}