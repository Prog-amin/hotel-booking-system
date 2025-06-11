<?php
include "Db.php";

mysqli_select_db($conn, $dbname);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql_create_rooms_table = "CREATE TABLE IF NOT EXISTS customers (
    FullName VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Phone VARCHAR(15),
    Address VARCHAR(255)
)";

// Execute the SQL query
if (mysqli_query($conn, $sql_create_rooms_table)) {
    echo "Table created successfully.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

$fullname = '';
$email = '';
$phone = '';
$address = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["fullname"]))) {
        $error_message .= "Full Name is required.<br>";
    } else {
        $fullname = mysqli_real_escape_string($conn, trim($_POST["fullname"]));
    }
    
    if (empty(trim($_POST["email"]))) {
        $error_message .= "Email ID is required.<br>";
    } else {
        $email = mysqli_real_escape_string($conn, trim($_POST["email"]));
    }
    
    if (empty(trim($_POST["phone"]))) {
        $error_message .= "Phone Number is required.<br>";
    } else {
        $phone = mysqli_real_escape_string($conn, trim($_POST["phone"]));
    }
    
    if (!empty(trim($_POST["address"]))) {
        $address = mysqli_real_escape_string($conn, trim($_POST["address"]));
    }

    // Check for errors before running the query
    if (empty($error_message)) {
        $sql = "INSERT INTO customers (FullName, Email, Phone, Address) VALUES ('$fullname', '$email', '$phone', '$address')";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: login.php"); // Redirect to booking page
            exit;
        } else {
            $error_message .= "ERROR: Could not execute $sql. " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
<html>
<head>
 <title>Customer Signup</title>
 <style>
 fieldset {
 background-color: lavender;
 width: 400px;
 margin-top: 80px;
 padding: 20px;
 }
 input, textarea {
 background-color: cadetblue;
 color: darkblue;
 height: 30px;
 width: 100%;
 margin-bottom: 10px;
 }
 .sub, .clr {
 color: white;
 background-color: darkblue;
 height: 30px;
 width: 100%;
 }
 .message {
 color: red;
 text-align: center;
 }
 </style>
</head>
<body>
<center>
 <fieldset>
 <legend><b style="font-size:25px;color:blue">Customer Signup</b></legend>
 <form action="signup.php" method="POST" enctype="multipart/form-data"> <!-- Change action to current script and added enctype -->
 <label for="fullname">Full Name*</label>
 <input type="text" name="fullname" id="fullname" required>
 <label for="email">Email ID*</label>
 <input type="email" name="email" id="email" required>
 <label for="phone">Phone Number*</label>
 <input type="tel" name="phone" id="phone" required>
 <label for="address">Address</label>
 <textarea maxlength="100" name="address" id="address"></textarea>
 <label for="profile_photo">Profile Photo</label>
 <input type="file" name="profile_photo" id="profile_photo" accept="image/*">
 <div class="message">
 <?php if (!empty($error_message)) echo htmlspecialchars($error_message); ?>
 </div>
 <input type="reset" value="Clear" class="clr">
 <input type="submit" value="Register" name="register" class="sub">
 </form>
 <h3><a href="login.php">Already have an account? Login</a></h3>
 </fieldset>
</center>
</body>
</html>
