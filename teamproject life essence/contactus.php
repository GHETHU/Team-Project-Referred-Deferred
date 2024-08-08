<?php
session_start();
require_once("connectdatabase.php");

// Assuming the session username is stored in $_SESSION['username']
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $message = $_POST["message"];

  // Check if the name only contains alphabets
  if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
    $error = "Name can only contain alphabets";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email";
  } else {
    // Send the email
    $to = "your_email@example.com";
    $subject = "Contact Us";
    $body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
      $success = "Email sent successfully";
    } else {
      $error = "Failed to send email";
    }
  }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="css/indexstyle.css"/>
    <title>LIFE ESSENCE - Contact Us</title>
</head>
<body>
<header>
    <div class="navbar">
        <div class="logo"><a href="index.php">LIFE ESSENCE</a></div>
        <ul class="links">
            <li><a href="index.php">Home</a></li>
            <li><a href='listing.php'>Products Page</a></li>
            <li><a href='aboutus.php'>About</a></li>
            <li><a href='signup.php'>Signup</a></li>
            <li><a href='login.php'>Login</a></li>
            <li><a href='logout.php'>Logout</a></li>
            <li><a href='admin.php'>Admin</a></li>
        </ul>
        <a href="signup.php" class="action_btn">Get Started</a>
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
    <section id="contact">
        <h1>Contact Us</h1>
        <p>Get in touch with us for any queries or to request an invoice.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required pattern="[a-zA-Z ]*" placeholder="Your name">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Your email">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required placeholder="Your phone number">
            <label for="message">Message:</label>
            <textarea id="message" name="message" required placeholder="Your message
