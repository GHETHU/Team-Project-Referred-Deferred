<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="Checkout.css">

    <title>Checkout Page</title>
</head>
<body>

<div class="wrapper">

    <form action="ThankYou.php" method="post">

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
                    <img src="Visa-Mastercard-1-1024x378.webp" alt="Card Images">
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

        <input type="submit" value="Proceed to Checkout" class="submit-button"  >

    </form>

</div>    
    
</body>
</html>
