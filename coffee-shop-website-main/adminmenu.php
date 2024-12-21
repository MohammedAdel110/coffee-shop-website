<?php
// Database connection
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'coffe_shop_reg'; 

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Add New Item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_item'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $price = intval($_POST['price']);
    $image_url = $_FILES['image']['name'];

    if ($image_url) {
        $target_dir = "assets/images/";
        $target_file = $target_dir . basename($image_url);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        $conn->query("INSERT INTO menu_items (title, price, image_url) VALUES ('$title', $price, '$target_file')");
    }
}

// Edit Item: Fetch existing data for the form
$editItem = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $result = $conn->query("SELECT * FROM menu_items WHERE id = $id");
    $editItem = $result->fetch_assoc();
}

// Update Item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_item'])) {
    $id = intval($_POST['id']);
    $title = $conn->real_escape_string($_POST['title']);
    $price = intval($_POST['price']);
    $image_url = $_FILES['image']['name'];

    if ($image_url) {
        $target_dir = "assets/images/";
        $target_file = $target_dir . basename($image_url);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        $conn->query("UPDATE menu_items SET title='$title', price=$price, image_url='$target_file' WHERE id=$id");
    } else {
        $conn->query("UPDATE menu_items SET title='$title', price=$price WHERE id=$id");
    }

    header("Location: adminmenu.php");
    exit;
}

// Delete Item
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM menu_items WHERE id = $id");
    
    header("Location: adminmenu.php");
    exit;
}

// Fetch Menu Items
$menuItems = $conn->query("SELECT * FROM menu_items")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
    <link rel="stylesheet" href="./assets/css/adminmenu.css">
     
    
    
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Menu</h1>

        <!-- Add/Edit Item -->
        <div class="mt-4">
            <h2><?php echo isset($editItem) ? 'Edit Item' : 'Add New Item'; ?></h2>
            <form action="adminmenu.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $editItem['id'] ?? ''; ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required value="<?php echo htmlspecialchars($editItem['title'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required value="<?php echo htmlspecialchars($editItem['price'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <button type="submit" name="<?php echo isset($editItem) ? 'update_item' : 'add_item'; ?>" class="btn btn-primary">
                    <?php echo isset($editItem) ? 'Update Item' : 'Add Item'; ?>
                </button>
            </form>
        </div>

        <!-- Display Menu Items -->
        <div class="mt-5">
            <h2>Menu Items</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menuItems as $item): ?>
                        <tr>
                            <td><img src="<?php echo $item['image_url']; ?>" alt="Menu Item" width="100"></td>
                            <td><?php echo htmlspecialchars($item['title']); ?></td>
                            <td><?php echo number_format($item['price'], 2); ?>LE</td>
                            <td>
                                <a href="adminmenu.php?edit=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="adminmenu.php?delete=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
