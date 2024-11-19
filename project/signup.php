<?php
session_start();

$dbservername = "localhost";
$dbusername = "root"; // Adjust according to your setup
$dbpassword = ""; // Leave empty if there's no password
$dbname = "pcbuilder";

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle signup
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing password
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if (password_verify($confirmPassword, $password)) {
        // Insert user into database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Signup successful! You can now log in.'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="icon" href="images/logo1.png">
    <link rel="stylesheet" type="text/css" href="css/page1.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">  
    <link href="https://fonts.googleapis.com/css?family=Kodchasan" rel="stylesheet" type="text/css"> 
    <style>
        form {
            font-family: 'Kodchasan', sans-serif;
        }
    </style>
</head>
<body>
    <div class="animatebottom">
        <header id="header">
            <h1 align="center">BUILD YOUR PC</h1>
            <nav>
                <ul style="list-style-type: none">
                    <li><a href="index.html"><img src="images/back.png"/>Home</a></li>
                </ul>
            </nav>
        </header>

        <form method="post" id="signupForm">
            <div id="formbox">
                <h3 align="center">Sign Up</h3>
                <hr>

                <div id="m_hide">
                    <label for="username"><b>Username</b></label>
                    <input style="outline: none; background: transparent; border: 0; margin-left: 20em; border-bottom: 1px solid black; -webkit-text-fill-color: black;" type="text" name="username" placeholder="Username" required><br/><br/>

                    <label for="email"><b>Email</b></label>
                    <input style="outline: none; background: transparent; border: 0; margin-left: 20em; border-bottom: 1px solid black; -webkit-text-fill-color: black;" type="email" name="email" placeholder="Email Id" required><br/><br/>

                    <label for="password"><b>Password</b></label>
                    <input style="outline: none; background: transparent; border: 0; margin-left: 20em; border-bottom: 1px solid black; -webkit-text-fill-color: black;" id="pass1" type="password" name="password" placeholder="Maximum 8 characters" maxlength="8" required><br/><br/>

                    <label for="confirm_password"><b>Confirm Password</b></label>
                    <input style="outline: none; background: transparent; border: 0; margin-left: 20em; border-bottom: 1px solid black; -webkit-text-fill-color: black;" id="pass2" type="password" name="confirm_password" placeholder="Confirm Password" maxlength="8" required><br/><br/>
                </div>

                <center><input type="submit" id="passbut" class="m_mybutton button1" name="signup" value="Sign Up"></center>
            </div>

            <script>
                document.getElementById("signupForm").addEventListener("submit", function(event) {
                    var pass1 = document.getElementById("pass1").value;
                    var pass2 = document.getElementById("pass2").value;

                    if (pass1 !== pass2) {
                        event.preventDefault(); // Prevents form submission
                        alert("Passwords do not match.");
                    }
                });
            </script>
        </form>
    </div>
</body>
</html>
