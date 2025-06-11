<?php
include 'Db.php';
if (!$conn) {
    die("ERROR IN CREATING DB: " . mysqli_connect_error($conn));
} else {
    echo "Connected to DB successfully.<br>";
}
mysqli_select_db($conn, $dbname);

// Create the availablerooms table if it does not exist
$sql_create_rooms_table = "
CREATE TABLE IF NOT EXISTS availablerooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_type VARCHAR(50),
    status ENUM('Available', 'Booked') DEFAULT 'Available',
    price DECIMAL(10, 2),
    capacity INT
)";

// Execute the SQL query
if (mysqli_query($conn, $sql_create_rooms_table)) {
    echo "Table 'availablerooms' created successfully.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}

// Handle form submission for room booking/cancel
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];
    $action = $_POST['action'];
    if ($action == 'Book') {
        $sql = "UPDATE availablerooms SET status='Booked' WHERE id='$room_id'";
    } elseif ($action == 'Cancel') {
        $sql = "UPDATE availablerooms SET status='Available' WHERE id='$room_id'";
    }
    
    if ($conn->query($sql) === TRUE) {
        echo "Room status updated successfully!<br>";
    } else {
        echo "Error updating record: " . $conn->error . "<br>";
    }
}

// Fetch room data
$sql = "SELECT * FROM availablerooms";
$result = $conn->query($sql);
?>
<html>
<head>
<title>Hotel Room Management</title>
<style>
table {
    width: 80%;
    margin: auto;
    border-collapse: collapse;
}
table, th, td {
    border: 1px solid black;
}
th, td {
    padding: 10px;
    text-align: center;
}
* {
    margin: 2px;
    border: 2px double ghostwhite;
    background: BurlyWood;
    color: brown;
}
.preferoom {
    display: flex;
    flex-direction:row;
    justify-content: center;
    background: black;
    color: BurlyWood;
    text-decoration: none;
    padding: 10px 20px;
    border: 2px solid BurlyWood;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.preferoom:hover {
    background: BurlyWood;
    color: black;
}

</style>
</head>
<body>
<h2 style="text-align: center">Hotel Room Management</h2>
<table>
<thead>
<tr>
    <th>Room Number</th>
    <th>Type</th>
    <th>Status</th>
    <th>Price (per night)</th>
    <th>Action</th>
</tr>
</thead>
<tbody>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>"; // Using id as Room Number
        echo "<td>" . htmlspecialchars($row["room_type"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
        echo "<td>$" . htmlspecialchars($row["price"]) . "</td>";
        echo "<td>";
        echo "<form method='POST' action='hotel.php'>";
        echo "<input type='hidden' name='room_id' value='" . htmlspecialchars($row['id']) . "'>";
        if ($row["status"] == 'Available') {
            echo "<input type='submit' name='action' value='Book'>";
        } else {
            echo "<input type='submit' name='action' value='Cancel'>";
        }
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No rooms available</td></tr>";
}
?>
</tbody>
</table>
<div >
    <!-- <input type="button" class="preferoom" value="Prefer your room" onclick="window.location.href='room_pref.php'"> -->


</div>
<?php
$conn->close();
?>
</body>
</html>
