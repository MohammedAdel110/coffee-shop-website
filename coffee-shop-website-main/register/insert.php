<?php
if (isset($_POST["Register_Now"])) {
    $name = $_POST["User_name"];
    $email = $_POST["User_Email"];
    $password = $_POST["User_password"];
    $check=0;
    
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "coffe_shop_reg");
    
    if (!$conn) {
        echo mysqli_connect_error();
    } else {
        // Insert query to add user into the clients table
        $query = "INSERT INTO `clients`(`Name`, `Email`, `Password`,`Check_admin`) VALUES ('$name', '$email', '$password',,'$check')";
        
        if (mysqli_query($conn, $query)) {
            // Registration successful, redirect to login page
            header("Location: ../login/index.php");
            exit(); // Make sure the script stops executing after the redirect
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    
    mysqli_close($conn); // Close the database connection
}
?>
