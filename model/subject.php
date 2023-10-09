<?php
class Subjects
{
    private $subjectId;
    private $subjectName;

    // Constructor
    public function __construct($subjectId, $subjectName)
    {
        $this->subjectId = $subjectId;
        $this->subjectName = $subjectName;
    }

    // Getter for subjectId
    public function getSubjectId()
    {
        return $this->subjectId;
    }

    // Setter for subjectId
    public function setSubjectId($subjectId)
    {
        $this->subjectId = $subjectId;
    }

    // Getter for subjectName
    public function getSubjectName()
    {
        return $this->subjectName;
    }

    // Setter for subjectName
    public function setSubjectName($subjectName)
    {
        $this->subjectName = $subjectName;
    }
}