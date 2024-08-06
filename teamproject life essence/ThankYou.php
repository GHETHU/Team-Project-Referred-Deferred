<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="thankyou.css">
</head>
<body>

<div class="wrapper">

    <div class="content">
        <img src="logo.png" alt="Company Logo">
        <h1>Thank You for Choosing Life Essence</h1>
        <a href="index.php" class="home-button">Go to Homepage</a>
    </div>

</div>    
    
</body>
</html>


@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap');

* {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: none;
    border: none;
    text-transform: capitalize;
    transition: all 0.2s linear;
}

.wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px;
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 40%, #c3cfe2 100%);
    text-align: center;
}

.content {
    padding: 30px;
    width: 800px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.content img {
    max-width: 150px;
    margin-bottom: 20px;
}

.content h1 {
    font-size: 28px;
    color: #333333;
    padding-bottom: 10px;
    text-transform: uppercase;
    border-bottom: 2px solid #66CCCC;
    margin-bottom: 20px;
}

.content .home-button {
    display: inline-block;
    padding: 15px 30px;
    font-size: 18px;
    background: #333333;
    color: #ffffff;
    border-radius: 30px;
    cursor: pointer;
    transition: background 0.3s;
    text-decoration: none;
}

.content .home-button:hover {
    background: #66CCCC;
}

