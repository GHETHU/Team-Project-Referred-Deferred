<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Checkout.css">
    <title>Life Essence - Checkout</title>
</head>
<body>

<div class="wrapper">

    <form action="">

        <div class="section">

            <div class="column">

                <h3 class="heading">Billing Information</h3>

                <div class="input-field">
                    <label>Full Name :</label>
                    <input type="text" placeholder="Jane Doe">
                </div>
                <div class="input-field">
                    <label>Email :</label>
                    <input type="email" placeholder="example@domain.com">
                </div>
                <div class="input-field">
                    <label>Address :</label>
                    <input type="text" placeholder="Apartment, Street">
                </div>
                <div class="input-field">
                    <label>City :</label>
                    <input type="text" placeholder="Nottingham">
                </div>

                <div class="row-flex">
                    <div class="input-field">
                        <label>County :</label>
                        <input type="text" placeholder="East Midlands">
                    </div>
                    <div class="input-field">
                        <label>Post Code :</label>
                        <input type="text" placeholder="10001">
                    </div>
                </div>

            </div>

            <div class="column">

                <h3 class="heading">Payment Details</h3>

                <div class="input-field">
                    <label>Accepted Cards :</label>
                    <img src="teamproject life essence/img/Visa-Mastercard-1-1024x378.webp" alt="Card Images">
                </div>
                <div class="input-field">
                    <label>Name on Card :</label>
                    <input type="text" placeholder="Ms. Jane Doe">
                </div>
                <div class="input-field">
                    <label>Card Number :</label>
                    <input type="number" placeholder="1234-5678-9101-1121">
                </div>
                <div class="input-field">
                    <label>Expiry Month :</label>
                    <input type="text" placeholder="December">
                </div>

                <div class="row-flex">
                    <div class="input-field">
                        <label>Expiry Year :</label>
                        <input type="number" placeholder="2024">
                    </div>
                    <div class="input-field">
                        <label>CVV :</label>
                        <input type="text" placeholder="123">
                    </div>
                </div>

            </div>
    
        </div>

        <input type="submit" value="Proceed to Checkout" class="submit-button">

    </form>

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
}

.wrapper form {
  padding: 30px;
  width: 800px;
  background: #ffffff;
  border-radius: 10px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.wrapper form .section {
  display: flex;
  flex-wrap: wrap;
  gap: 25px;
}

.wrapper form .section .column {
  flex: 1 1 300px;
}

.wrapper form .section .column .heading {
  font-size: 24px;
  color: #333333;
  padding-bottom: 10px;
  text-transform: uppercase;
  border-bottom: 2px solid #66CCCC;
  margin-bottom: 20px;
}

.wrapper form .section .column .input-field {
  margin: 20px 0;
}

.wrapper form .section .column .input-field label {
  margin-bottom: 10px;
  display: block;
  font-weight: 500;
  color: #666666;
}

.wrapper form .section .column .input-field input {
  width: 100%;
  border: 1px solid #dddddd;
  padding: 15px;
  font-size: 16px;
  border-radius: 5px;
  transition: border-color 0.3s;
}

.wrapper form .section .column .input-field input:focus {
  border-color: #66CCCC;
}

.wrapper form .section .column .row-flex {
  display: flex;
  gap: 20px;
}

.wrapper form .section .column .row-flex .input-field {
  flex: 1;
}

.wrapper form .section .column .input-field img {
  height: 40px;
  margin-top: 10px;
  filter: drop-shadow(0 0 2px #000000);
}

.wrapper form .submit-button {
  width: 100%;
  padding: 15px;
  font-size: 18px;
  background: #333333;
  color: #ffffff;
  border-radius: 5px;
  cursor: pointer;
  transition: background 0.3s;
}

.wrapper form .submit-button:hover {
  background: #66CCCC;
}

