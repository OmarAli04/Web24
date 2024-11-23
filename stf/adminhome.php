<?php include('adminAC.php'); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="session-timeout.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            height: 100vh; /* Full viewport height */
            margin: 0;
            background-color: #f4f4f4;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto; /* Center table horizontally */
            flex-grow: 1; /* Allow the table to grow and fill the available space */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #ee8719;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        button {
            background-color: #ee8719;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 20px auto; /* Center button */
        }

        button:hover {
            background-color: #bf701b;
        }
    </style>
</head>
<body>
    
    <?php

    $conn = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to get user credentials and concatenated booking data
    $sql = "SELECT cred.username, cred.pswd, cred.email, cred.rol, 
            GROUP_CONCAT(CONCAT(booking.pickup, ' to ', booking.dropoff, ': ', booking.car, ' (Phone: ', booking.phone, ')') SEPARATOR '<br>') AS bookings
            FROM cred
            LEFT JOIN booking ON cred.username = booking.username
            GROUP BY cred.username, cred.pswd, cred.email, cred.rol";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Bookings</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["username"] . "</td>
                    <td>" . $row["pswd"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["rol"] . "</td>
                    <td>" . $row["bookings"] . "</td>
                </tr>";
        }
        echo "</table>";

        echo "<button onclick=\"location.href='/Web24/login.php'\">Sign Out</button>";
    } else {
        echo "<p>No records found.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
