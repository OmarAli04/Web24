<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Messages</title>
    <script src="session-timeout.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
            display: flex; /* Use Flexbox */
            flex-direction: column; /* Arrange items in a column */
            align-items: center; /* Center items horizontally */
            justify-content: flex-start; /* Align items at the start */
            min-height: 100vh; /* Minimum height of 100% of viewport */
            width: 100vw; /* Full width of the viewport */
            background-color: #f4f4f4; /* Light background for contrast */
            overflow-y: auto; /* Allow vertical scrolling */
        }

        h2 {
            margin: 20px 0; /* Space below the heading */
        }

        table {
            width: 600px; /* Fixed width for the table */
            margin: 0 auto; /* Centers the table on the page */
            border-collapse: collapse; /* Remove gaps between table cells */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
        }

        th, td {
            border: 1px solid #ddd; /* Add border to table cells */
            padding: 12px; /* Padding inside table cells */
            text-align: left; /* Align text to the left */
            word-wrap: break-word; /* Allow long words to break and wrap */
            max-width: 150px; /* Set a max width for table cells */
        }

        th {
            background-color: #ee8719; /* Change heading background */
            color: white; /* Heading text color */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* Zebra stripe effect */
        }

        button {
            margin-top: 20px;
            padding: 10px 20px; /* Add horizontal padding */
            background-color: #ee8719; /* Button background color */
            color: white; /* Button text color */
            border: none; /* No border */
            border-radius: 4px; /* Rounded corners */
            cursor: pointer; /* Pointer on hover */
            transition: background-color 0.3s; /* Smooth transition */
        }

        button:hover {
            background-color: #bf701b; /* Button hover color */
        }
    </style>
</head>
<body>
    <?php include('employeeAC.php'); ?>
    <h2>Contact Us Messages</h2>

    <?php
    $connect = mysqli_connect("localhost", "root", "", "exotic-rentals", 3306);

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT customername, email, usermessage FROM contactus";
    $result = mysqli_query($connect, $sql);

    if ($result === false) {
        echo "<p>Error executing the query: " . mysqli_error($connect) . "</p>";
    } elseif (mysqli_num_rows($result) > 0) {
        echo "<table>
                <tr>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>User Message</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["customername"]) . "</td>
                    <td>" . htmlspecialchars($row["email"]) . "</td>
                    <td>" . htmlspecialchars($row["usermessage"]) . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No contact us messages found.</p>";
    }

    mysqli_close($connect);
    ?>

    <button onclick="location.href='employeehome.php'">Go to Home</button>
</body>
</html>
