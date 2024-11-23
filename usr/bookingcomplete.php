<?php
session_start(); // Start a session to store error messages
// Check if the user is logged in 
if (!isset($_COOKIE['user_data'])) {
    header("Location: /Web24/login.php"); // Redirect to login page if not logged in
    exit();
}

// Connect to database
$connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);


// SELECT query to get the latest data
$sql = "SELECT * FROM booking ORDER BY id DESC LIMIT 1";
$result = mysqli_query($connect, $sql);

if ($row = mysqli_fetch_assoc($result)) {
  $latest_booking = $row;
}

$connect->close();


?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successful Booking</title>
    <script src="session-timeout.js"></script>
    <style>
        body{
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            max-width: 800px;
            background-image: url(/Web24/extraimages/bookingcompletebackground.jpg);
        }

        .button1, .button2{
            text-decoration: none;
            border: 2px solid #ce6a00;
            padding: 13px 35px;
            color: #ce6a00;
        }

        .button1:hover, .button2:hover{
            color: #fff;
            background-color: #ce6a00;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);

        }

        .button1{
            position: fixed;
            left: 43%;
            top: 77%;
            transform: translate(-50%, -50%);
        }

        .button2{
            position: fixed;
            left: 57%;
            top: 77%;
            transform: translate(-50%, -50%);
        }

        .popup  {

            width: 160px;
            background-color: #fff;
            color: black;
            text-align: center;
            border-radius: 6px;
            border: 2px solid #ce6a00;
            padding: 350px 550px;
            z-index: 10;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            }


        .ptext1{
            display: block;
            margin: 0 auto;
            font-size: 40px;
            width: 850px;
            position: fixed;
            left: 50%;
            top: 8%;
            transform: translate(-50%, -50%);
        }

        .ptext2{
            display: block;
            margin: 0 auto;
            font-size: 35px;
            width: 1000px;
            position: fixed;
            left: 50%;
            top: 27%;
            transform: translate(-50%, -50%);
        }

        .ptext3{
            display: block;
            margin: 0 auto;
            font-size: 35px;
            width: 1000px;
            position: fixed;
            left: 50%;
            top: 42%;
            transform: translate(-50%, -50%);
        }
        
        .ptext4{
            display: block;
            margin: 0 auto;
            font-size: 35px;
            width: 1000px;
            position: fixed;
            left: 50%;
            top: 66%;
            transform: translate(-50%, -50%);
        }

        .ptext5{
            display: block;
            margin: 0 auto;
            font-size: 35px;
            width: 1000px;
            position: fixed;
            left: 50%;
            top: 55%;
            transform: translate(-50%, -50%);
        }

        .decor{
            position: fixed;
            left: 50%;
            top: 19%;
            display: flex;
            height: 20px;
            transform: translate(-50%, -50%);
        }

        .mtext{
            display: block;
            margin: 0 auto;
            font-size: 15px;
            width: 1000px;
            position: fixed;
            left: 50%;
            top: 90%;
            transform: translate(-50%, -50%); 
        }


    </style>

</head>
<body>
    <div class="popup" id="booking-popup">
        <span class="ptext1"><b> Booking Confirmed <?php echo  $latest_booking['customername']; ?> !</b></span>
        <span ><div class="decor"><img src="longline.svg" alt=""></div></span>
        <span class="ptext2">Thank you for booking The <?php echo  $latest_booking['car']; ?> </span>
        <span class="ptext3">We will contact you shortly on the following number: <?php echo  $latest_booking['phone']; ?></span>
        <span class="ptext5">Pickup Date: <?php echo  $latest_booking['pickup']; ?>  Dropoff Date: <?php echo  $latest_booking['dropoff']; ?> </span>
        <span class="ptext4">Your booking reference is: <?php echo  $latest_booking['id']; ?> </span>
        <span ><a class="button1" href="home.php">Home</a> <a class="button2" href="bookings.php">Bookings</a></span>
        <span class="mtext">Please remember your booking reference number as this will be used to identify and validate the customer upon contact, our team contacts customers
            in around 30 minutes to 2 hours from booking time. For same day bookings our team works faster to contact customers to insure no delay. If you have booked your car 
            & have not been contacted yet, fill out our contact us form and a representative from our customer support team will escelate the request to our contacting team. 
            Thank you for your booking, Exotic Rentals 2023
        </span>
      </div>
</body>
</html>

