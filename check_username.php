<?php
$connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = $_GET["username"];

    // Check if the username already exists
    $query = "SELECT * FROM cred WHERE username = '$username'";
    $result = mysqli_query($connect, $query);

    $response = array("exists" => mysqli_num_rows($result) > 0);
    echo json_encode($response);
}

mysqli_close($connect);
?>
