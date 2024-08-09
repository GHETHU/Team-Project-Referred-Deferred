<?php
session_start();
include 'navbar.php';
require_once('connectdatabase.php');


$db_host = 'localhost';
$db_name = 'u_220192145_aproject';
$username = 'u-220192145';
$password = '020Z2XvJGO02ikG';

try {
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
} catch (PDOException $ex) {
    echo "Failed to connect to database.<br>";
    echo $ex->getMessage();
    exit;
}


if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $uid = $_SESSION['uid'];
}


if (isset($_GET['b_id'])) {
    $basket_id = $_GET['b_id'];
}

try {
    
    $basketquery = "SELECT * FROM basket WHERE b_id = :basket_id";
    $stmt = $db->prepare($basketquery);
    $stmt->bindParam(':basket_id', $basket_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
} catch (PDOException $ex) {
    echo "Critical Database Failure 🤯<br>";
    echo "Your Hubris is as follows: <em>" . $ex->getMessage() . "</em>";
    exit;
}


$productlist = explode(",", rtrim($row['product_ids'], ","));
$totalcost = 0;
$stupidproductarray = array_count_values($productlist);
foreach ($productlist as $x) {
    $onecost = ($db->query("SELECT price FROM products WHERE p_id =" . $x))->fetchColumn();
    $totalcost += $onecost;
}

// Get name and quantity of all products in basket
$productstring = "";
$awfularray = array_reverse($stupidproductarray);
foreach ($stupidproductarray as $key => $quantity) {
    $getproductname = ($db->query("SELECT name FROM products WHERE p_id =" . $key))->fetchColumn();
    $productstring .= $quantity . "x " . $getproductname . ", ";
}


if (isset($_POST['submitted'])) {
    $processed = $_POST['processed'] ?? false;
    try {
        $query = "SELECT password FROM users WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $user, PDO::PARAM_STR);
        $stmt->execute();
        $v_row = $stmt->fetch();

        if (password_verify($_POST['password'], $v_row['password'])) {
            $stat = $db->prepare("UPDATE basket SET processed = :processed WHERE b_id = :basket_id");
            $stat->bindParam(':processed', $processed, PDO::PARAM_STR);
            $stat->bindParam(':basket_id', $basket_id, PDO::PARAM_INT);
            $stat->execute();
            echo "Basket ID '$basket_id' successfully updated.";
        } else {
            echo "<p style='color:red'>PASSWORD INVALID </p>";
        }
    } catch (PDOException $ex) {
        echo "UNEXPECTED FAILURE<br>";
        echo $ex->getMessage();
        exit;
    }
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
  <title>Review your basket</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #1a1a1a;
      color: #ffffff;
    }

    #cart-container, .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #62C1BF;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
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

    button, .remove-button, .add-to-basket-button, .action_btn {
      padding: 10px;
      background-color: #62C1BF;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    button:hover, .remove-button:hover, .add-to-basket-button:hover, .action_btn:hover {
      background-color: #FF5733;
    }

    .product-image {
      width: 200px;
      height: auto;
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
          <td><img src="imgs/capsule.png" alt="Supplement 1" class="product-image"></td>
          <td>Improve your health with this supplement.</td>
          <td>2</td>
          <td>
            <button class="remove-button">Remove</button>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="total">
      <p>Total: £<?php echo $totalcost; ?></p>
      <form action="<?php echo $_SERVER['PHP_SELF'] . "?b_id=$basket_id"; ?>" method="post">
        <label for="password">Enter your password to confirm:</label><br>
        <input type="password" name="password" required><br>
        <input type="hidden" name="submitted" value="1">
        <input type="checkbox" name="processed" value="1"> Processed<br>
        <button class="action_btn">Submit</button>
      </form>
    </div>
  </div>
</body>
</html>
