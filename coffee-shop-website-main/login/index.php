<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico">
    <link rel="stylesheet" href="./style.css">
    <title>Login Page</title>
    <script>
        function togglePasswords() {
            var passwordInput = document.getElementById("password");
            var showCheckbox = document.getElementById("Show");
            if (showCheckbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="image-section">
        </div>
        <div class="form-section">
        <div class="logo">
                <img src="./image/favicon.ico" alt="Cafe Beans Logo">
                <h1>Cafe Beans</h1>
        </div>
            <h2>Welcome Back, Please login to your account</h2>
            <form action="check.php" method="post">
                <input type="email" placeholder="Email address" name="email" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <div class="forgot">
                    <section>
                        <input type="checkbox" id="Show" onclick="togglePasswords()">
                    </section>
                        <label for="Show" class="shp">Show passwords</label>
                </div>
                <input type="submit" value="submit" name="submit" class="submit-btn">
            </form>
            
            <div class="other-options">
                <p>Don't have an account? <a href="../register/index.php">Sign up</a></p>
            </div>
        </div>
    </div>
</body>
</html>




