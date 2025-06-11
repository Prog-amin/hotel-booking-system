<?php
include 'Db.php'; 
mysqli_select_db($conn, $dbname);

// Assuming you have a booking_id or email to retrieve specific booking details
$bookingId = '01'; // Set this to the appropriate booking ID you want to retrieve details for

// Retrieve booking details directly from the hotel_bookings table
$sqlBooking = "SELECT * FROM hotel_bookings WHERE id = '$bookingId'";
$resultBooking = $conn->query($sqlBooking);

$totalCharges = 0; // Modify this as needed based on your pricing logic

if ($resultBooking && $resultBooking->num_rows > 0) {
    $booking = $resultBooking->fetch_assoc();
    // Assuming you calculate total charges based on room type, rooms, and any other applicable charges
    // For now, just setting it to a placeholder value (you can adjust this logic)
    $totalCharges = $booking['rooms'] * 100; // Example: Assuming $100 per room per night, adjust accordingly

} else {
    echo "Booking not found or error: " . $conn->error;
}
?>
<html>
<head>
<title>Billing and Invoice</title>
<style>
body { 
    font-family: Arial, sans-serif; 
    margin: 0;
    padding: 0; 
    background-color: #f4f4f4; 
}
.invoice-container { 
    width: 80%;
    margin: 20px auto; 
    background-color: #fff; 
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
}
header { 
    text-align: center; 
}
.invoice-details { 
    display: flex; 
    justify-content: space-between; 
    margin-top: 20px; 
}
.summary { 
    margin-top: 20px; 
}
footer { 
    margin-top: 20px; 
    text-align: center; 
}
footer button {
    margin: 5px; 
    padding: 10px 20px; 
    font-size: 1em; 
}
</style>
</head>
<body>
<div class="invoice-container">
    <header>
        <h1>Invoice</h1>
        <div class="invoice-details">
            <div><strong>Name:</strong> <span id="guestName"><?php echo htmlspecialchars($booking['name'] ?? 'N/A'); ?></span></div>
            <div><strong>Email:</strong> <span id="guestEmail"><?php echo htmlspecialchars($booking['email'] ?? 'N/A'); ?></span></div>
            <div><strong>Phone:</strong> <span id="guestPhone"><?php echo htmlspecialchars($booking['phone'] ?? 'N/A'); ?></span></div>
            <div><strong>Check-in Date:</strong> <span id="checkinDate"><?php echo htmlspecialchars($booking['checkin'] ?? 'N/A'); ?></span></div>
            <div><strong>Check-out Date:</strong> <span id="checkoutDate"><?php echo htmlspecialchars($booking['checkout'] ?? 'N/A'); ?></span></div>
            <div><strong>Room Type:</strong> <span id="roomType"><?php echo htmlspecialchars($booking['roomtype'] ?? 'N/A'); ?></span></div>
            <div><strong>Rooms:</strong> <span id="rooms"><?php echo htmlspecialchars($booking['rooms'] ?? 'N/A'); ?></span></div>
            <div><strong>Special Requests:</strong> <span id="specialRequests"><?php echo htmlspecialchars($booking['special_requests'] ?? 'N/A'); ?></span></div>
            <div><strong>Payment Method:</strong> <span id="paymentMethod"><?php echo htmlspecialchars($booking['payment_method'] ?? 'N/A'); ?></span></div>
        </div>
    </header>
    <section class="summary">
        <div><strong>Total Charges:</strong> <span id="totalCharges">$<?php echo number_format($totalCharges, 2); ?></span></div>
    </section>
    <footer>
        <button onclick="downloadInvoice()">Download Invoice</button>
        <button onclick="printInvoice()">Print Invoice</button>
        <div><strong>Contact Billing Support:<a href="mailto:hotelbilling@gmail.com"></strong> hotelbilling@gmail.com</a></div>
    </footer>
</div>
<script>
function downloadInvoice() {
    alert('Download Successfully');
}
function printInvoice() {
    window.print();
}
</script>
<?php
$conn->close();
?>
</body>
</html>
