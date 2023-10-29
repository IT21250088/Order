<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="viewOrders.css">
</head>

<body>
      <!--Header Start-->
      <header class="head">

<div id="logo">
    <a href="home.html"><img class="logo" src="./Images/logo.jpg" alt="Image Not Found" width="107px" height="110px"></a>
 </div>



<div >
    <p id="note">Soft Touch</p>
    <br>
    
</div>

        <ul id="navi">
            <li id="navi"><a href = "">Home</a></li>
            <li id="navi"><a href = "">About Us</a></li>
            <li id="navi"><a href = "">Service</a></li>
            <li id="navi"><a href = "">Track</a></li>
            <li id="navi"><a href = "">Pricing</a></li>
            <li id="navi"><a href = "">Order</a></li>
            <li id="navi"><a href = "">Contact Us</a></li>
            <input type="text" class="search" placeholder="Search..">
        </ul>

</header>
<!--Header End-->
<br>

    <div class="container">
        <h1 class="title">Order Details</h1>

        <!-- HTML Form for user input -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="email">Enter your email:</label><br>
            <input type="text" id="email" name="email" class="cemail" placeholder="" required>
            <button type="submit" class="btn2">Search</button>
        </form>
    </div>
    <div class="card-container">
        <?php
        // Database connection
        $conn = new mysqli("localhost", "root", "", "laundry");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
            $email = $_POST["email"];

            $sql = "SELECT * FROM `order` WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<h2>' . $row["name"] . '</h2>';
                    echo '<p><strong>Email:</strong> ' . $row["email"] . '</p>';
                    echo '<p><strong>Phone:</strong> ' . $row["phone"] . '</p>';
                    echo '<p><strong>Order:</strong> ' . $row["tdetails"] . '</p>';
                    echo '<p><strong>Weight:</strong> ' . $row["weight"] . ' kg</p>';
                    // Add a delete button
                    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
                    echo '<input type="hidden" name="order_id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="btn-delete">Delete</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "No data found for the provided email.";
            }
        }

        // Handle delete request
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
            $order_id = $_POST['order_id'];
            $delete_sql = "DELETE FROM `order` WHERE id = '$order_id'";

            if ($conn->query($delete_sql) === TRUE) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <br>

 <!--Footer Start-->
 <footer>

<div class="first">
    
    <h4>Support Now</h4>
    <h5>Refresh your world, one load at a time</h5>
    <h5>Tel - 07xxxxxxxx</h5>
    <h5>Email - example@gmail.com</h5>
    
</div>

<div class="third">
    Locate Us
    <a href="https://www.google.com/maps/place/Sri+Lanka+Institute+of+Information+Technology/@6.9146775,79.9707558,17z/data=!3m1!4b1!4m5!3m4!1s0x3ae256db1a6771c5:0x2c63e344ab9a7536!8m2!3d6.9146775!4d79.9729445" style="color: white;"><i class="fa fa-map-marker" aria-hidden="true" style="font-size: 25px;"></i></a>
    <br><br><br><br><br><br><br>
    
</div>

<div class="second">
    Find Us :
    <a href="https://www.facebook.com/" class="fa fa-facebook"></a>
    <a href="https://www.linkedin.com/" class="fa fa-linkedin"></a>
    <a href="https://twitter.com/?lang=en" class="fa fa-twitter"></a>
    <a href="https://www.instagram.com/?hl=en" class="fa fa-instagram"></a>
    <h3>Quick Links</h3>
    <a class="foot" href="">Privacy & Policy</a><br>
    <a class="foot" href="">Terms & Conditions</a><br>
</div>

</footer>
<!--Footer End-->


</body>

</html>
