<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../Global/config.php');
require_once('../models/studentHeader.php');
require_once('../models/studentDetail.php');

header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$student_name = $data['student_name'];
$student_id = $data['student_id'];
$student_class = $data['studentClass'];
$section = $data['section'];
$lang1 = $data['lang1'];
$lang2 =  $data['lang2'];
$lang3 = $data['lang3'];
$maths = $data['maths'];
$science = $data['science'];
$social = $data['social'];
$project = $data['project'];
$total_marks = $data['totalMarks'];
$mode = $data['mode'] ;

$studentObj = new StudentHeader();
$detailObj = new studentDetail();

$studentObj->student_name = $student_name;
$studentObj->student_id = $student_id;
$studentObj->student_class = $student_class;
$studentObj->section = $section;
$studentObj->total_marks = $total_marks;

$detailObj->student_id = $student_id;
$detailObj->student_name = $student_name;
$detailObj->language_one = $lang1;
$detailObj->language_two = $lang2;
$detailObj->language_three = $lang3;
$detailObj->maths = $maths;
$detailObj->science = $science;
$detailObj->social = $social;
$detailObj->project_work = $project;

$response = array(
    'result' => false,
    'response' => 'invalid mode',
    'responseText' => 'Invalid operation mode specified.',
);

if ($mode === 'INSERT') {
    $response = $studentObj->insertStudentHeader($studentObj);
    $detailResponse = $detailObj->insertStudentDetail($detailObj);

    if ($response === 'SUCCESS' && $detailResponse === 'SUCCESS') {
        $response = array(
            'result' => true,
            'response' => 'success',
            'responseText' => 'Student inserted successfully.',
        );
    } else {
        $response = array(
            'result' => false,
            'response' => 'failed',
            'responseText' => 'Insertion failed. Please try again.',
        );
    }
}elseif($mode === 'EDIT'){

    $response = $studentObj->updateStudentHeader($studentObj);
    $detailResponse = $detailObj->updateStudentDetail($detailObj);

    if ($response === 'SUCCESS' && $detailResponse === 'SUCCESS') {
        $response = array(
            'result' => true,
            'response' => 'success',
            'responseText' => 'Student UPDTED successfully.',
        );
    } else {
        $response = array(
            'result' => false,
            'response' => 'failed',
            'responseText' => 'update failed. Please try again.',
        );
    }

}

echo json_encode($response);
?>
