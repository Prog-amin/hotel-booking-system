<html>
<head>
<title>Customer Management Board</title>
</head>
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

div, form {
    color: olivegreen;
    text-align: center;
    border: none;
    font-size: 1.25rem; /* 20px */
}

table {
    display: none; /* Hidden by default */
}

button {
    background: cadetblue;
    display: inline-block; /* Changed to inline-block for better layout */
    height: 3.125rem; /* 50px */
    padding: 0.625rem; /* Adjust for some internal spacing */
    border: none;
    font-size: 1rem; /* Adjust font size for better scalability */
    color: white; /* Add text color for visibility */
    cursor: pointer; /* Indicate clickable button */
}

/* Additional responsive adjustments */
@media (max-width: 768px) {
    .date, .day {
        width: 70%; /* Adjust width for smaller screens */
    }

    div, form {
        font-size: 1rem; /* Reduce font size on small screens */
    }

    button {
        height: auto; /* Allow button height to adjust */
        width: 100%; /* Full width for buttons on small screens */
    }
}

</style>
<body>
<h1>Customer Management Board</h1>
<h3 class="date">DATE:</h3><h3 class="day" id="date">/</h3>
<script>
const date=new Date();
document.getElementById("date").innerHTML=date.getDate()+"/"+(date.getMonth()+1)+"/"+date.getFullYear();
</script>
</div></br></br>
<div class="button">
<a href="personal_history.php"><button id="personal" onclick="personalfun()">PERSONAL HISTORY</button></a>
<a href="booking_history.php"><button id="booking" onclick="bookingfun()">BOOKING HISTORY</button></a>
<a href="preferences_history.php"><button id="preference" onclick="perferencefun()">PREFERENCES HISTORY</button></a>
</div>
</body>
</html>