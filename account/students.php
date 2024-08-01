<?php
require_once('../Global/config.php');

$section = base64_decode($_GET['section']);
$section_uncode = $_GET['section'];
$className = $_GET['class_name'];
$className_encoded = base64_decode($className);

include '../initilizers/init_students.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="globalfunction.js" defer></script>

    <style>

.table-container {
            overflow-x: auto;
            margin: 20px 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 18px;
            text-align: left;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #512da8;
            color: #ffffff;
        }

        th, td {
            padding: 12px 25px; 
        }

        tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        tbody tr:last-of-type {
            border-bottom: 2px solid #512da8;
        }

        tbody tr.active-row {
            font-weight: bold;
            color: #512da8;
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between; 
            padding: 20px;
            background-color: #f4f4f9;
        }

        .header-container h2 {
            margin: 0; 
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #512da8;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .header-container button:hover {
            background-color: #3f2b7e;
        }
       
.modal {
    display: none; 
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%;
    overflow: auto;
    height: 100%; 
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 4% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 80%; 
    max-width: 600px; 
    border-radius: 8px; 
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.form-group {
            display: flex;
            align-items: center;
            margin-bottom: 1em;
        }
        .form-group label {
            margin-right: 1em;
        }
        .form-group input {
            flex: 1;
            padding: 0.5em;
        }
        .form-group .input-group {
            display: flex;
            gap: 1em;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 1em; 
        }

        #pagination-controls {
    text-align: center;
    margin-top: 20px;
}

#pagination-controls button {
    padding: 10px 15px;
    margin: 0 5px;
    border: none;
    background-color: #512da8;
    color: white;
    cursor: pointer;
}

#pagination-controls button.disabled {
    background-color: #cccccc;
    cursor: not-allowed;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: white;
    padding: 10px 20px;
    color: #512da8;
    height: 50px;
    font-weight: bold;
    box-shadow: 0 4px 8px rgba(81, 45, 168, 0.5);
}

.navbar-left .logo {
    height: 40px;
}

.navbar-right a, .navbar-right .username {
    color: #512da8;
    text-decoration: none;
    margin-left: 20px;
    font-weight: bold;
}

.navbar-right a:hover, .navbar-right .username:hover {
    text-decoration: underline;
}.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: white;
    padding: 10px 20px;
    color: #512da8;
    height: 50px;
    font-weight: bold;
    box-shadow: 0 4px 8px rgba(81, 45, 168, 0.5);
}

.navbar-left .logo {
    height: 40px;
}

.navbar-right a, .navbar-right .username {
    color: #512da8;
    text-decoration: none;
    margin-left: 20px;
    font-weight: bold;
}

.navbar-right a:hover, .navbar-right .username:hover {
    text-decoration: underline;
}


  

    </style>
