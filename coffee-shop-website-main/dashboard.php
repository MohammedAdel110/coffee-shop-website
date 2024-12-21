<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "coffe_shop_reg";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch metrics
$totalSalesQuery = mysqli_query($conn, "SELECT SUM(total_price) as total_sales FROM orders");
$totalSalesRow = mysqli_fetch_assoc($totalSalesQuery);
$totalSales = $totalSalesRow['total_sales'] ?? 0;

$totalOrdersQuery = mysqli_query($conn, "SELECT COUNT(*) as total_orders FROM orders");
$totalOrdersRow = mysqli_fetch_assoc($totalOrdersQuery);
$totalOrders = $totalOrdersRow['total_orders'] ?? 0;

$totalProductsQuery = mysqli_query($conn, "SELECT COUNT(*) as total_products FROM menu_items");
$totalProductsRow = mysqli_fetch_assoc($totalProductsQuery);
$totalProducts = $totalProductsRow['total_products'] ?? 0;

$totalCustomersQuery = mysqli_query($conn, "SELECT COUNT(*) as total_customers FROM clients");
$totalCustomersRow = mysqli_fetch_assoc($totalCustomersQuery);
$totalCustomers = $totalCustomersRow['total_customers'] ?? 0;

// Pagination setup
$ordersPerPage = 10; // Number of orders per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $ordersPerPage; // Offset for the query

// Fetch total orders count for pagination
$totalOrdersCountQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM orders");
$totalOrdersCountRow = mysqli_fetch_assoc($totalOrdersCountQuery);
$totalOrdersCount = $totalOrdersCountRow['total'];

// Calculate total pages
$totalPages = ceil($totalOrdersCount / $ordersPerPage);

// Fetch paginated orders
$ordersQuery = mysqli_query($conn, "SELECT id, customer_name, total_price, order_date FROM orders ORDER BY order_date DESC LIMIT $offset, $ordersPerPage");
$orders = [];
while ($orderRow = mysqli_fetch_assoc($ordersQuery)) {
    $orders[] = $orderRow;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/dashboard.css"> 
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Coffee Shop Admin</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="adminmenu.php">Menu</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Dashboard</h1>

        <!-- Metrics Section -->
        <div class="row">
            <div class="col-md-3">
                <div class="card text-center bg-dark-coffee text-white">
                    <div class="card-body">
                        <h3>Total Sales</h3>
                        <p id="total_sales"><?php echo number_format($totalSales, 2); ?>$</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-coffee text-white">
                    <div class="card-body">
                        <h3>Total Orders</h3>
                        <p id="total_orders"><?php echo $totalOrders; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-light-coffee text-white">
                    <div class="card-body">
                        <h3>Total Products</h3>
                        <p id="total_products"><?php echo $totalProducts; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-mocha text-white">
                    <div class="card-body">
                        <h3>Total Customers</h3>
                        <p id="total_customers"><?php echo $totalCustomers; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders Section -->
        <div class="mt-5">
            <h2 class="mb-4">Orders</h2>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?php echo $order['id']; ?></td>
                                <td><?php echo $order['customer_name']; ?></td>
                                <td><?php echo number_format($order ['total_price'], 2); ?>LE</td>
                                <td><?php echo date('d M Y, h:i A', strtotime($order['order_date'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav>
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
    <script>
        // JavaScript for Count-Up Animation
        function countUp(elementId, start, end, duration) {
            const element = document.getElementById(elementId);
            let current = start;
            const increment = Math.ceil((end - start) / (duration / 100)); 

            const timer = setInterval(() => {
                current += increment;
                if (current >= end) {
                    current = end;
                    clearInterval(timer);
                }
                element.textContent =   current.toLocaleString();
            }, 50);
        }

        // Trigger count-up for total sales
        const totalSales = <?php echo json_encode($totalSales); ?>; 
        const totalOrders = <?php echo json_encode($totalOrders); ?>;
        const totalProducts = <?php echo json_encode($totalProducts); ?>;
        const totalCustomers = <?php echo json_encode($totalCustomers); ?>; 
        countUp('total_sales', 0, totalSales, 3000); 
        countUp('total_orders', 0, totalOrders, 3000); 
        countUp('total_products', 0, totalProducts, 3000); 
        countUp('total_customers', 0, totalCustomers, 3000); 
    </script>

    
</body>
</html>
