<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico">
    <link rel="stylesheet" href="style.css">
    
    <title>Login | Ludiflex</title>
</head>
<body>
<div class="logo-container">
    <img src="./image/logo-min.png" alt="Website Logo" class="logo">
</div>
    <form action="insert.php" method="post">
        <div class="login-box">
            <div class="login-header">
                <header>Register</header>
            </div>
            <div class="input-box">
                <input type="text" name="User_name" class="input-field2" placeholder="Name" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="text" name="User_Email" class="input-field" placeholder="Email" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" name="User_password" id="User_password" class="input-field2" placeholder="Password" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" name="Confirm_password" id="Confirm_password" class="input-field" placeholder="Confirm password" autocomplete="off" required>
            </div>
            <div class="forgot">
                <section>
                    <input type="checkbox" id="check" onclick="togglePasswords()">
                    <label for="check" class="shp">Show passwords</label>
                </section>
            </div>
            <div class="input-submit">
                <input type="submit" class="submit-btn" value="Register Now" name="Register_Now" ></input>
                
            </div>
        </div>
    </form>
    <script>
        function togglePasswords() {
            var passwordField = document.querySelector('input[name="password"]');
            if (document.getElementById("check").checked) {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>
</html>