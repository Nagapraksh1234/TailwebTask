<?php

require_once('../Global/config.php');
require_once('../models/studentHeader.php');
require_once('../models/studentDetail.php');

$studentObject = new StudentHeader();
$studentDetailObj = new studentDetail();

$get_student_header = $studentObject->getStudentDetails();
$get_student_details = $studentDetailObj->getStudentHeaderDetails($section,$className);




?>