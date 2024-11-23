<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Bookings</title>
    <script src="session-timeout.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
            height: 100vh; /* Full viewport height */
            margin: 0;
            background-color: #f4f4f4;
            padding: 20px; /* Add padding to avoid content touching the edges */
            box-sizing: border-box; /* Include padding in height and width calculations */
            overflow: hidden; /* Prevent body from scrolling */
        }

        .container {
            width: 100%;
            max-width: 800px; /* Limit the maximum width */
            max-height: 80vh; /* Limit the maximum height */
            background-color: white; /* Background for the table container */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
            padding: 20px; /* Padding inside the container */
            display: flex; /* Enable flexbox */
            flex-direction: column; /* Arrange items in a column */
            overflow-y: auto; /* Enable vertical scrolling */
        }

        table {
            border-collapse: collapse;
            width: 100%; /* Make table responsive */
            margin-top: 20px; /* Space above the table */
            transition: box-shadow 0.3s ease; /* Smooth transition for hover effect */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #ee8719; /* Header color */
            color: white; /* Header text color */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* Alternating row colors */
        }

        button {
            display: block; /* Make the button a block element */
            background-color: #ee8719; /* Button color */
            color: white; /* Button text color */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 20px auto; /* Center the button horizontally */
            transition: background-color 0.3s, transform 0.2s; /* Smooth transition for button */
            width: fit-content; /* Set the width based on content */
        }

        button:hover {
            background-color: #bf701b; /* Button hover color */
            transform: scale(1.05); /* Slightly increase button size on hover */
        }

        /* Style for "No bookings found" message */
        .no-bookings {
            text-align: center; /* Center the message */
            color: #666; /* Lighter text color */
            margin-top: 20px; /* Space above the message */
        }
    </style>
</head>
<body>

<div class="container">

    <?php
    // Create connection
    $conn = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch booking data from the database
    $sql = "SELECT pickup, dropoff, car, customername FROM booking";
    $result = $conn->query($sql);

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Pickup</th>
                    <th>Dropoff</th>
                    <th>Car</th>
                    <th>Customer Name</th>
                </tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["pickup"] . "</td>
                    <td>" . $row["dropoff"] . "</td>
                    <td>" . $row["car"] . "</td>
                    <td>" . $row["customername"] . "</td>
                </tr>";
        }
        echo "</table>";

        echo "<button onclick=\"location.href='employeehome.php'\">Go to Home Page</button>";
    } else {
        echo "<div class='no-bookings'>No bookings found.</div>";
    }

    // Close connection
    $conn->close();
    ?>
</div>

</body>
</html>
