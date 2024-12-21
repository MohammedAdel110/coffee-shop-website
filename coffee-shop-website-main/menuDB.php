<?php
// Database connection parameters
$host = 'localhost'; // Replace with your database host
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$database = 'coffe_shop_reg'; // Replace with your database name

// Establish connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection succeeded
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// SQL query to fetch menu items
$sql = "SELECT * FROM menu_items";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    $counter = 0; // Initialize a counter

    // Start the first row
    echo '<div class="row">';

    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-md-4">
            <div class="box">
                <img src="<?= $row['image_url'] ?>" alt="<?= htmlspecialchars($row['title']) ?>" class="product-img">
                <h3 class="product-title"><?= htmlspecialchars($row['title']) ?></h3>
                <div class="price"><?= number_format($row['price'], 2) ?>LE</div>
                <a class="btn add-cart" onclick="">Add to Cart</a>
            </div>
        </div>
        <?php
        $counter++;

        // Close the row after 3 items and start a new row
        if ($counter % 3 == 0) {
            echo '</div><div class="row">';
        }
    }

    // Close any open row if the last group has fewer than 3 items
    if ($counter % 3 != 0) {
        echo '</div>';
    }
} else {
    echo "<p>No menu items found.</p>";
}

// Close the database connection
mysqli_close($conn);
?>
