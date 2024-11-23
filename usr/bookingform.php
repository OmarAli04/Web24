<?php

session_start();
// Check if the user is logged in 
if (!isset($_COOKIE['user_data'])) {
  header("Location: /Web24/login.php"); // Redirect to login page if not logged in
  exit();
}

$connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}



if ($_SERVER["REQUEST_METHOD"] == "POST"){

  $pickupdate =  mysqli_real_escape_string($connect, $_POST["pickup-date"]);
  $dropoffdate = mysqli_real_escape_string($connect, $_POST['return-date']);
  $car =  mysqli_real_escape_string($connect, $_POST['vehicles']);
  $name = mysqli_real_escape_string($connect, $_POST['name']);
  $phone = mysqli_real_escape_string($connect, $_POST['phone']);

  $user = $_COOKIE['user_data'];

  $userdata = json_decode($user, true);

  $username = $userdata['username'];



  $sql = "INSERT INTO booking (pickup, dropoff, car, customername, phone, username) VALUES ('$pickupdate', '$dropoffdate' , '$car', '$name', '$phone', '$username')";

  $result = mysqli_query($connect, $sql);

  if ($result) {
      // Display success message
      echo "Booking submitted successfully";
      header("Location: IDupload.php");
  } else {
      // Display error message
      echo "Error: " . $sql . "<br>" . mysqli_error($connect);
  }
  
  
}


// Close database connection
mysqli_close($connect);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="bookingform.css">
    <script src="session-timeout.js"></script>
</head>
<body>
    <div class="booking-form ">
        <h2>Book Your Exotic Car</h2>
        <form id="booking-form" method="POST">
          <div class="form-group">
            <label for="pickup-date">Pickup date:</label>
            <input type="date" id="pickup-date" name="pickup-date" required>
          </div>
          <div class="form-group">
            <label for="return-date">Return date:</label>
            <input type="date" id="return-date" name="return-date" required>
          </div>
            <div class="form-group">
            <label for="return-date">Select Car:</label>
            <select name="vehicles" id="">
                <option value="Select vehicles">Select Vehicles</option>
                <option value="Mercedes-Benz G800 BRABUS">Mercedes-Benz G800 BRABUS</option>
                <option value="Rolls-Royce Ghost">Rolls-Royce Ghost</option>
                <option value="Range Rover P530 Hybrid">Range Rover P530 Hybrid</option>
                <option value="Mercedes-Benz S680 MAYBACH">Mercedes-Benz S680 MAYBACH</option>
                <option value="Bentley Continental GT Convertible">Bentley Continental GT Convertible</option>
                <option value="Bentley Bentayga">Bentley Bentayga</option>
                <option value="Mercedes-Benz GLS 600 MAYBACH">Mercedes-Benz GLS 600 MAYBACH</option>
                <option value="Rolls-Royce Ghost Series II">Rolls-Royce Ghost Series II</option>
                <option value="Ferrari F8 Spider">Ferrari F8 Spider</option>
                <option value="Lamborghini Urus">Lamborghini Urus</option>
                <option value="Ferrari F8 Tributo">Ferrari F8 Tributo</option>
                <option value="Lamborghini Huracán EVO Spyder">Lamborghini Huracán EVO Spyder</option>
                <option value="Audi R8 Coupé">Audi R8 Coupé</option>
                <option value="Ferrari Roma">Ferrari Roma</option>
                <option value="Chevrolet Corvette Stingray C8">Chevrolet Corvette Stingray C8</option>
                <option value="Chevrolet Camaro RS">Chevrolet Camaro RS</option>
                <option value="Bentley Bentayga">Bentley Bentayga</option>
                <option value="Cadillac Escalade Sport Platinum">Cadillac Escalade Sport Platinum</option>
                <option value="Mercedes-Benz GLE53 AMG Kit 63">Mercedes-Benz GLE53 AMG Kit 63</option>
                <option value="Audi RS Q8">Audi RS Q8</option>
                <option value="Range Rover Vogue Supercharged">Range Rover Vogue Supercharged</option>
                <option value="BMW X4 M Kit">BMW X4 M Kit</option>
                <option value="Maserati Levante">Maserati Levante</option>
                <option value="Lexus GX 460">Lexus GX 460</option>
                
            </select>
          </div>
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required>
          </div>
          <button type="submit">Submit</button>
        

        
      </form>
      </div>
</body>

<script>
/*

document.getElementById("booking-form").addEventListener("submit", function(event) {
    event.preventDefault(); 

    
    var popup = document.getElementById("booking-popup");
    popup.classList.add("show");
  });

*/

</script>

</html>

