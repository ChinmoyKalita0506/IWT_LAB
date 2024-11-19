<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin_user"])) {
    header("Location: login.php");
    exit; // Stop further execution
}

// Display the logged-in user's name
$username = htmlspecialchars($_SESSION["loggedin_user"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PC Part-Picker</title>
    <link rel="icon" href="images/logo1.png">
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background: url("../images/2.jpg") no-repeat center center fixed; 
    background-size: cover;
    color: #ee9209;
    line-height: 1.6;
    margin: 0;
    padding: 0;
}

header {
    background: rgba(0, 0, 0, 0.7);
    padding: 20px;
    text-align: center;
    position: relative;
}

h1 {
    color: #ffffff;
    margin: 0;
    text-transform: uppercase;
    font-size: 2.5em;
}

nav {
    margin-top: 20px;
}

nav ul {
    list-style-type: none;
    padding: 0;
    display: flex;
    justify-content: center;
}

nav ul li {
    margin: 0 15px;
}

nav a {
    color: #ffffff;
    text-decoration: none;
    padding: 10px 15px;
    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 5px;
    transition: background 0.3s ease;
}

nav a:hover {
    background-color: #e3941b;
    color: #000;
}

#session_print {
    color: white;
    position: absolute;
    top: 20px;
    right: 20px;
}

article {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    margin: 20px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 10px;
}

article div {
    text-align: center;
    margin: 10px;
}

.m_link {
    display: inline-block;
    background: #f78c1b;
    color: #ffffff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background 0.3s;
}

.m_link:hover {
    background: #3aadfe;
    color: #ffffff;
}

hr {
    width: 20%;
    margin: 20px auto;
    border: 1px solid #e3941b;
    border-radius: 50%;
}

    </style>
</head>
<body>
    <header>
        <h1>BUILD YOUR PC</h1>
        <div id='session_print'>Logged in as: <?php echo $username; ?></div>
        <nav>
            <ul>
                <li><a href="page2.php" class="active">Home</a></li>
                <li><a href="buildmachine.php">Build Your PC</a></li>
                <li><a href="components.php">Components</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="logout.php">Logout</a></li> <!-- Moved logout here -->
            </ul>
        </nav>
    </header>
    
    <article>
        <div id="m_photocontainer1">
            <div id="wpc1">
                <h2>WHY BUILD YOUR OWN PC?</h2>
                <hr/>
                <p>PC Builder Kits let you build a high-performance system that fits your needs. When the time comes to upgrade, you’ll have the foundation to handle it yourself — making your investment pay off in the long run.</p>
                <a  class="m_link">About Us</a>
            </div>
        </div>
    </article>

    <article>
        <div id="m_photocontainer2">
            <div id="wpc2">
                <h2>COMPONENTS FOR YOUR PC</h2>
                <hr/>
                <p>Choose the best components that suit your needs and budget. We have a wide variety of parts for every type of build.</p>
                <a href="showproducts/Components.php" class="m_link">Completed Builds</a>
            </div>
        </div>
    </article>

    <article>
        <div id="m_photocontainer3">
            <div id="wpc3">
                <h2>CART</h2>
                <hr/>
                <p>Review your selected components and finalize your purchase. Enjoy a seamless shopping experience with us!</p>
                <a href="showproducts/buildmachine.php" class="m_link">Build Machine</a>
            </div>
        </div>
    </article>
</body>
</html>
