<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffe_shop_reg";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Escape user inputs for security
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM clients WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // $_SESSION['customer_id'] = $user['id']; // Store the user ID in the session
        $_SESSION['customer_name'] = $user['Name']; // Store the user name in the session
        if ($user['Check_admin'] == 1) {
            header('location: ../dashboard.php');
        } else {
            header('location: ../index.php');
        }
    } else {
        echo "Invalid email or password!";
    }
}

mysqli_close($conn);
?>
