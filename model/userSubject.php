<?php
include "../model/users.php";
include "../model/subject.php";
class UserSubject
{
    private $id;
    private $users;
    private $subject;

    // Constructor
    public function __construct($username, $subjectId)
    {
        $this->users = new Users($username, null);
        $this->subject = new Subjects($subjectId, null);
    }

    // Getter for id
    public function getId()
    {
        return $this->id;
    }

    // Setter for id
    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter for users
    public function getusers()
    {
        return $this->users;
    }

    // Setter for users
    public function setusers($users)
    {
        $this->users = $users;
    }

    // Getter for subject
    public function getsubject()
    {
        return $this->subject;
    }

    // Setter for subject
    public function setsubject($subject)
    {
        $this->subject = $subject;
    }
}