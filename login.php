<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="login.css">
</head>
<body>
	<h1>Login</h1>
	<form method="POST">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required>
		<label for="password">Password:</label>
		<script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    	</script>
		<div style="position:relative;">
			<input type="password" id="password" name="pswd" required>
			<span class="show-password" onclick="togglePassword()">👁️</span>
		</div>
        <input type="submit" value="Login">
        <h6>Not a Registered User? <a href="index.php">Sign Up</a> Instead</h6>
	</form>
</body>
</html>

<?php
// Clear the PHPSESSID cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}
// Clear existing cookies for user and employee
if (isset($_COOKIE['user_data'])) {
    // Clear user cookie
    setcookie('user_data', '', time() - 3600, '/'); // Expire the user cookie
}

session_start();

$_SESSION['login_time'] = time();
$connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Function to sanitize user input
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}

// Function to send email using PHPMailer
function sendEmail($to, $subject, $message) {
    $mail = new PHPMailer(true); // Create a new PHPMailer instance
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the Gmail SMTP server
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false, 
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );
        $mail->Username = 'omarali112k4@gmail.com'; // Your Gmail address
        $mail->Password = 'szin pxeg inae izeu'; // Your Gmail App Password (or your Gmail password if less secure apps are enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to        

        // Recipients
        
        $mail->setFrom('exotic-rentals.help@gmail.com', 'Exotic Rentals'); // Sender's email and name
        $mail->addAddress($to); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send(); // Send the email
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function hashPassword($password, $salt) {
    $hash = hash('sha256', $salt . $password);
	return $hash;

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Step 1: Sanitize input
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["pswd"]);

    // Step 2: Retrieve the stored hash and salt for the given username
    $query = "SELECT pswd, salt, email FROM cred WHERE username=?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $storedHash = $row['pswd']; // Retrieve the stored password hash
        $storedSalt = $row['salt']; // Retrieve the stored salt
        $email = $row['email'];    // Retrieve user email for 2FA

        // Step 3: Hash the input password with the retrieved salt
        $hashedInputPassword = hash('sha256', $storedSalt . $password);

        // Step 4: Compare the hashed input password with the stored hash
        if ($hashedInputPassword === $storedHash) {
            // Passwords match, proceed with 2FA setup
            $twoFACode = rand(100000, 999999); // Generate a random 6-digit code
            $_SESSION['twoFACode'] = $twoFACode; // Store the code in session
            $_SESSION['username'] = $username;  // Store the username in session

            // Send the 2FA code to the user's email
            sendEmail($email, 'Exotic Rentals 2FA Code', "Your 2FA code is: ($twoFACode). Do not share this code with anyone, not even Exotic Rentals employees.");  

            // Redirect to the 2FA verification page
            header("Location: 2fa.php");
            exit();
        } else {
            // Passwords do not match
            echo "Invalid Username or Password.";
            echo "    ";
            echo $hashedInputPassword;
            echo "    ";
            echo $storedSalt;
            echo "    ";
            echo $storedHash;
        }
    } else {
        // Username not found
        echo "Invalid Username or Password.";
    }
}


mysqli_close($connect);
?>
