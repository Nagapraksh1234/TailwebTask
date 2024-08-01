<?php
require_once('../Global/config.php');

class studentDetail {

        public $id;
        public $student_id;	
        public $student_name;		
        public $language_one;		
        public $language_two;		
        public $language_three;	
        public $maths;		
        public $science;		
        public $social;
        public $project_work;			
        public $record_created_on;
    
        // Getter and Setter for $id
        public function getId() {
            return $this->id;
        }
    
        public function setId($id) {
            $this->id = $id;
        }
    
        // Getter and Setter for $student_id
        public function getStudentId() {
            return $this->student_id;
        }
    
        public function setStudentId($student_id) {
            $this->student_id = $student_id;
        }
    
        // Getter and Setter for $student_name
        public function getStudentName() {
            return $this->student_name;
        }
    
        public function setStudentName($student_name) {
            $this->student_name = $student_name;
        }
    
        // Getter and Setter for $language_one
        public function getLanguageOne() {
            return $this->language_one;
        }
    
        public function setLanguageOne($language_one) {
            $this->language_one = $language_one;
        }
    
        // Getter and Setter for $language_two
        public function getLanguageTwo() {
            return $this->language_two;
        }
    
        public function setLanguageTwo($language_two) {
            $this->language_two = $language_two;
        }
    
        // Getter and Setter for $language_three
        public function getLanguageThree() {
            return $this->language_three;
        }
    
        public function setLanguageThree($language_three) {
            $this->language_three = $language_three;
        }
    
        // Getter and Setter for $maths
        public function getMaths() {
            return $this->maths;
        }
    
        public function setMaths($maths) {
            $this->maths = $maths;
        }
    
        // Getter and Setter for $science
        public function getScience() {
            return $this->science;
        }
    
        public function setScience($science) {
            $this->science = $science;
        }
    
        // Getter and Setter for $social
        public function getSocial() {
            return $this->social;
        }
    
        public function setSocial($social) {
            $this->social = $social;
        }
    
        // Getter and Setter for $project_work
        public function getProjectWork() {
            return $this->project_work;
        }
    
        public function setProjectWork($project_work) {
            $this->project_work = $project_work;
        }
    
        // Getter and Setter for $record_created_on
        public function getRecordCreatedOn() {
            return $this->record_created_on;
        }
    
        public function setRecordCreatedOn($record_created_on) {
            $this->record_created_on = $record_created_on;
        }


        public function initObject($results,$studentDetail){

            $studentDetail->id = $results['id'];
            $studentDetail->student_id = $results['student_id'];
            $studentDetail->student_name = $results['student_name'];
            $studentDetail->language_one = $results['language_one'];
            $studentDetail->language_two = $results['language_two'];
            $studentDetail->language_three = $results['language_three'];
            $studentDetail->maths = $results['maths'];
            $studentDetail->science = $results['science'];
            $studentDetail->social = $results['social'];
            $studentDetail->project_work = $results['project_work'];
            $studentDetail->record_created_on = $results['record_created_on'];     
            
            return $studentDetail;

        }


        public function insertStudentDetail($studentDetail) {
            $db = pdoConnect();
    
            $sql_insert = "INSERT INTO tw_students_detail (
                              id,
                              student_id,
                              student_name,
                              language_one,
                              language_two,
                              language_three,
                              maths,
                              science,
                              social,
                              project_work,
                              record_created_on
                          ) VALUES (
                              :id,
                              :student_id,
                              :student_name,
                              :language_one,
                              :language_two,
                              :language_three,
                              :maths,
                              :science,
                              :social,
                              :project_work,
                              UTC_TIMESTAMP()
                          )";
    
            try {
                $stmt = $db->prepare($sql_insert);
    
                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':student_id', $this->student_id);
                $stmt->bindParam(':student_name', $this->student_name);
                $stmt->bindParam(':language_one', $this->language_one);
                $stmt->bindParam(':language_two', $this->language_two);
                $stmt->bindParam(':language_three', $this->language_three);
                $stmt->bindParam(':maths', $this->maths);
                $stmt->bindParam(':science', $this->science);
                $stmt->bindParam(':social', $this->social);
                $stmt->bindParam(':project_work', $this->project_work);
    
                $stmt->execute();

                    return 'SUCCESS';
                    echo'SUCCESS';
              
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    
        }    


        public function getStudentHeaderDetails($section,$className){

            $db = pdoConnect();

            $sql = "SELECT 
                          a.*,
                          b.* 
                    FROM  
                          tw_students_detail a ,
                          tw_students_header b
                    WHERE 
                          a.student_id = b.student_id 
                    AND b.section  = '$section'
                    AND b.student_class = '$className';
                   ";


            $stmt = $db->prepare($sql);
            $stmt->execute();
            $details = $stmt->fetchAll(PDO::FETCH_OBJ); 


            return $details;

        }

        public function updateStudentDetail($studentDetail) {
            $db = pdoConnect();
        
            $sql_update = "UPDATE tw_students_detail
                           SET student_name = :student_name,
                               language_one = :language_one,
                               language_two = :language_two,
                               language_three = :language_three,
                               maths = :maths,
                               science = :science,
                               social = :social,
                               project_work = :project_work
                           WHERE student_id = :student_id";
        
            try {
                $stmt = $db->prepare($sql_update);
        
                $stmt->bindParam(':student_id', $this->student_id);
                $stmt->bindParam(':student_name', $this->student_name);
                $stmt->bindParam(':language_one', $this->language_one);
                $stmt->bindParam(':language_two', $this->language_two);
                $stmt->bindParam(':language_three', $this->language_three);
                $stmt->bindParam(':maths', $this->maths);
                $stmt->bindParam(':science', $this->science);
                $stmt->bindParam(':social', $this->social);
                $stmt->bindParam(':project_work', $this->project_work);
        
                $stmt->execute();
        
                return 'SUCCESS';
        
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
        }
        
    
}








?>
