<?php
session_start();
require_once("connectdatabase.php");

// Assuming the session username is stored in $_SESSION['username']
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>

<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="css/indexstyle.css"/>
    <title>LIFE ESSENCE</title>
</head>
<body>
<header>
    <div class="navbar">
        <div class="logo"><a href="#">LIFE ESSENCE</a></div>
        <ul class="links">
            <li><a href="index.php">Home</a></li>
            <li><a href='listing.php'>Products Page</a></li>
            <li><a href='aboutus.php'>About</a></li>
            <li><a href='signup.php'>Signup</a></li>
            <li><a href='login.php'>Login</a></li>
            <li><a href='logout.php'>Logout</a></li>
            <li><a href='admin.php'>Admin</a></li>
        </ul>
        <a href="#" class="action_btn">Get Started</a>
        <div class="toggle_btn">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
    <div class="dropdown_menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="listing.php">Products Page</a></li>
        <li><a href="aboutus.php">About</a></li>
        <li><a href="admin.php">Admin</a></li>
        <li><a href='signup.php'>Signup</a></li>
        <li><a href='login.php'>Login</a></li>
        <li><a href='logout.php'>Logout</a></li>
        <li><a href="signup.php" class="action_btn">Get Started</a></li>
    </div>
</header>

<main>
    <section id="home">
        <h1>Welcome</h1>
        <p>Welcome to our dynamic website, where content and experiences are tailored just for you!
            <br/>
        </p>
        <p class="welcome-message">Welcome, <?php echo htmlspecialchars($username); ?>!</p>
    </section>
</main>

<script>
    const toggleBtn = document.querySelector('.toggle_btn')
    const toggleBtnIcon = document.querySelector('.toggle_btn i')
    const dropDownMenu = document.querySelector('.dropdown_menu')

    toggleBtn.onclick = function () {
        dropDownMenu.classList.toggle('open')
        const isOpen = dropDownMenu.classList.contains('open')

        toggleBtnIcon.classList = isOpen
            ? 'fa-solid fa-xmark'
            : 'fa-solid fa-bars'
    }
</script>
</body>
</html>
