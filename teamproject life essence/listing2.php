<?php
session_start();


if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['product_name'];
    $amount = $_POST['amount'];
    $_SESSION['basket'][] = ['name' => $productName, 'amount' => $amount];
    $message = $productName . ' has been added to your basket.';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
  integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/navstyle.css" />
  <title>Review your basket.</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #1a1a1a;
      color: #ffffff;
    }

    #cart-container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #62C1BF;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center; /
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      color: #ffffff;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #62C1BF;
      width: 300px; 
    }

    button {
      padding: 10px;
      background-color: #62C1BF;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #62C1BF;
    }

    .remove-button {
      background-color: #62C1BF;
      color: #fff;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
    }

    .remove-button:hover {
      background-color: #62C1BF;
    }

    .product-image {
      width: 200px; 
      height: auto; 
    }

    .add-to-basket-button {
      background-color: #FF5733;
      color: #fff;
      padding: 8px 16px;
      border: none;
      cursor: pointer;
      margin-top: 10px;
    }

    .add-to-basket-button:hover {
      background-color: #FF6F47;
    }
    
    
    header {
      background: #333;
      color: white;
      padding: 10px 20px;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar .logo a {
      text-decoration: none;
      color: white;
      font-size: 24px;
      font-weight: bold;
    }

    .navbar .links {
      list-style: none;
      display: flex;
      gap: 15px;
    }

    .navbar .links li {
      display: inline;
    }

    .navbar .links li a {
      text-decoration: none;
      color: white;
      font-size: 16px;
    }

    .action_btn {
      padding: 8px 16px;
      background-color: #62C1BF;
      color: white;
      text-decoration: none;
      border-radius: 4px;
      font-size: 16px;
    }

    .toggle_btn {
      display: none;
      cursor: pointer;
    }

    .dropdown_menu {
      display: none;
      flex-direction: column;
      align-items: center;
    }

    .dropdown_menu.open {
      display: flex;
    }

    @media (max-width: 768px) {
      .navbar .links {
        display: none;
      }

      .navbar .toggle_btn {
        display: block;
      }

      .dropdown_menu {
        display: none;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar Section -->
  <header>
    <div class="navbar">
        <div class="logo"><a href="index.php">LIFE ESSENCE</a></div>
        <ul class="links">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="basket.php">Basket</a></li>
            <li><a href="admin.php">Admin</a></li>
        </ul>
        <div class="toggle_btn">
          <i class="fa-solid fa-bars"></i>  
        </div>
    </div>
    <div class="dropdown_menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="basket.php">Basket</a></li>
        <li><a href="admin.php">Admin</a></li>
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

  <!-- Basket Section -->
  <div id="cart-container">
    <h2>Products</h2>
    <?php if (isset($message)): ?>
      <p><?php echo $message; ?></p>
    <?php endif; ?>
    <table>
      <thead>
        <tr>
          <th>Product-name</th>
          <th>Product-image</th>
          <th>Product description</th>
          <th>Amount</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Supplement 1</td>
          <td><img src="images/herbal 3.png" alt="Product Image" class="product-image"></td>
          <td><small>19 nutrients destined to help support healthy hair</small></td>
          <td><small>£50.00</small></td>
          <td>
            <form method="POST" action="">
              <input type="hidden" name="product_name" value="Supplement 1">
              <input type="hidden" name="amount" value="50">
              <button class="add-to-basket-button" type="submit">Add to Basket</button>
            </form>
          </td>
        </tr>
        <tr>
          <td>Supplement 2</td>
          <td><img src="images/Herbal 2.png" alt="Product Image" class="product-image"></td>
          <td><small>Herbal Secrets Joint Care 120 Veggie Capsules Supplement</small></td>
          <td><small>£70.00</small></td>
          <td>
            <form method="POST" action="">
              <input type="hidden" name="product_name" value="Supplement 2">
              <input type="hidden" name="amount" value="70">
              <button class="add-to-basket-button" type="submit">Add to Basket</button>
            </form>
          </td>
        </tr>
        <tr>
          <td>Supplement 3</td>
          <td><img src="images/herbal 1.png" alt="Product Image" class="product-image"></td>
          <td><small>Herbalife Formula 1 is a delicious complete meal replacement</small></td>
          <td><small>£25.00</small></td>
          <td>
            <form method="POST" action="">
              <input type="hidden" name="product_name" value="Supplement 3">
              <input type="hidden" name="amount" value="25">
              <button class="add-to-basket-button" type="submit">Add to Basket</button>
            </form>
          </td>
        </tr>
        <tr>
          <td>Supplement 4</td>
          <td><img src="images/Herbal 5.png" alt="Product Image" class="product-image"></td>
          <td><small>Herbal Secrets Organic Amla Berries (Indian Gooseberry) 500mg</small></td>
          <td><small>£30.00</small></td>
          <td>
            <form method="POST" action="">
              <input type="hidden" name="product_name" value="Supplement 4">
              <input type="hidden" name="amount" value="30">
              <button class="add-to-basket-button" type="submit">Add to Basket</button>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
    <h2>Basket</h2>
    <table>
      <thead>
        <tr>
          <th>Product-name</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION['basket'] as $item): ?>
          <tr>
            <td><?php echo htmlspecialchars($item['name']); ?></td>
            <td><?php echo htmlspecialchars($item['amount']); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
