<?php

/**
 * @author Luana
 */
class Insurance {

    private $id;
    private $classification;
    private $coverage;

    function __construct($id, $classification, $coverage) {
        $this->id = $id;
        $this->classification = $classification;
        $this->coverage = $coverage;
    }

    public function getId() {
        return $this->id;
    }

    public function geClassification() {
        return $this->classification;
    }

    public function getCoverage() {
        return $this->coverage;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setClassification($classification) {
        $this->classification = $classification;
    }

    public function setCoverage($coverage) {
        $this->coverage = $coverage;
    }

}
