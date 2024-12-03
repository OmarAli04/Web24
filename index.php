<!DOCTYPE html>
<html>
<head>

	<title>Sign Up</title>
	<link rel="stylesheet" href="signup.css">
</head>
<body>
	
	<h1>Sign Up</h1>
	<form method="POST" onsubmit="return passwordRequirements()">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required oninput="checkUsername()">
		<span id="usernameError" style="color: red;"></span>
		<label for="password">Password:</label>
		<div style="position:relative;">
			<input type="password" id="pswd" name="pswd" required>
			<span class="show-password" onclick="togglePassword()">👁️</span>
		</div>
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required oninput="checkEmail()">
		<span id="emailError" style="color: red;"></span>
		
		<input type="submit" value="Sign Up" id="submit">
		<h6>Are you a Registered User? <a href="login.php">Login</a> Instead</h6>
	</form>
	<script>
		function togglePassword() {
			var password = document.getElementById("pswd");
			if (password.type === "password") {
				password.type = "text";
			} else {
				password.type = "password";
			}
		}

		function  checkUsername() {
			var username = document.getElementById("username").value;
            var usernameError = document.getElementById("usernameError");

			var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.exists) {
                        usernameError.textContent = "Username already exists. Please choose a different username.";
                    } else {
                        usernameError.textContent = "";
                    }
                }
            };

			xhr.open("GET", "check_username.php?username=" + username, true);
            xhr.send();
		}

		function checkEmail() {
			var email = document.getElementById("email").value;
        	var emailError = document.getElementById("emailError");

			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4 && xhr.status == 200) {
					var response = JSON.parse(xhr.responseText);
					if (response.exists) {
						emailError.textContent = "Email already exists. Please choose a different email.";
					} else {
						emailError.textContent = "";
					}
				}
			};
			xhr.open("GET", "check_email.php?email=" + email, true);
        	xhr.send();
		}
		function passwordRequirements() {
			var usernameError = document.getElementById("usernameError").textContent;
			var emailError = document.getElementById("emailError").textContent;

        	if (usernameError !== "" || emailError !== "") {
				return false;
        	}	
			var passwordField = document.getElementById("pswd");
			var passwordValue = passwordField.value;

			if (passwordValue.length < 8) {
					alert("Password must be at least 8 characters long.");
					return false;
				}

				if (!/[A-Z]/.test(passwordValue)) {
					alert("Password must contain at least one capital letter.");
					return false;
				}

				if (!/^(?=.*[A-Za-z])(?=.*\d)/.test(passwordValue)) {
					alert("Password must contain both letters and numbers.");
					return false;
				}
				
				
			}
	</script>
	
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


$connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

function generateUniquePIN($connect) {
    do {
        $pin = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
        $query = "SELECT * FROM cred WHERE mfa_pin = '$pin'";
        $result = mysqli_query($connect, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($connect));
        }	
    } while (mysqli_num_rows($result) > 0);

    return $pin;
}

$username = "";
$password = "";
$email = "";
$mfapin = generateUniquePIN($connect);

function sanitizeInput($input) {

    $input = trim($input);
    
    $input = stripslashes($input);

    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

    return $input;
}

$salting = bin2hex(random_bytes(64 / 2));

function hashPassword($password, $salt) {

    $hash = hash('sha256', $salt . $password);
	return $hash;

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = sanitizeInput($_POST["username"]);
  $password = sanitizeInput($_POST["pswd"]);
  $hashedpswd = hashPassword($password, $salting);
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  $role = "user";


  $sql = "INSERT INTO cred (username, pswd, email, salt, rol) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($connect, $sql);
  mysqli_stmt_bind_param($stmt, "sssss", $username, $hashedpswd, $email, $salting, $role);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("Location: login.php");
  exit();
}

?> 