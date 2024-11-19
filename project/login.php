<?php
session_start();
$_SESSION = array();
session_destroy();
session_start();

// Database credentials
$dbservername = "localhost";
$dbusername = "root"; // Adjust if you use a different username
$dbpassword = ""; // Leave empty if there's no password for root
$dbname = "pcbuilder";

// Create connection
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loggedin_email = $_POST['eid']; // Email for login
    $loggedin_passwrd = $_POST['passwd']; // Password entered by user

    // Use email for the login check
    $sql = "SELECT * FROM users WHERE email='$loggedin_email'";
    $result = $conn->query($sql);

    // Check if user exists
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];

        // Verify the password
        if (password_verify($loggedin_passwrd, $password)) {
            $_SESSION["loggedin_user"] = $row['username']; // Store username in session
            header("Location: page2.php"); // Redirect after successful login
            exit();
        } else {
            echo "<script>alert('Incorrect password. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('No user found with that email.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Log In</title>
    <link rel="icon" href="images/logo1.png">
    <link rel="stylesheet" type="text/css" href="css/page1.css">
    <link rel="stylesheet" type="text/css" href="css/form.css">  
    <style>
        form {
            font-family: 'Kodchasan', sans-serif;
        }
    </style>
</head>
<body>
    <div>
        <header>
            <h1 align="center">BUILD YOUR PC</h1>
            <nav>
                <ul style="list-style-type: none">
                    <li><a href="index.html"><img src="images/back.png"/>Home</a></li>
                </ul>
            </nav>
        </header>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
        <div id="formbox">
            <h3 align="center">Log In</h3>
            <hr>
            <br/>
            <input type="email" name="eid" placeholder="Email" required style="outline: none;background: transparent; border: 0;border-bottom: 1px solid black; -webkit-text-fill-color: black;"><br/><br/>
            <input type="password" name="passwd" placeholder="Enter Your Password" maxlength="8" required style="outline: none;background: transparent; border: 0;border-bottom: 1px solid black; -webkit-text-fill-color: black;"><br/><br/>
            <input type="submit" class="m_mybutton button1" name="loginbutton" value="Log In"><br/><br/>
        </div>
    </form>
</body>
</html>
