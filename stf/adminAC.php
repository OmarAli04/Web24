<?php
$connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

if (isset($_COOKIE['user_data'])) {
    $credentials = $_COOKIE['user_data'];
    $userdata = json_decode($credentials, true);

    if (isset($userdata['username'])) {
        $username = $userdata['username'];
        $query = "SELECT rol FROM cred WHERE username = '$username'";
        $result = mysqli_query($connect, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($row && $row['rol'] === 'admin') {
                
            } else {
                header("Location: /Web24/403.html");
                exit();
            }
        } else {
            echo "Error: " . mysqli_error($connect);
        }
    } else {
        echo "Invalid user data format.";
        header('Location: /Web24/login.php');
    }
} else {
    // Handle the case where 'user_data' cookie is not set
    echo "User data not found.";
    header('Location: /Web24/login.php');
}
?>
