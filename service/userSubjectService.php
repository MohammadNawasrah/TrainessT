<?php
include "../model/userSubject.php";
include "../data/database/crud.php";
class UserSubjectService
{
    private $tableName = "studentsubject";
    private $primaryColumnName = "id";
    private $crud;
    private $userSubject;

    public function __construct()
    {
        $this->crud = new Crud();

    }
    public function setUserSubject($userName, $subjectId)
    {
        $this->userSubject = new UserSubject($userName, $subjectId);
    }
    public function setSubjectToUser($userName, $subjectId)
    {
        $validation = $this->validation($userName, $subjectId);
        if (!is_bool($validation)) {
            return $validation;
        }
        return $this->crud->createRecord($this->tableName, ["userName" => $userName, "subjectId" => $subjectId]);
    }
    public function validation($userName, $subjectId)
    {
        if (!$this->crud->recordExists("users", "userName", $userName))
            return "username is not exists";
        if (!$this->crud->recordExists("subjects", "subjectId", $subjectId))
            return "subject is not exists";
        if ($this->chickUserIsNotAdmin($userName)) {
            return "cant add subject to admin";
        }
        if ($this->chickIfUserHaveSubject($userName, $subjectId))
            return "you cant add alerdy add subject to this username";
        return true;
    }
    public function getSubjectIdFromName($subjectName)
    {
        $respons = $this->crud->getAllDataByCondition("subjects", "subjectName", $subjectName);
        if (isset($respons)) {
            return $respons[0]["subjectId"];
        }
    }
    public function chickUserIsNotAdmin($userName)
    {
        $respons = $this->crud->getAllDataByCondition("users", "userName", $userName);
        if (isset($respons)) {
            return $respons[0]["isAdmin"];
        }
    }
    public function chickIfUserHaveSubject($userName, $subjectId)
    {
        $respons = $this->crud->getAllDataByCondition($this->tableName, "userName", $userName);
        foreach ($respons as $data) {
            if ($data['subjectId'] == $subjectId) {
                return true;
            }
        }
        return false;
    }

    public function getAllSubjectsAndUser()
    {
        $mainTable = 'studentsubject';
        $joinTables = [
            ['table' => 'users', 'on' => 'studentsubject.userName = users.userName'],
            ['table' => 'subjects', 'on' => 'studentsubject.subjectId = subjects.subjectId']
        ];
        return $this->crud->getDatabyJoin($mainTable, $joinTables);
    }
    public function getAllSubjectsByUser($username)
    {
        $mainTable = 'studentsubject';
        $joinTables = [
            ['table' => 'users', 'on' => 'studentsubject.userName = users.userName'],
            ['table' => 'subjects', 'on' => 'studentsubject.subjectId = subjects.subjectId']
        ];
        $condition = 'studentsubject.userName = "' . $username . '"';
        return $this->crud->getDatabyJoinWithCondition($this->tableName, $joinTables, $condition);
    }
    public function getUerSubject()
    {
        return $this->userSubject;
    }

}