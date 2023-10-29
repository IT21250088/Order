<?php
$conn = new mysqli("localhost", "root", "", "laundry");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderId = $_POST["order_id"];

    // Delete the record from the database
    $sql = "DELETE FROM `order` WHERE id = $orderId";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>
