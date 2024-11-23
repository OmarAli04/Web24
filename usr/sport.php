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
    <title>Sport Car Rentals</title>
    <link rel="stylesheet" href="sport.css">
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

    <h2 style="margin-left: 25px;">Sport Car Rentals</h2>
    <div class="decor"> <img src="line.png" alt=""></div>

    <div class="menu-grid">
        <div class="menu-row">
            <div class="pizza-item">
                <br>
                <img src="/Web24/Sports/f8spider.jpg" alt="Pizza 1">
                <h3>Ferrari F8 Spider</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2023</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 710 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 2 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 35,000 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>                
                <br>
            </div >
            <div class="pizza-item">
                <br>
                <img src="/Web24/Sports/uruswhite.jpg" alt="Pizza 2">
                <h3>Lamborghini Urus</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2021</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 650 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 5 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 26,500 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>            
                </div>
            <div class="pizza-item">
                <br>
                <img src="/Web24/Sports/f8tributo.jpg" alt="Pizza 3">
                <h3>Ferrari F8 Tributo</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2023</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 710 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 2 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 26,500 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>            
                </div>
            <div class="pizza-item">
                <br>
                <img src="/Web24/Sports/hurucan.jpg" alt="Pizza 4">
                <h3>Lamborghini Huracán EVO Spyder</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2023</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 640 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 2 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 26,500 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>            
                </div>

            <div class="pizza-item">
                <br>
                <img src="/Web24/Sports/audir8.jpg" alt="Pizza 5">
                <h3>Audi R8 Coupé</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2021</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 602 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 2 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 14,800 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>                
                    <br>
            </div>
            <div class="pizza-item">
                <br>
                <img src="/Web24/Sports/roma.jpg" alt="Pizza 6">
                <h3>Ferrari Roma</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2023</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 612 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 4 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 25,000 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>            
                </div>
            <div class="pizza-item">
                <br>
                <img src="/Web24/Sports/c8.jpg" alt="Pizza 7">
                <h3>Chevrolet Corvette Stingray C8</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2021</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 495 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 2 Seater</h3>
                </div>
                <div class="pricingcart">
                    <h3>EGP 12,750 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>            
                </div>
            <div class="pizza-item">
                <br>
                <img src="/Web24/Sports/RS.jpg" alt="Pizza 8">
                <h3>Chevrolet Camaro RS</h3>
                <div class="info">
                    <h3><i><img src="/Web24/icons/calendar-solid-svg.png" alt=""></i> 2020</h3>
                    <h3><i><img src="/Web24/icons/engine-motor-icon-svg.png" alt=""></i> 335 HP</h3>
                    <h3><i><img src="/Web24/icons/seat-icon-svg.png" alt=""></i> 4 Seater</h3>
                </div>                
                <div class="pricingcart">
                    <h3>EGP 7,500 <h6>/Per Day</h6></h3>
                    <a href="bookingform.php" class="add-to-cart-btn">Book Now</a>
                    </div>        
                </div>
    </div>
</body>
</html>