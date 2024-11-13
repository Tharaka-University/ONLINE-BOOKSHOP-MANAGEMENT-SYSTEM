<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookshop_db"; // Replace with your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_phone = $_POST['customer_phone'];
    $books = $_POST['books'];

    // Prepare the SQL statement to insert the order into the database
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_email, customer_phone, books) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $customer_name, $customer_email, $customer_phone, $books);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Order placed successfully!";
    } else {
        echo "Error placing order: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>
