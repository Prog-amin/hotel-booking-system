<?php
include 'Db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

mysqli_select_db($conn, $dbname);
$sql_create_staff_details = "CREATE TABLE IF NOT EXISTS staff_details (
 id INT AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(100),
 employee_id VARCHAR(50) UNIQUE,
 dob DATE,
 address VARCHAR(255),
 phone VARCHAR(50),
 emergency_contact VARCHAR(100),
 job_title VARCHAR(100),
 department VARCHAR(100),
 supervisor VARCHAR(100),
 hire_date DATE,
 shift_details VARCHAR(100),
 salary DECIMAL(10,2),
 education VARCHAR(255),
 certifications VARCHAR(255),
 skills VARCHAR(255),
 languages_spoken VARCHAR(255))";
if ($conn->query($sql_create_staff_details) === TRUE) {
 echo "Staff details table created or already exists.<br>";
} else {
 echo "Error creating table: " . $conn->error;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_staff'])) {
 $full_name = $_POST['full_name'];
 $employee_id = $_POST['employee_id'];
 $dob = $_POST['dob'];
 $address = $_POST['address'];
 $phone = $_POST['phone'];
 $emergency_contact = $_POST['emergency_contact'];
 $job_title = $_POST['job_title'];
 $department = $_POST['department'];
 $supervisor = $_POST['supervisor'];
 $hire_date = $_POST['hire_date'];
 $shift_details = $_POST['shift_details'];
 $salary = $_POST['salary'];
 $education = $_POST['education'];
 $certifications = $_POST['certifications'];
 $skills = $_POST['skills'];
 $languages_spoken = $_POST['languages_spoken'];
 $sql = "INSERT INTO staff_details (full_name, employee_id, dob, address, phone, emergency_contact, job_title, department, supervisor, hire_date, shift_details, salary, education, certifications, skills, languages_spoken) VALUES ('$full_name', '$employee_id', '$dob', '$address', '$phone', '$emergency_contact', '$job_title', '$department', '$supervisor', '$hire_date', '$shift_details', '$salary', '$education', '$certifications', '$skills', '$languages_spoken')";
 if ($conn->query($sql) === TRUE) {
  echo "New staff member added successfully.<br>";
 } else {
  echo "Error: " . $conn->error . "<br>";
 }
}
?>
<html>
<head>
 <title>Staff Admission Form</title>
</head>
<style>
body {
 font-family: Arial, sans-serif;
 margin: 0;
 padding: 20px;
 background-color: #f4f4f4;
}
h2 {
 color: #333;
}
form {
 background-color: #fff;
 padding: 20px;
 border-radius: 5px;
 box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
 max-width: 600px;
 margin: 0 auto;
}
label {
 display: block;
 margin-bottom: 8px;
 font-weight: bold;
}
input[type="text"],
input[type="date"],
input[type="number"] {
 width: 100%;
 padding: 10px;
 margin-bottom: 15px;
 border: 1px solid #ccc;
 border-radius: 4px;
 box-sizing: border-box;
}
input[type="submit"] {
 background-color: #28a745;
 color: white;
 border: none;
 padding: 10px 15px;
 border-radius: 4px;
 cursor: pointer;
 font-size: 16px;
}
input[type="submit"]:hover {
 background-color: #218838;
}
h3 {
 margin-top: 20px;
 color: #555;
}
 input[type="submit"] {
  width: 100%;
 }
}

</style>
<body>

<h2>Staff Admission Form</h2>
<form method="POST" action="">
 <h3>Personal Information</h3>
 <label for="full_name">Full Name:</label>
 <input type="text" id="full_name" name="full_name" required><br>
 <label for="employee_id">Employee ID:</label>
 <input type="text" id="employee_id" name="employee_id" required><br>
 <label for="dob">Date of Birth:</label>
 <input type="date" id="dob" name="dob" required><br>
 <label for="address">Address:</label>
 <input type="text" id="address" name="address" required><br>
 <label for="phone">Phone Number:</label>
 <input type="text" id="phone" name="phone" required><br>
 <label for="emergency_contact">Emergency Contact:</label>
 <input type="text" id="emergency_contact" name="emergency_contact" required><br>
 
 <h3>Job Details</h3>
 <label for="job_title">Job Title:</label>
 <input type="text" id="job_title" name="job_title" required><br>
 <label for="department">Department:</label>
 <input type="text" id="department" name="department" required><br>
 <label for="supervisor">Supervisor:</label>
 <input type="text" id="supervisor" name="supervisor" required><br>
 <label for="hire_date">Date of Hire:</label>
 <input type="date" id="hire_date" name="hire_date" required><br>
 <label for="shift_details">Shift Details:</label>
 <input type="text" id="shift_details" name="shift_details" required><br>
 <label for="salary">Salary/Hourly Rate:</label>
 <input type="text" id="salary" name="salary" required><br>

 <h3>Skills & Qualifications</h3>
 <label for="education">Educational Background:</label>
 <input type="text" id="education" name="education" required><br>
 <label for="certifications">Certifications/Licenses:</label>
 <input type="text" id="certifications" name="certifications"><br>
 <label for="skills">Skills:</label>
 <input type="text" id="skills" name="skills"><br>
 <label for="languages">Languages Spoken:</label>
 <input type="text" id="languages" name="languages_spoken"><br>

 <input type="submit" name="add_staff" value="Submit">
</form>

<?php
$conn->close();
?>
</body>
</html>
