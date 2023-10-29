<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laundry";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $tdetails = mysqli_real_escape_string($conn, $_POST["tdetails"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $weight = mysqli_real_escape_string($conn, $_POST["weight"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);

    // Prepare the SQL query and insert the data into the database
    $sql = "INSERT INTO `order` (tdetails, name, email, weight, phone)
            VALUES ('$tdetails', '$name', '$email', '$weight', '$phone')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Successfully processed
        echo "Order processed successfully. Thank you!";
        
        // Redirect after successful payment
        header("Location: viewOrder.php");
        exit();
    } else {
        // Error occurred while processing payment
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
