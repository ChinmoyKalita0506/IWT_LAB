<?php
session_start(); // Start the session to manage cart data

// Function to display cart items
function displayCart() {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $component) {
            echo "<li>{$component['name']} - ₹{$component['price']}</li>";
        }
    } else {
        echo "<li>Your cart is empty.</li>";
    }
}

// Calculate total price
function calculateTotal() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $component) {
            $total += $component['price'];
        }
    }
    return $total;
}

// Handle checkout (this can be expanded with further functionality later)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    // Here, you can handle the checkout process (e.g., redirect to payment page)
    header('Location: checkout.php'); // Redirect to a hypothetical checkout page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 0; }
        h1, h2 { text-align: center; color: #333; }
        .container { width: 90%; margin: 0 auto; max-width: 800px; padding: 20px; }
        .navbar {
            display: flex; justify-content: center; background-color: #3498db; padding: 10px 0;
        }
        .navbar li {
            list-style: none; margin: 0 15px;
        }
        .navbar a {
            color: white; text-decoration: none; padding: 10px; transition: background-color 0.3s;
        }
        .navbar a:hover, .navbar a.active {
            background-color: #2980b9; border-radius: 5px;
        }
        .cart-items { margin-top: 30px; }
        .checkout-button {
            display: block; margin: 20px auto; padding: 10px 20px; background-color: #3498db;
            color: white; text-align: center; text-decoration: none; border-radius: 5px; width: 150px;
            transition: background-color 0.3s;
        }
        .checkout-button:hover { background-color: #2980b9; }
    </style>
</head>
<body>
    <ul class="navbar">
        <li><a href="page2.php">Home</a></li>
        <li><a href="buildmachine.php">Build Your PC</a></li>
        <li><a href="components.php">Components</a></li>
        <li><a href="cart.php" class="active">Cart</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    <div class="container">
        <h1>Your Cart</h1>
        <div class="cart-items">
            <h2>Selected Components</h2>
            <ul>
                <?php displayCart(); ?>
            </ul>
            <h3>Total Price: ₹<?= calculateTotal(); ?></h3>
        </div>
        <form method="POST">
            <button type="submit" name="checkout" class="checkout-button">Checkout</button>
        </form>
    </div>
</body>
</html>
