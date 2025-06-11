<?php
include 'Db.php';
mysqli_select_db($conn, $dbname);

// Create guest_preferences table if not exists
$pref_Table = "CREATE TABLE IF NOT EXISTS guest_preferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bed_type VARCHAR(50) NOT NULL,
    room_view VARCHAR(50) NOT NULL,
    smoking_preference ENUM('smoking', 'non-smoking') NOT NULL,
    floor_preference ENUM('ground', 'high') NOT NULL,
    airport_shuttle TINYINT(1) DEFAULT 0,
    breakfast_included TINYINT(1) DEFAULT 0,
    spa_services TINYINT(1) DEFAULT 0,
    parking TINYINT(1) DEFAULT 0,
    pet_friendly TINYINT(1) DEFAULT 0,
    comments TEXT
)";
mysqli_query($conn, $pref_Table);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bed_type = $_POST['bed_type'];
    $room_view = $_POST['room_view'];
    $smoking_preference = $_POST['smoking_preference'];
    $floor_preference = $_POST['floor_preference'];
    
    // Check if checkboxes are set
    $airport_shuttle = isset($_POST['airport_shuttle']) ? 1 : 0;
    $breakfast_included = isset($_POST['breakfast_included']) ? 1 : 0;
    $spa_services = isset($_POST['spa_services']) ? 1 : 0;
    $parking = isset($_POST['parking']) ? 1 : 0;
    $pet_friendly = isset($_POST['pet_friendly']) ? 1 : 0;
    
    $comments = $_POST['comments'];
    
    // Prepare and execute SQL query
    $sql = "INSERT INTO guest_preferences (bed_type, room_view, smoking_preference, floor_preference, airport_shuttle, breakfast_included, spa_services, parking, pet_friendly, comments) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiiiiis", $bed_type, $room_view, $smoking_preference, $floor_preference, $airport_shuttle, $breakfast_included, $spa_services, $parking, $pet_friendly, $comments);
    
    if ($stmt->execute()) {
        echo "Preferences saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>

<html>
<head>
 <title>Guest Preferences Form</title>
 <style>
 body {
 font-family: Arial, sans-serif;
 margin: 0;
 padding: 20px;
 background-color: #f9f9f9;
 }
 h1 {
 color: #333;
 }
 form {
 background-color: #fff;
 padding: 20px;
 border-radius: 5px;
 box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
 }
 label {
 display: block;
 margin: 10px 0 5px;
 }
 select, input[type="checkbox"] {
 margin-bottom: 15px;
 }
 textarea {
 width: 100%;
 height: 80px;
 margin-bottom: 15px;
 }
 input[type="submit"] {
 background-color: #5cb85c;
 color: white;
 border: none;
 padding: 10px 15px;
 border-radius: 5px;
 cursor: pointer;
 }
 input[type="submit"]:hover {
 background-color: #4cae4c;
 }
 </style>
</head>
<body>
 <h1>Guest Preferences Form</h1>
 <form method="post" action="invoice2.php" onsubmit="return fun()">
 <label>Bed Type:</label>
 <select name="bed_type" required>
 <option value="king-size">King Size</option>
 <option value="twin">Twin</option>
 <option value="queen">Queen</option>
 </select>
 <label>Room View:</label>
 <select name="room_view" required>
 <option value="sea view">Sea View</option>
 <option value="city view">City View</option>
 <option value="garden view">Garden View</option>
 </select>
 <label>Smoking Preference:</label>
 <select name="smoking_preference" required>
 <option value="smoking">Smoking</option>
 <option value="non-smoking">Non-Smoking</option>
 </select>
 <label>Floor Preference:</label>
 <select name="floor_preference" required>
 <option value="ground">Ground Floor</option>
 <option value="high">High Floor</option>
 </select>
 <label>Additional Services:</label>
 <input type="checkbox" name="airport_shuttle"> Airport Shuttle<br>
 <input type="checkbox" name="breakfast_included"> Breakfast Included<br>
 <input type="checkbox" name="spa_services"> Spa/Wellness Services<br>
 <input type="checkbox" name="parking"> Parking<br>
 <input type="checkbox" name="pet_friendly"> Pet-Friendly Room<br>
 <label>Comments/Notes:</label>
 <textarea name="comments"></textarea>
 <input type="submit" value="Submit">
 </form>
<script>
function fun() {
 alert("Submitted!!");
 return true;
}
</script>
</body>
</html>
