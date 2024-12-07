<?php include('employeeAC.php'); ?>
<?php
session_start(); // Start a session to store error messages

// Include Composer's autoload file
require 'vendor/autoload.php';

use phpseclib3\Net\SFTP;
use phpseclib3\Crypt\AES;

// Load configuration securely
$config = include('C:/xampp/htdocs/web24/usr/sftpconfig.php');

// Initialize SFTP connection
$sftp = new SFTP($config['sftpServer'], $config['sftpPort']);

// Login to SFTP server
if (!$sftp->login($config['sftpUsername'], $config['sftpPassword'])) {
    $_SESSION['error'] = "SFTP login failed.";
    header("Location: /Web24/usr/IDupload.php"); // Redirect to upload page if login fails
    exit();
}

// Define the remote directories
$remoteDirectory = '/IDuploads/';
$keyDirectory = '/KMNGMT/';

// Get all files from the remote directory
$files = $sftp->nlist($remoteDirectory);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Employee IDs</title>
    <script src="session-timeout.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .image-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .image-container {
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .image-container:hover {
            transform: scale(1.05);
        }

        img {
            max-width: 150px; /* Adjust based on your requirements */
            max-height: 150px; /* Adjust based on your requirements */
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        footer {
            margin-top: 20px;
            color: #666;
        }

        /* Styles for the Home button */
        .home-button {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #ee8719; /* Button background color */
            color: #fff; /* Button text color */
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .home-button:hover {
            background-color: #bf701b; /* Darker color on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Customer IDs</h2>

    <?php
    $config = include('sftpconfig.php');
    // Display any error message if it exists
    if (isset($_SESSION['error'])) {
        echo "<p class='error-message'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']); // Clear the message after displaying
    }

    // Check if there are files to display
    if ($files && count($files) > 0) {
        echo "<div class='image-grid'>";
        foreach ($files as $file) {
            // Skip directories and non-encrypted files
            if (is_dir($file) || !preg_match('/\.enc$/i', $file)) {
                continue;
            }

            // Get the content of the encrypted file
            $remoteFilePath = $remoteDirectory . $file;
            $fileContent = $sftp->get($remoteFilePath);

            if (!$fileContent) {
                echo "<p class='error-message'>Failed to retrieve the file: $file</p>";
                continue;
            }

            // Retrieve the corresponding AES key from the KMNGMT folder
            $keyFilePath = $keyDirectory . pathinfo($file, PATHINFO_FILENAME) . '.key'; // Assumes key file has the same base name as the encrypted file
            $encryptedKeyContent = $sftp->get($keyFilePath);

            if (!$encryptedKeyContent) {
                echo "<p class='error-message'>Failed to retrieve the AES key for file: $file</p>";
                continue;
            }

            // Extract the IV from the encrypted key content
            $ivLength = 16; // AES block size for AES-256 is 16 bytes
            $iv = substr($encryptedKeyContent, 0, $ivLength);
            $encryptedAESKey = substr($encryptedKeyContent, $ivLength); // Get the encrypted AES key without the IV

            // Decrypt the AES key using the master key
            $masterKey = $config['master']; // Load your master key securely
            $decryptedAESKey = openssl_decrypt($encryptedAESKey, 'aes-256-cbc', $masterKey, OPENSSL_RAW_DATA, $iv);

            if ($decryptedAESKey === false) {
                echo "<p class='error-message'>Failed to decrypt AES key for file: $file</p>";

                continue;
            }
            
            // Check the length of the decrypted key
            if (strlen($decryptedAESKey) !== 32) {
                echo "<p class='error-message'>Decrypted key for file $file must be exactly 32 bytes.</p>";
                continue; // Skip this file if the key is not the correct length
            }

            // Set up AES decryption with the decrypted key
            $aes = new AES('cbc');
            $aes->setKey($decryptedAESKey); // Use the decrypted AES key

            // Read the encrypted file content
            $encryptedData =($fileContent);

            // Extract IV (the first 16 bytes for AES-256)
            $iv = substr($encryptedData, 0, $ivLength);
            $encryptedContent = substr($encryptedData, $ivLength);

            // Set the IV for decryption
            $aes->setIV($iv);

            // Decrypt the content
            $decryptedContent = $aes->decrypt($encryptedContent);

            // Create the URL for the decrypted image
            $fileUrl = 'data:image/png;base64,' . base64_encode($decryptedContent); // Convert to base64 for display

            // Display the decrypted image
            echo "<div class='image-container'><img src='$fileUrl' alt='$file'></div>";
            
            //echo "Master Key: "; echo bin2hex($masterKey). "<br>"; 
            //echo "Encrypted AES Key w/out IV: "; echo bin2hex($encryptedAESKey). "<br>";
            //echo "Decrypted AES Key: "; echo bin2hex($decryptedAESKey). "<br>";
            //echo "IV: "; echo bin2hex($iv);

            // Clean up temporary files
            //unlink($fileContent);
        }
        echo "</div>";
    } else {
        echo "No employee IDs found.";
    }
    ?>

    <!-- Home button linking to the home page -->
    <a href="employeehome.php" class="home-button">Home</a>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Exotic Rentals 2024</p>
    </footer>
</div>

</body>
</html>
