<?php
include "../service/userSubjectService.php";
class userSubjectController
{
    private $userSubjectService;
    public function __construct($username, $subjectName)
    {
        $this->userSubjectService = new UserSubjectService();
        $this->userSubjectService->setUserSubject($username, $this->userSubjectService->getSubjectIdFromName($subjectName));
    }

    public function setSubjectToUser()
    {
        $userName = $this->userSubjectService->getUerSubject()->getusers()->getUserName();
        $subjectName = $this->userSubjectService->getUerSubject()->getsubject()->getSubjectId();
        echo $this->userSubjectService->setSubjectToUser($userName, $subjectName);
    }
    public function getAllSubjects()
    {
        echo json_encode($this->userSubjectService->getAllSubjectsAndUser());
    }
    public function getAllSubjectsByUser()
    {
        echo json_encode($this->userSubjectService->getAllSubjectsByUser("mohammad"));
    }
    // public function deleteSubject()
    // {
    //     echo json_encode($this->subjectService->deleteSubject(1));
    // }
    // public function updateSubject()
    // {
    //     echo json_encode($this->subjectService->updateSubject(2, ["subjectName" => "helldo"]));
    // }
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $userSubjectController = new UserSubjectController("user18", "helldo");
    $userSubjectController->getAllSubjectsByUser();
}