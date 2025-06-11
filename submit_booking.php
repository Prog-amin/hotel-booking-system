<?php

include 'Db.php';

// Validate and sanitize inputs
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$address = trim($_POST['address']);
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$adults = intval($_POST['adults']);
$children = intval($_POST['children']);
$roomtype = $_POST['roomtype'];
$rooms = intval($_POST['rooms']);
$special_requests = trim($_POST['special-requests']);
$arrival_time = $_POST['arrival-time'];
$payment_method = $_POST['payment-method'];
$card_number = trim($_POST['card-number']);
$expiry_date = $_POST['expiry-date'];
$cvv = trim($_POST['cvv']);
$billing_address = trim($_POST['billing-address']);
$guest_comments = trim($_POST['guest-comments']);

// Check for required fields
$errors = [];
if (empty($name)) $errors[] = "Name is required.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
if (empty($phone)) $errors[] = "Phone number is required.";
if (empty($checkin)) $errors[] = "Check-in date is required.";
if (empty($checkout)) $errors[] = "Check-out date is required.";
if ($adults < 1) $errors[] = "At least one adult is required.";
if (empty($roomtype)) $errors[] = "Room type is required.";
if ($rooms < 1) $errors[] = "At least one room is required.";
if (empty($payment_method)) $errors[] = "Payment method is required.";
// if (empty($card_number) || !preg_match('/^[0-9]{16}$/', $card_number)) $errors[] = "Valid card number is required.";
// if (empty($expiry_date)) $errors[] = "Expiry date is required.";
if (empty($cvv) || !preg_match('/^[0-9]{3,4}$/', $cvv)) $errors[] = "Valid CVV is required.";

// If there are validation errors, print them
if (!empty($errors)) {
    echo implode('<br>', $errors);
    exit;
}

$sql_create_rooms_table = "CREATE TABLE IF NOT EXISTS hotel_bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Optional: Auto-incrementing ID for each booking
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    checkin DATE NOT NULL,
    checkout DATE NOT NULL,
    adults INT NOT NULL,
    children INT NOT NULL,
    roomtype VARCHAR(50) NOT NULL,
    rooms INT NOT NULL,
    special_requests TEXT,
    arrival_time TIME,
    payment_method VARCHAR(50) NOT NULL,
    card_number VARCHAR(16),  -- Assuming a standard credit card length
    expiry_date DATE,  -- Format: YYYY-MM-DD
    cvv VARCHAR(4),  -- Typically 3 or 4 digits
    billing_address VARCHAR(255),
    guest_comments TEXT
)";

if (mysqli_query($conn, $sql_create_rooms_table)) {
    echo "Table created successfully.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}


$stmt = $conn->prepare("INSERT INTO hotel_bookings 
    (name, email, phone, address, checkin, checkout, adults, children, roomtype, rooms, special_requests, arrival_time, payment_method, card_number, expiry_date, cvv, billing_address, guest_comments) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Here’s the correct type definition string
$stmt->bind_param(
    "ssssssiisissssssss", // 14 strings and 3 integer
    $name,
    $email,
    $phone,
    $address,
    $checkin,
    $checkout,
    $adults,
    $children,
    $roomtype,
    $rooms,
    $special_requests,
    $arrival_time,
    $payment_method,
    $card_number,
    $expiry_date,
    $cvv,
    $billing_address,
    $guest_comments
);


// Execute and check if successful
if ($stmt->execute()) {
    header("Location: room_pref.php");
    exit;
} else {
    
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
