<?php
include 'Db.php';
if ($conn === false) {
    die("ERROR IN CREATING DB: " . mysqli_connect_error($conn));
}

// Select the database
mysqli_select_db($conn, $dbname);

// Select statement to fetch all fields from the guest_preferences table
$select = "SELECT * FROM  guest_preferences";
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
            margin: 2px;
            border: 2px double ghostwhite;
        }
        h2, a {
            border: none;
        }
        .date {
            background: cadetblue;
            border: 2px dotted black;
            width: 140px;
            padding: 5px;
        }
        .day {
            background: cadetblue;
            border: 2px dotted black;
            width: 140px;
            padding: 5px;
        }
        th {
            text-align: center;
            padding: 5px;
            width: 200px;
            height: 50px;
            border-bottom: 2px dotted black;
        }
        td {
            border-bottom: 2px dotted black;
            padding: 3px;
            height: 30px;
            text-align: center;
        }
        button {
            display: inline;
            height: 50px;
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
        <tr><th colspan="7"><h2>Customer Preferences Details</h2></th></tr>
        <tr>
            <th>S.NO</th>
            <th>BED TYPE</th>
            <th>ROOM VIEW</th>
            <th>SMOKING PREFERENCE</th>
            <th>FLOOR PREFERENCE</th>
            <th>AIRPORT SHUTTLE</th>
            <th>BREAKFAST INCLUDED</th>
            <th>SPA SERVICES</th>
            <th>PARKING</th>
            <th>PET FRIENDLY</th>
            <th>COMMENTS</th>
        </tr>
        <?php
        if ($result) {
            $sno = 1; // Initialize serial number
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>" . $sno++ . "</td>
                    <td>" . htmlspecialchars($row['bed_type']) . "</td>
                    <td>" . htmlspecialchars($row['room_view']) . "</td>
                    <td>" . htmlspecialchars($row['smoking_preference']) . "</td>
                    <td>" . htmlspecialchars($row['floor_preference']) . "</td>
                    <td>" . ($row['airport_shuttle'] ? 'Yes' : 'No') . "</td>
                    <td>" . ($row['breakfast_included'] ? 'Yes' : 'No') . "</td>
                    <td>" . ($row['spa_services'] ? 'Yes' : 'No') . "</td>
                    <td>" . ($row['parking'] ? 'Yes' : 'No') . "</td>
                    <td>" . ($row['pet_friendly'] ? 'Yes' : 'No') . "</td>
                    <td>" . htmlspecialchars($row['comments']) . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='11'>ERROR IN DISPLAYING RECORDS</td></tr>";
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
