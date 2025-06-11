
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Booking Form</title>
  <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 50rem; /* ~800px */
    margin: 3.125rem auto; /* ~50px */
    padding: 1.25rem; /* 20px */
    background: linear-gradient(to right, black, #0077b6);
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    color: white;
}

fieldset {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

h1 {
    text-align: center;
    color: white;
    font-size: 2rem; /* Increased size for better visibility */
}

form {
    display: flex;
    flex-direction: column;
    gap: 1.25rem; /* 20px */
}

label {
    font-weight: bold;
    margin-bottom: 0.3125rem; /* 5px */
}

input, select, textarea {
    width: 100%; /* Full width for responsiveness */
    padding: 0.625rem; /* 10px */
    border: 1px solid #ccc;
    border-radius: 0.25rem; /* 4px */
    font-size: 1rem; /* 16px */
}

textarea {
    resize: vertical;
}

.row label {
    display: flex;
    gap: 1.25rem; /* 20px */
}

.row > div {
    flex: 1;
}

.checkbox-group {
    display: flex;
    flex-direction: row; /* Change to row */
    align-items: center; /* Align items vertically centered */
    justify-content: flex-start; /* Align items to the start */
}

.checkbox-group input {
    margin-right: 0.625rem; /* 10px */
}


button {
    padding: 0.9375rem; /* 15px */
    background: linear-gradient(to left, white, #0077b6);
    color: black;
    border: none;
    font-size: 1.125rem; /* 18px */
    cursor: pointer;
    border-radius: 0.25rem; /* 4px */
    transition: background-color 0.3s ease; /* Adjusted transition for smoother effect */
}

button:focus {
    background-color: #005f87;
}

.error-message {
    color: red;
    font-size: 0.875rem; /* 14px */
    margin-top: 0.3125rem; /* 5px */
}

.hidden {
    display: none;
}

/* Additional responsive adjustments */
@media (max-width: 768px) {
    .container {
        margin: 2rem; /* Adjust for smaller screens */
        padding: 1rem; /* Adjust for smaller screens */
    }

    button {
        font-size: 1rem; /* Reduce button font size on small screens */
    }
}

  </style>
</head>
<body>

    <div class="container">
      <h1>Hotel Booking Form</h1>
      <form id="booking-form" action="submit_booking.php" method="POST">
        <!-- Personal Information -->
        <fieldset>
          <legend>1. Personal Information</legend><br>
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required>
          <div class="error-message hidden" id="name-error"></div><br>
  
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
          <div class="error-message hidden" id="email-error"></div><br>
  
          <label for="phone">Phone:</label>
          <input type="tel" id="phone" name="phone" required>
          <div class="error-message hidden" id="phone-error"></div><br>
  
          <label for="address">Address (Optional):</label>
          <input type="text" id="address" name="address">
        </fieldset>
        <fieldset>
          <legend>2. Booking Information</legend><br>
          <div class="row">
            <div>
              <label for="checkin">Check-in Date:</label>
              <input type="date" id="checkin" name="checkin" required>
              <div class="error-message hidden" id="checkin-error"></div>
            </div>
            <div>
              <label for="checkout">Check-out Date:</label>
              <input type="date" id="checkout" name="checkout" required><br>
              <div class="error-message hidden" id="checkout-error"></div>
            </div>
          </div><br>
  
          <div class="row">
            <div>
              <label for="adults">Number of Adults:</label>
              <input type="number" id="adults" name="adults" min="1" required>
              <div class="error-message hidden" id="adults-error"></div>
            </div>    
            <div>
              <label for="children">Number of Children:</label>
              <input type="number" id="children" name="children" min="0" required>
              <div class="error-message hidden" id="children-error"></div>
            </div>
          </div><br>
  
          <div class="row">
            <label for="roomtype">Room Type:</label>
            <select id="roomtype" name="roomtype" required>
              <option value="" disabled selected>Select Room Type</option>
              <option value="single">Single Room</option>
              <option value="double">Double Room</option>
              <option value="suite">Suite</option>
            </select><br><br>
            <div class="error-message hidden" id="roomtype-error"></div>
  
            <label for="rooms">Number of Rooms:</label>
            <input type="number" id="rooms" name="rooms" min="1" required><br><br>
            <div class="error-message hidden" id="rooms-error"></div>
          </div>
          
          <label for="special-requests">Special Requests:</label><br>
          <textarea id="special-requests" name="special-requests" rows="3"></textarea><br><br>    
  
          <label for="arrival-time">Arrival Time (Optional):</label>
          <input type="time" id="arrival-time" name="arrival-time">
        </fieldset>
        <fieldset>
          <legend>3. Payment Information</legend><br>
  
          <label for="payment-method">Payment Method:</label><br>
          <select id="payment-method" name="payment-method" required>
            <option value="" disabled selected>Select Payment Method</option>
            <option value="credit-card">Credit Card</option>
            <option value="debit-card">Debit Card</option>
            <option value="paypal">PayPal</option>
          </select><br>
          <div class="error-message hidden" id="payment-method-error"></div>
  
          <label for="card-number">Card Number:</label>
          <input type="text" id="card-number" name="card-number" required><br>
          <div class="error-message hidden" id="card-number-error"></div>
  
          <div class="row">
            <div>
              <label for="expiry-date">Expiry Date:</label>
              <input type="date" id="expiry-date" name="expiry-date" required><br><br>
              <div class="error-message hidden" id="expiry-date-error"></div>
            </div>
            <div>
              <label for="cvv">CVV:</label>
              <input type="text" id="cvv" name="cvv" required>
              <div class="error-message hidden" id="cvv-error"></div>
            </div>
          </div><br><br>
  
          <label for="billing-address">Billing Address (Optional):</label>
          <input type="text" id="billing-address" name="billing-address">
        </fieldset>
        <fieldset>
          <legend>4. Guest Comments</legend><br>
          <label for="guest-comments">Special Requests or Comments:</label>
          <textarea id="guest-comments" name="guest-comments" rows="3"></textarea>
        </fieldset>
  
        <!-- Agreement & Terms -->
<fieldset>
    <legend>5. Agreement & Terms</legend><br>

    <div class="checkbox-group">
        <input type="checkbox" id="cancel-policy" name="cancel-policy" required>
        <label for="cancel-policy">I agree to the Cancellation Policy</label>
    </div>
    <div class="error-message hidden" id="cancel-policy-error"></div>
    
    <div class="checkbox-group">
        <input type="checkbox" id="terms-conditions" name="terms-conditions" required>
        <label for="terms-conditions">I agree to the Terms & Conditions</label>
    </div>
    <div class="error-message hidden" id="terms-conditions-error"></div>
</fieldset>
<button type="submit">Submit Booking</button>
      </form>
    </div>
  
    <script>
      document.getElementById("booking-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent form submission until validation
  
        let isValid = true;
  
        function showError(input, errorDiv, message) {
          input.style.borderColor = 'red';
          errorDiv.textContent = message;
          errorDiv.classList.remove("hidden");
        }
  
        function hideError(input, errorDiv) {
          input.style.borderColor = '';
          errorDiv.classList.add("hidden");
        }

        const inputs = document.querySelectorAll("input, select, textarea");
        inputs.forEach(input => {
          input.style.borderColor = '';
        });

        const name = document.getElementById("name");
        const nameError = document.getElementById("name-error");
        if (name.value.trim() === "") {
          showError(name, nameError, "Name is required.");
          isValid = false;
        } else {
          hideError(name, nameError);
        }
  
        const email = document.getElementById("email");
        const emailError = document.getElementById("email-error");
        const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!email.value.match(emailPattern)) {
          showError(email, emailError, "Please enter a valid email.");
          isValid = false;
        } else {
          hideError(email, emailError);
        }
  
        const phone = document.getElementById("phone");
        const phoneError = document.getElementById("phone-error");
        if (phone.value.trim() === "") {
          showError(phone, phoneError, "Phone number is required.");
          isValid = false;
        } else {
          hideError(phone, phoneError);
        }
  
        const checkin = document.getElementById("checkin");
        const checkinError = document.getElementById("checkin-error");
        const checkout = document.getElementById("checkout");
        const checkoutError = document.getElementById("checkout-error");
        if (checkin.value === "") {
          showError(checkin, checkinError, "Check-in date is required.");
          isValid = false;
        } else {
          hideError(checkin, checkinError);
        }
  
        if (checkout.value === "") {
          showError(checkout, checkoutError, "Check-out date is required.");
          isValid = false;
        } else if (new Date(checkin.value) >= new Date(checkout.value)) {
          showError(checkout, checkoutError, "Check-out date must be after check-in date.");
          isValid = false;
        } else {
          hideError(checkout, checkoutError);
        }
  
        const adults = document.getElementById("adults");
        const adultsError = document.getElementById("adults-error");
        if (adults.value < 1) {
          showError(adults, adultsError, "Number of adults must be at least 1.");
          isValid = false;
        } else {
          hideError(adults, adultsError);
        }
  
        const roomtype = document.getElementById("roomtype");
        const roomtypeError = document.getElementById("roomtype-error");
        if (roomtype.value === "") {
          showError(roomtype, roomtypeError, "Please select a room type.");
          isValid = false;
        } else {
          hideError(roomtype, roomtypeError);
        }
  
        const rooms = document.getElementById("rooms");
        const roomsError = document.getElementById("rooms-error");
        if (rooms.value < 1) {
          showError(rooms, roomsError, "Number of rooms must be at least 1.");
          isValid = false;
        } else {
          hideError(rooms, roomsError);
        }
  
        const paymentMethod = document.getElementById("payment-method");
        const paymentMethodError = document.getElementById("payment-method-error");
        if (paymentMethod.value === "") {
          showError(paymentMethod, paymentMethodError, "Please select a payment method.");
          isValid = false;
        } else {
          hideError(paymentMethod, paymentMethodError);
        }
  
        // const cardNumber = document.getElementById("card-number");
        // const cardNumberError = document.getElementById("card-number-error");
        // const cardPattern = /^[0-9]{16}$/;
        // if (!cardNumber.value.match(cardPattern)) {
        //   showError(cardNumber, cardNumberError, "Please enter a valid 16-digit card number.");
        //   isValid = false;
        // } else {
        //   hideError(cardNumber, cardNumberError);
        // }
  
        // const expiryDate = document.getElementById("expiry-date");
        // const expiryDateError = document.getElementById("expiry-date-error");
        // if (expiryDate.value === "") {
        //   showError(expiryDate, expiryDateError, "Expiry date is required.");
        //   isValid = false;
        // } else {
        //   hideError(expiryDate, expiryDateError);
        // }
  
        // const cvv = document.getElementById("cvv");
        // const cvvError = document.getElementById("cvv-error");
        // const cvvPattern = /^[0-9]{3,4}$/;
        // if (!cvv.value.match(cvvPattern)) {
        //   showError(cvv, cvvError, "Please enter a valid CVV.");
        //   isValid = false;
        // } else {
        //   hideError(cvv, cvvError);
        // }
  
        const cancelPolicy = document.getElementById("cancel-policy");
        const cancelPolicyError = document.getElementById("cancel-policy-error");
        if (!cancelPolicy.checked) {
          showError(cancelPolicy, cancelPolicyError, "You must agree to the cancellation policy.");
          isValid = false;
        } else {
          hideError(cancelPolicy, cancelPolicyError);
        }
  
        const termsConditions = document.getElementById("terms-conditions");
        const termsConditionsError = document.getElementById("terms-conditions-error");
        if (!termsConditions.checked) {
          showError(termsConditions, termsConditionsError, "You must agree to the terms & conditions.");
          isValid = false;
        } else {
          hideError(termsConditions, termsConditionsError);
        }
  
        if (isValid) {
          this.submit();
        }
      });
    </script>
  
  </body>
  </html>