<?php
session_start(); // Start the session to manage cart data

// Sample data for components (This data should ideally come from a database)
$components = include 'components.php';

$totalPrice = 0;
$selectedComponents = [];

// Handle adding components to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Reset selection
    if (isset($_POST['reset'])) {
        $selectedComponents = [];
        $totalPrice = 0;
    } elseif (isset($_POST['components'])) {
        foreach ($_POST['components'] as $category => $componentIndex) {
            // Add selected component to the array and update total price
            $selectedComponent = $components[$category][$componentIndex];
            $selectedComponents[] = $selectedComponent;
            $totalPrice += $selectedComponent['price'];
        }
    }

    // Add to cart
    if (isset($_POST['add_to_cart'])) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = []; // Initialize cart in session if not set
        }
        foreach ($selectedComponents as $component) {
            $_SESSION['cart'][] = $component; // Add selected components to cart session
        }
        $selectedComponents = []; // Clear selected components after adding to cart
        $totalPrice = 0; // Reset total price after adding to cart

        // Redirect to cart.php
        header('Location: cart.php');
        exit();
    }
}

// Function to display cart items (for further use)
function displayCart() {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $component) {
            echo "<li>{$component['name']} - ₹{$component['price']}</li>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build Your PC</title>
    <style>
        /* Basic reset and layout */
        /* Basic reset and layout */
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

/* Common Navigation Bar Styling */
nav {
    margin-top: 20px;
    background-color: rgba(0, 0, 0, 0.7); /* Ensures visibility */
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
    background-color: rgba(255, 255, 255, 0.3); /* Semi-transparent background */
    border-radius: 5px;
    transition: background 0.3s ease, color 0.3s ease;
}

nav a:hover {
    background-color: #e3941b; /* Clear, vibrant color for hover */
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

/* buildmachine.php specific styles */
.container {
    width: 90%;
    margin: 0 auto;
    max-width: 1200px;
    padding: 20px;
}

/* Component grid styling */
.component-category { margin-top: 30px; }
.component-grid { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
.component-card {
    background-color: white; border-radius: 10px; width: 200px; padding: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); text-align: center;
    transition: transform 0.2s;
}
.component-card:hover { transform: translateY(-5px); }
.component-card img { width: 100%; height: auto; max-height: 120px; object-fit: cover; margin-bottom: 10px; border-radius: 5px; }
.component-card h3 { font-size: 1.1em; margin: 10px 0; color: #333; }
.component-card p { font-size: 1em; color: #777; margin-bottom: 10px; }

/* Radio button styling */
.component-card input[type="radio"] {
    margin-right: 5px;
    transform: scale(1.2);
    accent-color: #3498db;
}

/* Styled buttons */
.button-container {
    display: flex; justify-content: center; gap: 15px; margin-top: 20px;
}
.button-container button {
    background-color: #3498db; color: white; padding: 10px 20px;
    border: none; border-radius: 5px; cursor: pointer; font-size: 1em;
    transition: background-color 0.3s;
}
.button-container button:hover { background-color: #2980b9; }


    </style>
</head>
<body>
        <nav>
            <ul>
                <li><a href="page2.php" class="active">Home</a></li>
                <li><a href="buildmachine.php" class="active">Build Your PC</a></li>
                <li><a href="components.html">Components</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="logout.php">Logout</a></li> <!-- Moved logout here -->
            </ul>
        </nav>
    <div class="container">
        <h1>Build Your PC</h1>

        <!-- Component selection form -->
        <form method="POST">
            <?php foreach ($components as $category => $items): ?>
                <div class="component-category">
                    <h2><?= ucfirst($category); ?></h2>
                    <div class="component-grid">
                        <?php foreach ($items as $index => $item): ?>
                            <div class="component-card">
                                <img src="<?= $item['image']; ?>" alt="<?= $item['name']; ?>">
                                <h3><?= $item['name']; ?></h3>
                                <p>₹<?= $item['price']; ?></p>
                                <label>
                                    <input type="radio" name="components[<?= $category; ?>]" value="<?= $index; ?>">
                                    Select
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Total price display -->
            <div class="selected-components">
                <h2>Selected Components</h2>
                <ul>
                    <?php foreach ($selectedComponents as $component): ?>
                        <li><?= $component['name']; ?> - ₹<?= $component['price']; ?></li>
                    <?php endforeach; ?>
                </ul>
                <h3>Total Price: ₹<?= $totalPrice; ?></h3>
            </div>

            <div class="button-container">
                <button type="submit" name="add_to_cart">Add to Cart</button>
                <button type="submit" name="reset">Reset Selection</button>
            </div>
        </form>
    </div>
</body>
</html>
