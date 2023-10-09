<?php
include "../model/subject.php";
include "../data/database/crud.php";
include "../scripts/subjectDataValidation.php";
class SubjectService
{
    private $tableName = "subjects";
    private $primaryColumnName = "subjectId";
    private $crud;
    private $subjects;

    public function __construct()
    {
        $this->crud = new Crud();
    }
    public function addSubject($subjectName)
    {
        $isSubjectExists = $this->crud->recordExists($this->tableName, "subjectName", $subjectName);
        if (!is_bool(SubjectDataValidation::isSubjectExists($isSubjectExists)))
            return SubjectDataValidation::isSubjectExists($isSubjectExists);

        return $this->crud->createRecord($this->tableName, ["subjectName" => $subjectName]);
    }
    public function getAllSubjects()
    {
        $this->subjects = $this->crud->getAllData($this->tableName);
        return $this->subjects;
    }
    public function deleteSubject($id)
    {
        return $this->crud->delete($this->tableName, $this->primaryColumnName, $id);
    }
    public function updateSubject($id, $data)
    {
        return $this->crud->update($this->tableName, $this->primaryColumnName, $id, $data);
    }
}