<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MFA PIN Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #ee8719;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #bf701b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>MFA PIN Display</h1>
        <?php

            $connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

            if (!$connect) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $credentials = $_COOKIE['user_data'];

            $userdata = json_decode($credentials, true);

            $username = $userdata['username'];

            $query = "SELECT mfa_pin FROM cred WHERE username = '$username'";
            $result = mysqli_query($connect, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $mfaPin = $row['mfa_pin'];

                echo "<p>Your MFA PIN is: <strong>$mfaPin</strong></p>";
            } else {
                echo "<p>Error retrieving MFA PIN.</p>";
            }

            mysqli_close($connect);
        ?>
        <button onclick="location.href='home.php'">Go to Home</button>
    </div>
</body>
</html>