</head>
<body >
<nav class="navbar">
        <div class="navbar-left">
            <img  alt="Logo" class="logo">
        </div>
        <div class="navbar-right">
            <a href="../account/classes.php">Classes</a>
            <a id="logout-link">Logout</a>
            <span class="username">Username</span>
        </div>
    </nav>    
    <div class="header-container">
        <h2>Student List</h2>
        <button id="openModalBtn">ADD</button>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Student Details</h2>
            <form>
        <div class="form-group">
            <label for="studentID">St Id:</label>
            <input type="text" id="studentId" name="studentId" value=" <?echo $students->stud?>">
            &nbsp; &nbsp; &nbsp; &nbsp;
            <label for="studentName">Name:</label>
            <input type="text" id="studentName" name="studentName" >
            <input type="text" id="mode" name="mode" value="" hidden>


        </div>
        
        <div class="form-group">
            <label for="studentClass">Class:</label>
            <input type="text" id="studentClass" name="studentClass" >
            &nbsp; &nbsp; &nbsp; &nbsp;
            <label for="section">Section:</label>
            <input type="text" id="section" name="section" value='<?php echo $section?>'>
        </div>
        <div class="form-group">
            <label for="studentClass">lang1:</label>
            <input type="text" id="lang1" name="lang1" oninput="calculateTotalMarks()">
            &nbsp; &nbsp; &nbsp; &nbsp;
            <label for="section">lang2:</label>
            <input type="text" id="lang2" name="lang2" oninput="calculateTotalMarks()">
        </div>
        <div class="form-group">
            <label for="studentClass">lang3:</label>
            <input type="text" id="lang3" name="lang3" oninput="calculateTotalMarks()">
            &nbsp; &nbsp; &nbsp; &nbsp;
            <label for="section">Maths:</label>
            <input type="text" id="maths" name="maths" oninput="calculateTotalMarks()">
        </div>
        <div class="form-group">
            <label for="studentClass">science</label>
            <input type="text" id="science" name="science" oninput="calculateTotalMarks()">
            &nbsp; &nbsp; &nbsp; &nbsp;
            <label for="section">social:</label>
            <input type="text" id="social" name="social" oninput="calculateTotalMarks()">
        </div>
        <div class="form-group">
            <label for="section">project :</label>
            <input type="text" id="project" name="project" oninput="calculateTotalMarks()">
            &nbsp; &nbsp; &nbsp; &nbsp;
            <label for="totalmarks">Total marks:</label>
            <input type="text" id="marks" name="marks">
           
        </div>
        <div class="button-container">
        <button onclick='saveStudent(event)'>SAVE</button>
    </div>

            </form>
        </div>
    </div>
    <div class="table-container">


    <table id='data-table'>
        <thead>
            <tr>
                <th></th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Class</th>
                <th>Section</th>
                <th>Language1</th>
                <th>Language2</th>
                <th>Language3</th>
                <th>Science</th>
                <th>Maths</th>
                <th>Social</th>
                <th>Project</th>
                <th>total Marks</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($get_student_details as $students ){

            $student_id = $students->student_id;
            $student_name = $students->student_name;
            $student_class = $students->student_class;
            $section = $students->section;
            $lang1 = $students->language_one;
            $lang2 = $students->language_two;
            $lang3 = $students->language_three;
            $science = $students->science;
            $maths = $students->maths;
            $social = $students->social;
            $project = $students->project_work;
            $total_marks = $students->total_marks;

            $studentData = [
                'student_id' => $student_id,
                'student_name' => $student_name,
                'student_class' => $student_class,
                'section' => $section,
                'lang1' => $lang1,
                'lang2' => $lang2,
                'lang3' => $lang3,
                'science' => $science,
                'maths' => $maths,
                'social' => $social,
                'project' => $project,
                'total_marks' => $total_marks
            ];
        
    $studentDataJson = htmlspecialchars(json_encode($studentData), ENT_QUOTES, 'UTF-8');


                echo "<tr>";
                echo '<td><button id="openEDITModalBtn" onclick=\'openEditModal(' . $studentDataJson . ')\'>EDIT</button></td>';
                echo "<td style='text-align:center;'>$student_id</td>";
                echo "<td style='text-align:center;'>$student_name</td>";
                echo "<td style='text-align:center;'>$student_class</td>";
                echo "<td style='text-align:center;'>$section</td>";
                echo "<td style='text-align:center;'>$lang1</td>";
                echo "<td style='text-align:center;'>$lang2</td>";
                echo "<td style='text-align:center;'>$lang3</td>";
                echo "<td style='text-align:center;'>$science</td>";
                echo "<td style='text-align:center;'>$maths</td>";
                echo "<td style='text-align:center;'>$social</td>";
                echo "<td style='text-align:center;'>$project</td>";
                echo "<td style='text-align:center;'>$total_marks</td>";
                echo "</tr>";
            } 
            

        
        ?>
            
        </tbody>
    </table>
    </div>
    <div id="pagination-controls">
    </div>


    <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("openModalBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                
                modal.style.display = "none";
            }
        }

      

      

    </script>
    <script >



