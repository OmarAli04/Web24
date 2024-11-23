<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Upload</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
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
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .upload-form {
            display: inline-block;
        }

        input[type="file"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #ee8719;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #bf701b;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Upload Your ID</h2>
    <form class="upload-form" action="IDupload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="id_file" required>
        <br>
        <input type="submit" name="submit" value="Upload ID">
    </form>

    <?php
    session_start(); // Start a session to store error messages
    // Check if the user is logged in 
    if (!isset($_COOKIE['user_data'])) {
        header("Location: /Web24/login.php"); // Redirect to login page if not logged in
        exit();
    }
    
    $user_data = json_decode($_COOKIE['user_data'], true);
    $username = $user_data['username']; // Get logged-in user's username
    
    // Include Composer's autoload file
    require 'vendor/autoload.php';

    use phpseclib3\Crypt\AES;
    use phpseclib3\Net\SFTP;

    // Display any error message if it exists
    if (isset($_SESSION['error'])) {
        echo "<p class='error-message'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']); // Clear the message after displaying
    }

    // Load configuration securely
    $config = include('sftpconfig.php');

    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['id_file']) && $_FILES['id_file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['id_file']['tmp_name'];

            // Validate file type
            $allowedFileTypes = ['image/jpeg', 'image/png']; // Add allowed types as needed
            if (!in_array(mime_content_type($fileTmpPath), $allowedFileTypes)) {
                $_SESSION['error'] = "Invalid file type. Only JPEG & PNG files are allowed.";
                header("Location: IDupload.php");
                exit();
            }

            // Maximum file size (5MB in this case)
            if ($_FILES['id_file']['size'] > 5 * 1024 * 1024) {
                $_SESSION['error'] = "File size exceeds the limit of 5MB.";
                header("Location: IDupload.php");
                exit();
            }

            // Encrypt the file using phpseclib
            $encryptedFilePath = tempnam(sys_get_temp_dir(), 'enc_');
            $randomKey = random_bytes(32); // AES-256 requires a 32-byte key

            //$password = 'bHPxTFkpRfJvnNYU6a4Emg8Q59Weuywz'; // Ensure to securely manage the password

            // Set up AES encryption
            $aes = new AES('cbc');
            $aes->setKey($randomKey); // Set the encryption key

            // Generate an initialization vector (IV)
            $iv = random_bytes($aes->getBlockLength() / 8); // Get block length in bytes
            $aes->setIV($iv); // Set the IV

            // Encrypt the file contents
            $fileContent = file_get_contents($fileTmpPath);
            $encryptedContent = $aes->encrypt($fileContent);

            // Write the IV and encrypted content to a temporary file
            file_put_contents($encryptedFilePath, $iv . $encryptedContent); // Prepend IV to the encrypted content
            
            // Initialize SFTP connection
            $sftp = new SFTP($config['sftpServer'], $config['sftpPort']);

            // Step 4: Encrypt the AES key with a master key (optional, for key management)
            $masterKey = $config['master']; // Securely store and manage this master key
            $encryptedAESKey = openssl_encrypt($randomKey, 'aes-256-cbc', $masterKey, OPENSSL_RAW_DATA, $iv);
            $finalenckey = $iv . $encryptedAESKey;
            
            // Login to SFTP server
            if (!$sftp->login($config['sftpUsername'], $config['sftpPassword'])) {
                $_SESSION['error'] = "SFTP login failed.";
                header("Location: IDupload.php");
                exit();
            }

            // Define the temporary file path to store the encrypted AES key
            $encryptedAESKeyFilePath = tempnam(sys_get_temp_dir(), 'key_');
            file_put_contents($encryptedAESKeyFilePath, $finalenckey);

            // Define the target path for the encrypted file and the AES key on the SFTP server
            $remoteFilePath = '/IDuploads/' . $username . '.enc'; // Encrypted file path
            $remotekeyFilePath = '/KMNGMT/' . $username . '.key'; // Encrypted AES key path

            // Upload both the encrypted file and the encrypted AES key to the SFTP server
            if ($sftp->put($remoteFilePath, $encryptedFilePath, SFTP::SOURCE_LOCAL_FILE) && 
                $sftp->put($remotekeyFilePath, $encryptedAESKeyFilePath, SFTP::SOURCE_LOCAL_FILE)) {

                // Clean up temporary encrypted file and AES key file
                unlink($encryptedFilePath);
                unlink($encryptedAESKeyFilePath);

                // Redirect to bookingcomplete.php after successful uploads
                echo "<br><br>";
                echo "Master Key: "; echo bin2hex($masterKey). "<br>";
                echo "IV: "; echo bin2hex($iv). "<br>";
                echo "Random key:"; echo bin2hex($randomKey). "<br>";
                echo "Encrypted AES key:"; echo bin2hex($finalenckey). "<br>";

                //header("Location: bookingcomplete.php");
                exit();
            } else {
                // Handle error if either upload fails
                $_SESSION['error'] = "Error uploading encrypted file or AES key to SFTP server.";
                unlink($encryptedFilePath); // Ensure clean-up in case of failure
                unlink($encryptedAESKeyFilePath);
                header("Location: IDupload.php"); // Redirect back to the upload page
                exit();
            }

        } else {
            $_SESSION['error'] = "No file uploaded or upload error occurred.";
            header("Location: IDupload.php"); // Redirect back to the upload page
            exit();
        }
    }
    ?>
</div>

</body>
</html>
