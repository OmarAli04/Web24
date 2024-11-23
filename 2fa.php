<?php
session_start();

$connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

$code = $_SESSION['twoFACode'];
echo $code; 

// Check if the user is logged in and the 2FA code is set
if (!isset($_SESSION['username']) || !isset($_SESSION['twoFACode'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}


// Connect to the database
$connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user role from the database
$username = $_SESSION['username']; // Assuming username is stored in the session
$query = "SELECT rol FROM cred WHERE username=?";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);    

$row = mysqli_fetch_assoc($result);
$role = $row['rol']; // Get the user's role

// Function to sanitize user input
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredCode = sanitizeInput($_POST['2fa_code']);

    $data = array(
        'username' => $_SESSION['username'],
      );
      
      $data_json = json_encode($data);
    
      setcookie('user_data', $data_json, [
        'expires' => time() + 3600, // 1 hour
        'path' => '/',
        'samesite' => 'Strict', // Set SameSite attribute
        'httponly' => true,
      ]);
  
      
    
    // Check if the entered code matches the one stored in the session
    if ($enteredCode == $_SESSION['twoFACode']) {
        // Successful 2FA verification, redirect based on role
        if ($role == 'admin') {
            header("Location: /Web24/stf/adminhome.php"); // Admin home page
        } elseif ($role == 'user') {
            header("Location: /Web24/usr/home.php"); // Regular user home page
        } elseif ($role == 'employee') {
            header("Location: /Web24/stf/employeehome.php"); // Employee home page
        } else {
            // Default case if role is not recognized
            header("Location: login.php"); // Default home page
        }
        exit();
    } else {
        $error = "Invalid 2FA code. Please try again.";
    }
}

// Close the database connection
mysqli_stmt_close($stmt);
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter 2FA Code</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9; /* Light background for contrast */
            color: #333; /* Dark text color */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Heading Styles */
        h1 {
            margin-bottom: 20px; /* Space below the heading */
        }

        /* Form Styles */
        form {
            background-color: white; /* White background for the form */
            padding: 30px; /* Increased padding for more space */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Enhanced shadow for depth */
            width: 300px; /* Fixed width for better layout */
            text-align: center; /* Center text in the form */
        }

        /* Input Styles */
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"] {
            width: calc(100% - 20px); /* Adjust width to account for padding */
            padding: 10px;
            margin-bottom: 20px; /* Space below input */
            border: 1px solid #ce6a00; /* Border color */
            border-radius: 4px;
            transition: border-color 0.3s;
            font-size: 16px; /* Increase font size for better readability */
        }

        input[type="text"]:focus {
            border-color: #ee8719; /* Focus color */
            outline: none;
        }

        /* Submit Button Styles */
        input[type="submit"] {
            background-color: #ee8719; /* Button background color */
            color: white; /* Button text color */
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px; /* Increase font size for better readability */
            width: 100%; /* Full width */
        }

        input[type="submit"]:hover {
            background-color: #ce6a00; /* Hover background color */
        }

        /* Error Message Styles */
        p {
            margin-top: 10px;
            color: red; /* Error message color */
        }
    </style>
    <link rel="stylesheet" href="enter_2fa.css"> <!-- Optional CSS file for styling -->
</head>
<body>

    <h1>Enter 2FA Code</h1>
    
    <form method="POST">
        <label for="2fa_code">2FA Code:</label>
        <input type="text" id="2fa_code" name="2fa_code" pattern="\d{6}" required placeholder="Enter the 6-digit code">
        <input type="submit" value="Verify">
        
        <?php if (isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </form>

</body>
</html>
