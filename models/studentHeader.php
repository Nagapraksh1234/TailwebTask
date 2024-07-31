<?php
require_once('../Global/config.php');

class StudentHeader {
    public $id;
    public $student_id;
    public $student_name;
    public $student_class;
    public $section;

    public $total_marks;
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getStudentId() {
        return $this->student_id;
    }

    public function setStudentId($student_id) {
        $this->student_id = $student_id;
    }

    public function getStudentName() {
        return $this->student_name;
    }

    public function setStudentName($student_name) {
        $this->student_name = $student_name;
    }

    public function getStudentClass() {
        return $this->student_class;
    }

    public function setStudentClass($student_class) {
        $this->student_class = $student_class;
    }

    public function getSection() {
        return $this->section;
    }

    public function setSection($section) {
        $this->section = $section;
    }

    public function getTotalMarks() {
        return $this->total_marks;
    }

    public function setTotalMarks($total_marks) {
        $this->total_marks = $total_marks;
    }




    public function initObject($results,$studentHeader){

        $studentHeader->id = $results['id'];
        $studentHeader->student_id = $results['student_id'];
        $studentHeader->student_name = $results['student_name'];
        $studentHeader->student_class = $results['student_class'];
        $studentHeader->section = $results['section'];
        $studentHeader->total_marks = $results['total_marks'];
        return $studentHeader;
    }

    public function getStudentDetails() {
        $db = pdoConnect();
        $sql = "SELECT * FROM tw_students_header";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $students = $stmt->fetchAll(PDO::FETCH_OBJ); 
        return $students;
    }
    
    public function insertStudentHeader($studentHeader) {
        $db = pdoConnect();
    
        $sql_insert = "INSERT INTO 
                                    tw_students_header
                                     (student_id, student_name, student_class,section,total_marks)
                         VALUES      (:student_id, :student_name, :student_class,:section,:total_marks)
                       ";
    
        try {
            $stmt = $db->prepare($sql_insert);
    
            $stmt->bindParam(':student_id', $this->student_id);
            $stmt->bindParam(':student_name', $this->student_name);
            $stmt->bindParam(':student_class', $this->student_class);
            $stmt->bindParam(':section', $this->section);
            $stmt->bindPARAM(':total_marks',$this->total_marks);


    
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: Unable to execute the statement";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return 'SUCCESS';
    
    }
    




    
}




?>