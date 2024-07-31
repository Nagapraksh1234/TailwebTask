<?php
require_once('../Global/config.php');
require_once('../models/studentHeader.php');
require_once('../models/studentDetail.php');

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
error_log('Input: ' . print_r($input, true));


$student_name = $input['student_name'];
$student_id = $input['student_id'];
$student_class = $input['studentClass'];
$section = $input['section'];
$lang1 = $input['lang1'];
$lang2 =  $input['lang2'];
$lang3 = $input['lang3'];
$maths = $input['maths'];
$science = $input['science'];
$social = $input['social'];
$project = $input['project'];
$mode = $input['mode']??'INSERT';

$studentObj = new StudentHeader();
$detailObj = new studentDetail();

$studentObj->student_name = $student_name;
$studentObj->student_id = $student_id;
$studentObj->student_class = $student_class;
$studentObj->section = $section;

$detailObj->student_id = $student_id;
$detailObj->student_name = $student_name;
$detailObj->language_one = $lang1;
$detailObj->language_two = $lang2;
$detailObj->language_three = $lang3;
$detailObj->maths = $maths;
$detailObj->science = $science;
$detailObj->social = $social;
$detailObj->project_work = $project;




if($mode === 'INSERT'){

    $response = $studentObj->insertStudentHeader($studentObj);
    $detailResponse = $detailObj->insertStudentDetail($detailObj);

    if($detailResponse === 'SUCCESS'){
    APIResponseWithReturn(true,'success','','','');
    }else{
      APIResponseWithReturn(false,'fail','','','');
    }

}






?>