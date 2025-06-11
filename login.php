<?php
include 'Db.php';

// Create the database if not exists
$sql_create_db = "CREATE DATABASE IF NOT EXISTS " . $dbname;
mysqli_query($conn, $sql_create_db);
mysqli_select_db($conn, $dbname);

// Create the login table if not exists
$sql_create_logtable = "CREATE TABLE IF NOT EXISTS login (
    Login VARCHAR(50),
    Password VARCHAR(50),
    Login_Time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql_create_logtable);

$userid = '';
$password = '';
$errors = [
    'user' => '',
    'pass' => ''
];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["user"])) {
        $errors['user'] = "User Name is required.";
    } else {
        $userid = mysqli_real_escape_string($conn, $_POST["user"]);
    }

    if (empty($_POST["pass"])) {
        $errors['pass'] = "Password is required.";
    } else {
        $password = mysqli_real_escape_string($conn, $_POST["pass"]);
    }

    if (empty($errors['user']) && empty($errors['pass'])) {
        $sql_insert_values = "INSERT INTO login (Login, Password, Login_Time) 
                              VALUES ('$userid', '$password', CURRENT_TIMESTAMP())";
        if (!mysqli_query($conn, $sql_insert_values)) {
            $errors['general'] = "ERROR: Could not execute query. " . mysqli_error($conn);
        } else {
            // Check which button was clicked (Customer or Employee)
            if (isset($_POST['login_employee'])) {
                // Redirect to employee management page after login
                header("Location: Emp_index.php");
                exit();
            } elseif (isset($_POST['login_customer'])) {
                // Redirect to room availability page after login
                header("Location: booking.php");
                exit();
            }
        }
    }
}
mysqli_close($conn);
?>

<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-2lINvEGW2nTLmnhqKMo-cv043rL5ZDN5fw&s');
        }
        fieldset {
            background-color: skyblue;
            height: 350px;
            width: 400px;
            margin-top: 100px;
        }
        table {
            border-color: skyblue;
            color: darkblue;
            border-collapse: collapse;
            margin-top: 20px;
        }
        input {
            height: 30px;
            width: 200px;
        }
        #clr, #log {
            height: 30px;
            width: 150px;
        }
        .sub, .clr, p {
            color: white;
            background-color: darkblue;
            height: 30px;
            width: 180px;
            text-align: center;
        }
        img {
            padding: 5px 5px;
            float: left;
            width: 150px;
            height: 150px;
        }
        .college {
            background-color: grey;
            color: ghostwhite;
            text-align: center;
            padding: 5px 5px;
            height: 160px;
        }
        .error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="college">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxSn6UOhJrGDgzEXlC6FuAx7EH7VZhzC57JK--l4ck21ZqwaDR9XDecUsb-9YOXAL58kY&usqp=CAU">
    <h1>HOTEL ALPHA</h1>
    <h2>Step into the Wild: Your Alpha Adventure Begins Here</h2>
</div>

<center>
    <fieldset>
        <legend>
            <center><b style="color:seashell;font-size: 35px;text-shadow:3px 3px black">Login</b></center>
        </legend>
        <form action="login.php" method="POST">
            <table border="1px" cellpadding="15px">
                <tr>
                    <td>User Name</td>
                    <td>
                        <input type="text" id="user" name="user" value="<?php echo htmlspecialchars($userid); ?>">
                        <?php if (!empty($errors['user'])): ?>
                            <div class="error"><?php echo htmlspecialchars($errors['user']); ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" id="pass" name="pass">
                        <?php if (!empty($errors['pass'])): ?>
                            <div class="error"><?php echo htmlspecialchars($errors['pass']); ?></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            <!-- Added different names for each button -->
                            <input type="submit" name="login_employee" value="LOGIN AS EMPLOYEE" class="clr">
                            <input type="submit" name="login_customer" value="LOGIN AS CUSTOMER" class="sub"/>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><center><h3>New User? <a href="signup.php">signup</a></h3></center></td>
                </tr>
            </table>
        </form>
    </fieldset>
</center>

<?php if (!empty($errors['general'])): ?>
    <div class="error" style="text-align:center;">
        <?php echo htmlspecialchars($errors['general']); ?>
    </div>
<?php endif; ?>

</body>
</html>
