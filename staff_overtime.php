<?php
include 'Db.php';
if (!$conn) {
    die("ERROR IN CONNECTING TO DB: " . mysqli_connect_error());
}

mysqli_select_db($conn, $dbname);

// Create attendance and overtime table if it doesn't exist
$sql_create_attendance_overtime = "CREATE TABLE IF NOT EXISTS attendance_overtime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id VARCHAR(50),
    work_schedule VARCHAR(100),
    attendance_record TEXT,
    leave_record TEXT,
    overtime_hours INT,
    overtime_date DATE,
    FOREIGN KEY (employee_id) REFERENCES staff_details(employee_id)
)";
if ($conn->query($sql_create_attendance_overtime) !== TRUE) {
    echo "Error creating table: " . $conn->error;
}

$authenticated = false;

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $employee_id = $_POST['employee_id'];
    $employee_phone = $_POST['employee_phone']; // Changed to phone number

    // Authenticate using employee ID and phone number
    $sql_auth = "SELECT * FROM staff_details WHERE employee_id='$employee_id' AND phone='$employee_phone'";
    $auth_result = $conn->query($sql_auth);

    if ($auth_result->num_rows > 0) {
        $authenticated = true;
    } else {
        echo "<p style='color: red;'>Invalid Employee ID or Phone Number.</p>";
    }
}

// If authenticated, fetch attendance and overtime records
if ($authenticated) {
    $sql_fetch_records = "SELECT * FROM attendance_overtime WHERE employee_id='$employee_id'";
    $result = $conn->query($sql_fetch_records);
}
?>
<html>
<head>
    <title>Attendance & Overtime Tracking</title>
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
        form, table {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 800px;
            width: 100%;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<h2>Employee Authentication</h2>
<form method="POST" action="">
    <label for="employee_id">Employee ID:</label>
    <input type="text" id="employee_id" name="employee_id" required><br>

    <label for="employee_phone">Phone Number:</label>
    <input type="tel" id="employee_phone" name="employee_phone" required><br>

    <input type="submit" name="submit" value="Submit">
</form>

<?php if ($authenticated): ?>
    <h2>Attendance Records for Employee ID: <?php echo htmlspecialchars($employee_id); ?></h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee ID</th>
                <th>Work Schedule</th>
                <th>Attendance Record</th>
                <th>Leave Record</th>
                <th>Overtime Hours</th>
                <th>Overtime Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['employee_id']}</td>
                    <td>{$row['work_schedule']}</td>
                    <td>{$row['attendance_record']}</td>
                    <td>{$row['leave_record']}</td>
                    <td>{$row['overtime_hours']}</td>
                    <td>{$row['overtime_date']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No records found.</td></tr>";
        }
        ?>
        </tbody>
    </table>
<?php endif; ?>

<?php
$conn->close();
?>
</body>
</html>
