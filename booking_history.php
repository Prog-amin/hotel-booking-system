<?php
include 'Db.php';

if ($conn === false) {
    die("ERROR IN CREATING DB: " . mysqli_connect_error($conn));
}

// Select the database
mysqli_select_db($conn, $dbname);

// Adjust the SELECT statement to fetch all necessary fields
$select = "SELECT * FROM hotel_bookings"; // Corrected SQL statement
$result = mysqli_query($conn, $select);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management Board</title>
    <style>
 * {
    margin: 0.125rem; /* 2px */
    border: 0.125rem double ghostwhite; /* 2px */
}

h2, a {
    border: none;
}

.date {
    background: cadetblue;
    border-right: 0.125rem dotted black; /* 2px */
    border-left: 0.125rem dotted black; /* 2px */
    border-bottom: none;
    border-top: 0.125rem dotted black; /* 2px */
    width: 8.75rem; /* 140px */
    padding: 0.3125rem; /* 5px */
}

.day {
    background: cadetblue;
    border-right: 0.125rem dotted black; /* 2px */
    border-left: 0.125rem dotted black; /* 2px */
    border-bottom: 0.125rem dotted black; /* 2px */
    border-top: none;
    width: 8.75rem; /* 140px */
    padding: 0.3125rem; /* 5px */
}

th {
    text-align: center;
    padding: 0.3125rem; /* 5px */
    width: 34.375rem; /* 550px */
    height: 3.125rem; /* 50px */
    border-left: none;
    border-top: none;
    border-right: none;
    border-bottom: 0.125rem dotted black; /* 2px */
}

td {
    border-left: none;
    border-top: none;
    border-right: none;
    border-bottom: 0.125rem dotted black; /* 2px */
    padding: 0.1875rem; /* 3px */
    height: 1.875rem; /* 30px */
    text-align: center;
}

button {
    display: inline;
    height: 3.125rem; /* 50px */
}

/* Additional responsive adjustments */
@media (max-width: 768px) {
    .date, .day {
        width: 70%; /* Adjust to fit smaller screens */
    }

    th {
        width: 100%; /* Full width for table headers on small screens */
        height: auto; /* Adjust height */
    }

    td {
        height: auto; /* Adjust height for table data */
    }

    button {
        height: auto; /* Allow button to adjust height */
        width: 100%; /* Full width for buttons on small screens */
    }
}

    </style>
</head>
<body>

<h1>Customer Management Board</h1>
<h3 class="date">DATE:</h3><h3 class="day" id="date">/</h3>
<script>
const date = new Date();
document.getElementById("date").innerHTML = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
</script>

<form action="" method="POST">
    <table>
        <tr>
            <th colspan="15"><h2>Booking Details</h2></th>
        </tr>
        <tr>
            <th>S.NO</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>ADDRESS</th>
            <th>CHECK-IN DATE</th>
            <th>CHECK-OUT DATE</th>
            <th>ADULTS</th>
            <th>CHILDREN</th>
            <th>ROOM TYPE</th>
            <th>NUMBER OF ROOMS</th>
            <th>SPECIAL REQUESTS</th>
            <th>ARRIVAL TIME</th>
            <th>PAYMENT METHOD</th>
            <th>TOTAL AMOUNT</th>
        </tr>
        <?php
        if ($result) {
            $sno = 1; // Initialize serial number
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>" . $sno++ . "</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['phone']) . "</td>
                    <td>" . htmlspecialchars($row['address']) . "</td>
                    <td>" . htmlspecialchars($row['checkin']) . "</td>
                    <td>" . htmlspecialchars($row['checkout']) . "</td>
                    <td>" . htmlspecialchars($row['adults']) . "</td>
                    <td>" . htmlspecialchars($row['children']) . "</td>
                    <td>" . htmlspecialchars($row['roomtype']) . "</td>
                    <td>" . htmlspecialchars($row['rooms']) . "</td>
                    <td>" . htmlspecialchars($row['special_requests']) . "</td>
                    <td>" . htmlspecialchars($row['arrival_time']) . "</td>
                    <td>" . htmlspecialchars($row['payment_method']) . "</td>

                </tr>";
            }
        } else {
            echo "<tr><td colspan='15'>ERROR IN DISPLAYING RECORDS</td></tr>";
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
