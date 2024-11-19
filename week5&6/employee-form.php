<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection details
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "db1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for messages
$success_message = '';
$error_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $department = $conn->real_escape_string($_POST['department']);
    $position = $conn->real_escape_string($_POST['position']);
    $dob = $conn->real_escape_string($_POST['date_of_joining']);

    // Insert data into the database
    $sql = "INSERT INTO employees (first_name, last_name, email, phone, department, position, dob)
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$department', '$position', '$dob')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "New record created successfully";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 450px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 95%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        .message {
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <!-- Display success or error messages -->
        <?php if ($success_message): ?>
            <div class="message" style="color: green;"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <?php if ($error_message): ?>
            <div class="message" style="color: red;"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Form fields -->
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
        
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone">
        
        <label for="department">Department:</label>
        <input type="text" id="department" name="department">
        
        <label for="position">Position:</label>
        <input type="text" id="position" name="position">
        
        <label for="date_of_joining">Date of Joining:</label>
        <input type="date" id="date_of_joining" name="date_of_joining">
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
