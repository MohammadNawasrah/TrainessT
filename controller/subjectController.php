<?php
include "../service/subjectService.php";
class SubjectController
{
    private $subjectService;
    public function __construct()
    {
        $this->subjectService = new SubjectService();
    }
    public function addSubject()
    {
        echo $this->subjectService->addSubject(strtolower("C++"));
    }
    public function getAllSubjects()
    {
        echo json_encode($this->subjectService->getAllSubjects());
    }
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $admin = new SubjectController();
    $admin->addSubject();
}