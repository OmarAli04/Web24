<?php
session_start(); // Start a session to store error messages
// Check if the user is logged in 
if (!isset($_COOKIE['user_data'])) {
    header("Location: /Web24/login.php"); // Redirect to login page if not logged in
    exit();
}

$connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

$credentials = $_COOKIE['user_data'];

$userdata = json_decode($credentials, true);

$username = $userdata['username'];

$query = "SELECT * FROM booking WHERE username = '$username'";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Do something with the booking data
        $bookingref =  $row["id"] ;
        $pickupdate =  $row["pickup"] ;
        $dropoffdate =  $row["dropoff"] ;
        $car =   $row["car"] ;
        $customername =  $row["customername"] ;
        $phone =  $row["phone"] ;
        // ...
    }
} else {
    $bookingref =  "" ;
    $pickupdate =  "" ;
    $dropoffdate =  "" ;
    $car =   "" ;
    $customername =  "" ;
    $phone =  "";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link rel="stylesheet" href="bookings.css">
    <script src="session-timeout.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <div class="logo">
                    <a href="home.php"><img src="logo.png" alt=""></a>
                </div>
                <!-- <li><a href=""><img src="logo.png" alt="" class="logo"></a> </li> -->
                <li><a href="home.php">Home</a></li>
                <li><div class="dropdown">
                    <button class="drop"> Our Fleet 
                    <i class="fa fa-caret-down"></i></button>
                    <div class="dropcontent">
                        <a href="luxury.php">Luxury Car Rentals</a>
                        <a href="sport.php">Sport Car Rentals</a>
                        <a href="suv.php">SUV Car Rentals</a>
                    </div>
    
                </div></li>
                
                <div class="arrow1">
                    <li><i><img src="caret-down-solid.svg" alt=""></i></li>
                </div>
    
                <li><a href="contactus.php">Contact Us</a></li>
                <li><div class="dropdown">
                <button class="user"> <i><img src="user.png" alt=""></i>
                    <i class="fa fa-caret-down"></i></button>
                <div class="dropcontent">
                    <a href="bookings.php">Bookings</a>    
                    <a href="/Web24/login.php">Sign Out</a>

                </div>			
                </div></li>
                <div class="arrow2">
                <li><i><img src="caret-down-solid.svg" alt=""></i></li>
                </div>
            </ul>
        </nav>
    </header>
    <br>
    <h2 style="margin-left: 25px; "><?php echo  $username; ?>'s Most Recent Booking</h2>
    <div class="decor"> <img src="line.png" alt=""></div>
    <br>
    <div class="bookinglist">
        <div class="booking">
        <span class="text7">Registered Name: <?php echo  $customername; ?></span>
        <span class="text2">Booking Reference Number: <?php echo $bookingref ?></span>
        <span class="text3">Vehicle Model: <?php echo  $car; ?></span>
        <span class="text4">Registered Phone Number: <?php echo  $phone; ?></span>
        <span class="text5">Pickup Date: <?php echo  $pickupdate; ?></span>
        <span class="text6">Dropoff Date: <?php echo  $dropoffdate; ?></span>



        </div>

    </div>
    
</body>
</html>

