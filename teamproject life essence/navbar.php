<!-- navbar.html -->
<?php
?>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/navstyle.css" />
    <title>LIFE ESSENCE</title>
</head>
<body>




<header>
    <div class="navbar">
        <div class="logo"><a href="index.php">LIFE ESSENCE</a></div>
        <ul class="links">
            <li><a href='listing.php'>Products</a></li>
            <li><a href="basket.php">Basket</a></li>
            <li><a href='aboutus.php'>About Us</a></li>
            <li><a href='contactus.php'>Contact Us</a></li>
            <li><a href='logout.php'>Logout</a></li>
            <li><a href='admin.php'>Admin</a></li>
        </ul>
        <a href="signup.php" class="action_btn">Get Started</a>
        <div class="toggle_btn">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
     <div class="dropdown_menu">
        <li><a href='listing.php'>Products</a></li>
            <li><a href="basket.php">Basket</a></li>
            <li><a href='login.php'>Login</a></li>
            <li><a href='signup.php'>Signup</a></li>
            <li><a href='logout.php'>Logout</a></li>
            <li><a href='admin.php'>Admin</a></li>
    </div>
</header>

<script>
    const toggleBtn = document.querySelector('.toggle_btn');
    const toggleBtnIcon = document.querySelector('.toggle_btn i');
    const dropDownMenu = document.querySelector('.dropdown_menu');

    toggleBtn.onclick = function () {
        dropDownMenu.classList.toggle('open');
        const isOpen = dropDownMenu.classList.contains('open');

        toggleBtnIcon.classList = isOpen
            ? 'fa-solid fa-xmark'
            : 'fa-solid fa-bars';
    };
</script>