function saveStudent(event) {
    event.preventDefault();

       var student_name = document.getElementById('studentName').value;
        var student_id = document.getElementById('studentId').value;
        var studentClass = document.getElementById('studentClass').value;
        var section = document.getElementById('section').value;
        var lang1 = document.getElementById('lang1').value;
        var lang2 = document.getElementById('lang2').value;
        var lang3 = document.getElementById('lang3').value;
        var maths = document.getElementById('maths').value;
        var science = document.getElementById('science').value;
        var social = document.getElementById('social').value;
        var project = document.getElementById('project').value;
        var totalmarks = document.getElementById('marks').value;
        var mode = document.getElementById('mode').value;

         if (mode === 'UPDATE') {
            mode = 'EDIT';
        } else {
          mode = 'INSERT';
        }


        
            $.ajax({
                url: '../controller/studentController.php',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    student_name: student_name,
                    student_id: student_id,
                    studentClass: studentClass,
                    section:section,
                    lang1:lang1,
                    lang2:lang2,
                    lang3:lang3,
                    maths:maths,
                    science:science,
                    social:social,
                    project:project,
                    totalMarks:totalmarks,
                    mode : mode
                }),

                success: function(response) {
        console.log('Response: ', response);
        if (response.result) {
             var className = "<?php echo htmlspecialchars($className, ENT_QUOTES, 'UTF-8'); ?>";
             var section = "<?php echo htmlspecialchars($section_uncode, ENT_QUOTES, 'UTF-8'); ?>";

             var url = "../account/students.php?class_name=" + encodeURIComponent(className) + "&section=" + encodeURIComponent(section);

             window.location.href = url;
        } else {
            alert('Invalid username or password.');
        }
    },
    error: function(xhr, status, error) {
        console.error('Error: ', error);
        alert('An error occurred. Please try again.');
    }
               
            });
    }
    


    function generateStudentId() {
    const randomNumber = Math.floor(1000 + Math.random() * 9000);
    const studentId = 'ST' + randomNumber;
    return studentId;
    
    }

    function displayStudentId() {
            const newStudentId = generateStudentId();
            document.getElementById('studentId').value = newStudentId;
        }

        window.onload = displayStudentId;


        function calculateTotalMarks() {
            var lang1 = parseFloat(document.getElementById('lang1').value) || 0;
            var lang2 = parseFloat(document.getElementById('lang2').value) || 0;
            var lang3 = parseFloat(document.getElementById('lang3').value) || 0;
            var maths = parseFloat(document.getElementById('maths').value) || 0;
            var science = parseFloat(document.getElementById('science').value) || 0;
            var social = parseFloat(document.getElementById('social').value) || 0;
            var project = parseFloat(document.getElementById('project').value) || 0;
            
            var totalMarks = lang1 + lang2 + lang3 + maths + science + social + project;
            
            document.getElementById('marks').value = totalMarks;
        }


        function openEditModal(studentData) {
    console.log("Student Data received:", studentData);

    document.getElementById('studentId').value = studentData.student_id;
    document.getElementById('studentName').value = studentData.student_name;
    document.getElementById('studentClass').value = studentData.student_class;
    document.getElementById('section').value = studentData.section;
    document.getElementById('lang1').value = studentData.lang1;
    document.getElementById('lang2').value = studentData.lang2;
    document.getElementById('lang3').value = studentData.lang3;
    document.getElementById('science').value = studentData.science;
    document.getElementById('maths').value = studentData.maths;
    document.getElementById('social').value = studentData.social;
    document.getElementById('project').value = studentData.project;
    document.getElementById('marks').value = studentData.total_marks;
    document.getElementById('mode').value = 'UPDATE';
    
    document.getElementById('myModal').style.display = 'block';

        }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }
    

    window.onclick = function(event) {
        const modal = document.getElementById('myModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    </script>
    <script>
  document.getElementById('logout-link').addEventListener('click', function(event) {
    event.preventDefault();
    
    if (confirm('Are you sure you want to log out?')) {
      var form = document.createElement('form');
      form.method = 'POST';
      form.action = '../account/Login.php'; 
      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'logout';
      form.appendChild(input);
      
      document.body.appendChild(form);
      form.submit();
    }
  });
</script>


   
   

</body>
</html>
