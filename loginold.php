
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
        <label for="mfaPin">MFA PIN (8 digits):</label>
        <input type="text" id="mfaPin" name="mfaPin" pattern="\d{8}" title="Enter an 8-digit PIN" required>
        <input type="submit" value="Login">
        <h6>Not a Registered User? <a href="index.php">Sign Up</a> Instead</h6>
	</form>
</body>
</html>

<?php
session_start();
$_SESSION['login_time'] = time();
$connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

function sanitizeInput($input) {

  $input = trim($input);
  
  $input = stripslashes($input);

  $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

  return $input;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = sanitizeInput($_POST["username"]);
  $password = sanitizeInput($_POST["pswd"]);
  $mfaPin = sanitizeInput($_POST["mfaPin"]);
  
  $data = array(
	'username' => $_POST["username"],
  );
  
  $data_json = json_encode($data);

  setcookie('user_data', $data_json, [
    'expires' => time() + (86400 * 30), // 86400 = 1 day
    'path' => '/',
    'samesite' => 'Strict', // Set SameSite attribute
  ]);
  
  $query = "SELECT * FROM cred WHERE username=? AND pswd=?";
  $stmt = mysqli_prepare($connect, $query);
  mysqli_stmt_bind_param($stmt, "ss", $username, $password);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  
  if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $storedMfaPin = $row['mfa_pin'];

    if ($storedMfaPin == $mfaPin) {
      $role = $row['rol'];

      if ($role == 'admin') {
        header("Location: adminhome.php");
        exit();
      } elseif ($role == 'user') {
        header("Location: home.php");
        exit();
      }elseif ($role == 'employee') {
        header("Location: employeehome.php");
        exit();
      } 
    } else {
      echo "Invalid MFA PIN";
    }
  } else {
    // Handle invalid credentials here
    echo "Invalid Password or Username";
  }
}




mysqli_close($connect);

?>
