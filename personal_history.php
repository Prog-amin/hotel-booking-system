<?php
include 'Db.php';

if ($conn === false) {
    die("ERROR IN CREATING DB: " . mysqli_connect_error($conn));
}

mysqli_select_db($conn, $dbname);

// Adjust the SELECT statement to fetch all necessary fields
$select = "SELECT * FROM staff_details"; // Corrected SQL statement
$result = mysqli_query($conn, $select);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management Board</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        h1, h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Customer Management Board</h1>
<h3 class="date">DATE:</h3>
<h3 class="day" id="date">/</h3>
<script>
const date = new Date();
document.getElementById("date").innerHTML = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
</script>

<form action="" method="POST">
    <table>
        <tr>
            <th colspan="12"><h2>Staff Details</h2></th>
        </tr>
        <tr>
            <th>S.NO</th>
            <th>FULL NAME</th>
            <th>EMPLOYEE ID</th>
            <th>DOB</th>
            <th>ADDRESS</th>
            <th>PHONE</th>
            <th>EMERGENCY CONTACT</th>
            <th>JOB TITLE</th>
            <th>DEPARTMENT</th>
            <th>SUPERVISOR</th>
            <th>HIRE DATE</th>
            <th>SALARY</th>
        </tr>
        <?php
        if ($result) {
            $sno = 1; // Initialize serial number
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>" . $sno++ . "</td>
                    <td>" . htmlspecialchars($row['full_name']) . "</td>
                    <td>" . htmlspecialchars($row['employee_id']) . "</td>
                    <td>" . htmlspecialchars($row['dob']) . "</td>
                    <td>" . htmlspecialchars($row['address']) . "</td>
                    <td>" . htmlspecialchars($row['phone']) . "</td>
                    <td>" . htmlspecialchars($row['emergency_contact']) . "</td>
                    <td>" . htmlspecialchars($row['job_title']) . "</td>
                    <td>" . htmlspecialchars($row['department']) . "</td>
                    <td>" . htmlspecialchars($row['supervisor']) . "</td>
                    <td>" . htmlspecialchars($row['hire_date']) . "</td>
                    <td>" . htmlspecialchars($row['salary']) . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='12'>ERROR IN DISPLAYING RECORDS</td></tr>";
        }
        ?>
    </table>
</form>
<a href="customer_management.php"><button>BACK</button></a>

<?php
mysqli_close($conn);
?>
</body>
</html>
