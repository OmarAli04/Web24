<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css">
    <script src="session-timeout.js"></script>

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
</head>
<body>
    <main>



        <div class="contact">
            <h2>Contact Exotic Rentals</h2>
            <div class="longl"><i ><img src="longline.svg" alt=""></i>
            </div>
            <span>At Exotic Rentals, we are passionate about providing our customers with the ultimate driving experience. We specialize in luxury and supercar rentals, offering an extensive selection of the world's most prestigious vehicles. Our aim is to provide a seamless and hassle-free rental experience, whether you're looking for a short-term rental or a long-term lease.
                <br><br>
                We understand that our customers have busy lives, which is why we offer flexible rental options, including pickup and drop-off at a location of your choice. Our team is dedicated to providing exceptional customer service, and we strive to make every rental an unforgettable experience.
                <br><br>
                Whether you're looking to rent a Lamborghini for a weekend getaway, or a Rolls-Royce for a special occasion, our fleet of vehicles is meticulously maintained to ensure maximum performance and comfort. We believe that driving a luxury or supercar is more than just transportation - it's an experience that should be savored and enjoyed to the fullest.
                <br><br>
                At Exotic Rentals, we value open communication with our customers and strive to provide exceptional customer service. If you have any questions or concerns about our rental services or would like to book a luxury or supercar, please feel free to contact us. Our friendly and knowledgeable team is available to assist you with any inquiries you may have. You can reach us by phone, email, or by filling out the contact form on our website. We are dedicated to making your rental experience with us as smooth and enjoyable as possible, and we look forward to hearing from you.
                <br>
                <br>
                Email: exoticrentals@gmail.com &nbsp; &nbsp; Phone Number: +201111981553
            </span>
            <br><br>
            <h2>Contact Us Form</h2>
            <br>    
            <form method='POST'>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" maxlength="255" required></textarea>

                <button class="submit-btn" type="submit">Submit</button>
            </form>
        </div>
    </main>
</body>
</html>

<?php


$connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

$username = "";
$email = "";
$message = "";

$blacklist = array("'", "/", "<script>", "</script>");

function isBlacklisted($input, $blacklist) {
    foreach ($blacklist as $term) {
        if (stripos($input, $term) !== false) {
            return true;
        }
    }
    return false;
}

function sanitizeInput($input) {

    $input = trim($input);
    
    $input = stripslashes($input);

    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

    return $input;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST["name"]);
    $message = sanitizeInput($_POST["message"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    if (isBlacklisted($username, $blacklist) || isBlacklisted($message, $blacklist)) {
        die("Your submission contains blacklisted terms. Please review your input.");
    }

    $sql = "INSERT INTO contactus (customername, email, usermessage) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $message);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    }   

?>