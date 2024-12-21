<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <title> Coffee Shop</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
          <!-- JS File Link -->
          <script defer src="assets/js/responses.js"></script>
        <!-- <script defer src="assets/js/convo.js"></script> -->
        <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
        <!-- Custom CSS File Link -->
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"><!-- font awesome cdn link -->
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico"><!-- Favicon / Icon -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"><!-- Google font cdn link -->
    </head>
    <body>
        <!-- HEADER SECTION -->
        <header class="header">
            <a href="#" class="logo">
                <img src="assets/images/logo.png" class="img-logo" alt="KapeTann Logo">
            </a>

            <!-- MAIN MENU FOR SMALLER DEVICES -->
            <nav class="navbar navbar-expand-lg">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a href="#home" class="text-decoration-none">Home</a></li>
        <li class="nav-item"><a href="#about" class="text-decoration-none">About</a></li>
        <li class="nav-item"><a href="./menu.php" class="text-decoration-none">Menu</a></li>
        <li class="nav-item"><a href="login/index.php" class="text-decoration-none">Login</a></li>
    </ul>
</nav>

<div class="icons">
    <div class="fas fa-bars" id="menu-btn"></div>
</div>

            <!-- CART SECTION -->
          
        </header>

        <!-- HERO SECTION -->
        <section class="home" id="home">
            <div class="content">
                <h3>Welcome to KapeTann Coffee Shop!</h3>
                <p>
                    <strong>We are open 4:00 PM to 9:00 PM.</strong>
                </p>
                <a href="./menu.php" class="btn btn-dark text-decoration-none">Order Now!</a>
            </div>
        </section>

        <!-- ABOUT US SECTION -->
        <section class="about" id="about">
            <h1 class="heading"> <span>About</span> Us</h1>
            <div class="row g-0">
                <div class="image">
                    <img src="assets/images/about-img.png" alt="" class="img-fluid">
                </div>
                <div class="content">
                    <h3>Welcome to KapeTann!</h3>
                    <p>
                        At KapeTann Coffee Shop, we are passionate about coffee and believe
                        that every cup tells a story. We are a cozy coffee shop located
                        in the heart of the city, dedicated to providing an exceptional
                        coffee experience to our customers. Our love for coffee has led
                        us on a voyage of exploration and discovery, as we travel the
                        world in search of the finest coffee beans, carefully roasted
                        and brewed to perfection.
                    </p>
                    <p>
                        But coffee is not just a drink, it's an experience. Our warm and
                        inviting atmosphere at KapeTann is designed to be a haven
                        for coffee lovers, where they can relax, connect, and embark
                        on their own coffee voyages.
                    </p>
                    <a href="#" class="btn btn-dark text-decoration-none">Learn More</a>
                </div>
            </div>
        </section>

        <!-- FOOTER SECTION -->
        <section class="footer">
            <div class="footer-container">
                <div class="logo">
                    <img src="assets/images/logo.png" class="img"><br />
                    <i class="fas fa-envelope"></i>
                    <p>mohamedshawky4061@gmail.com</p><br />
                    <i class="fas fa-phone"></i>
                    <p>01153971557</p><br />
                    <i class="fab fa-facebook-messenger"></i>
                    <p>@kapetanncoffee</p><br />
                </div>
                <div class="support">
                    <h2>Support</h2>
                    <br /> 
                    <a href="#">Contact Us</a>
                    <a href="#">Customer Service</a>
                    <a href="#">Chatbot Inquiry</a>
                    <a href="#">Submit a Ticket</a>
                </div>
                <div class="company">
                    <h2>Company</h2>
                    <br /> 
                    <a href="#">About Us</a>
                    <a href="#">Affiliates</a>
                    <a href="#">Resources</a>
                    <a href="#">Partnership</a>
                    <a href="#">Suppliers</a>
                </div>
                
            </div>
        </section>

      
    </body>
</html>
<script>
  const menu = document.getElementById("menu-btn");
    const nav = document.querySelector(".navbar.navbar-expand-lg"); // Correctly targets the <nav>

    if (menu && nav) { // Ensure both elements are found
        menu.addEventListener("click", () => {
            nav.classList.toggle("active");
        });
    } else {
        console.error("Menu button or navigation bar not found!");
    }
</script>
