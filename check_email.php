<?php
$connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_GET["email"];

    // Check if the email already exists
    $query = "SELECT * FROM cred WHERE email = '$email'";
    $result = mysqli_query($connect, $query);

    $response = array("exists" => mysqli_num_rows($result) > 0);
    echo json_encode($response);
}

mysqli_close($connect);
?>
