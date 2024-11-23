<?php 
    session_start(); // Start a session to store error messages

    // Check if the user is logged in and the 2FA code is set
    if (!isset($_COOKIE['user_data'])) {
        header("Location: /Web24/login.php"); // Redirect to login page if not logged in
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="luxury.css">
    <script src="luxury.js"></script>
    <title>Luxury Car Rentals</title>
    <script src="session-timeout.js"></script>
</head>
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
<body>

    <h2 style="margin-left: 25px;">Luxury Car Rentals</h2>
    <div class="decor"> <img src="line.png" alt=""></div>

    <div class="menu-grid">
        <div class="menu-row">
            <div class="pizza-item">
                <br>
                <img src="/Web24/luxury/Mercedes-Benz-G-800-Brabus.jpg" alt="Pizza 1">
                <h3>Mercedes-Benz G800 BRABUS</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2023</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 800 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 5 Seater</h3>
                </div >
                <div class="pricingcart">
                <h3>EGP 33,750 <h6>/Per Day</h6></h3>
                <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                </div>
                <br>
            </div >
            <div class="pizza-item">
                <br>
                <img src="/Web24/luxury/Rolls-Royce-Ghost.jpg" alt="Pizza 2">
                <h3>Rolls-Royce Ghost</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2020</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 800 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 5 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 29,150 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>
            </div>
            <div class="pizza-item">
                <br>
                <img src="/Web24/luxury/Range-Rover-P530-Hybrid-1.jpg" alt="Pizza 3">
                <h3>Range Rover P530 Hybrid</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2023</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 530 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 5 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 18,750 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>            </div>
            <div class="pizza-item">
                <br>
                <img src="/Web24/luxury/Mercedes-Benz-S680-MAYBACH-1-scaled.jpg" alt="Pizza 4">
                <h3>Mercedes-Benz S680 MAYBACH</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2023</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 621 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 4 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 27,500 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>            </div>

            <div class="pizza-item">
                <br>
                <img src="/Web24/luxury/continentallux.jpg" alt="Pizza 5">
                <h3>Bentley Continental GT Convertible</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2021</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 626 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 4 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 27,500 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>                <br>
            </div>
            <div class="pizza-item">
                <br>
                <img src="/Web24/luxury/bentaygalux.jpg" alt="Pizza 6">
                <h3>Bentley Bentayga</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2021</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 626 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 5 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 24,150 <h6>/Per Day</h6></h3>
                    <a  href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>            
                </div>
            <div class="pizza-item">
                <br>
                <img src="/Web24/luxury/Mercedes-Benz-GLS-600-Maybach-1_1280x720.png" alt="Pizza 7">
                <h3>Mercedes-Benz GLS 600 MAYBACH</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2022</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 550 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 4 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 20,995 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>            
                </div>
            <div class="pizza-item">
                <br>
                <img src="/Web24/luxury/darkseries.jpg" alt="Pizza 8">
                <h3>Rolls-Royce Ghost Series II</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2017</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 563 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 5 Seater</h3>
                </div>                
                <div class="pricingcart">
                    <h3>EGP 18,300 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>
                </div>
    </div>
</body>

<script>

var btn

</script>

</html>