<?php
class SubjectDataValidation
{
    public static function isSubjectExists($subjectNameExists)
    {
        if ($subjectNameExists)
            return "subject already exists";
        return false;
    }
    public static function isNotEmpty($data)
    {
        return !empty($data);
    }
}