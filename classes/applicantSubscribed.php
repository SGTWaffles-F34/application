<?php

Class ApplicantSubscribed extends Applicant{

    private $_selectionJobs;
    private $_selectionVerticals;

    /**
     * @param $_selectionJobs
     * @param $_selectionVerticals
     */
    public function __construct($_selectionJobs="", $_selectionVerticals="")
    {
        parent::__construct();

        $this->_selectionJobs = $_selectionJobs;
        $this->_selectionVerticals = $_selectionVerticals;
    }

    /**
     * @return string
     */
    public function getSelectionJobs()
    {
        return $this->_selectionJobs;
    }

    /**
     * @param mixed|string $selectionJobs
     */
    public function setSelectionJobs($selectionJobs)
    {
        $this->_selectionJobs = $selectionJobs;
    }

    /**
     * @return string
     */
    public function getSelectionVerticals()
    {
        return $this->_selectionVerticals;
    }

    /**
     * @param string $selectionVerticals
     */
    public function setSelectionVerticals($selectionVerticals)
    {
        $this->_selectionVerticals = $selectionVerticals;
    }

    public function getSubscriptions(){
        return $this->getSelectionJobs() . ', ' . $this->getSelectionVerticals();
    }

}