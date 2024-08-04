<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

    <link rel="stylesheet" href="style.css">
    <title>About Us</title>
</head>
<body>
    </body>
<div class="about">
        <div class="container">
            <div class="content-section">
                <div class="title" >
            <h1>About Us</h1>
            <p class="text">
                At Life Essence, we believe in the power of nature to heal and rejuvenate. Our mission is to provide high-quality, all-natural herbal medicines that promote wellness and balance in everyday life. 
                Rooted in ancient traditions and supported by modern science, our carefully crafted products are designed to enhance your health and vitality. 
                We are committed to sustainability, ethical sourcing, and delivering excellence in every bottle. Discover the essence of life with our range of herbal remedies, and embark on a journey to a healthier, more harmonious you.

            </p>
            
            </div>
    </div>

              <div class="image-section">
        <img src="herbal-medicines.jpg" alt="Herbal Medicines" height="400" width="400">
    </div>
        
            
        

        </div>
        <div class="social">
            <a href=""><i class= "fab fa-facebook-f"></i></a>
            <a href=""><i class= "fab fa-instagram"></i></a>
            <a href=""><i class= "fab fa-twitter"></i></a>
        
    </div>
    </div>
</body>
</html>




@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
* {
margin:0px;
padding:0px;
box-sizing: border-box;
font-family: 'Poppins' , sans-serif;
}

.section{
    width: 100%;
    min-height: 100vh;
    background-color: #ddd;
}

.container{
    width:80%;
    display: block;
    margin:auto;
    padding-top: 100px;
}

.content section{
    float: left;
width: 55%;
}

.content section .content h3{
    margin-top: 20px;
    color: #5d5d5d;
}

.content-section .content p{
    margin-top: 10px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 18px;
    line-height: 1.5;
}

.content-section .social {
    margin-top: 40px;
}

.content-section .social i {
    color: #a52a2a;
    font-size: 50px;
    padding: 0px 10px;
}

.content-section .social i{
    color: #3d3d3d;
}
@media screen and (max-width: 768px) {
    .container {
        width: 80%;
        display: block;
        margin: auto;
        padding-top: 50px;
    }
}

    .content-section{
        float: none;
        width: 100%;
        display: block;
        margin: auto;
    }
    .image-section {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .image-section img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

   
