<?php
session_start();
include 'navbar.php';
require_once('connectdatabase.php');
$verify=false;

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $uid = $_SESSION['u_id'];

    try {
        $adminquery = "SELECT admin FROM users WHERE u_id = $uid";
        $adminresult = ($db->query($adminquery))->fetchColumn(); //get admin shizzles and turn it into a variable!!
        if ($adminresult == 1) {
            echo "<h2> Welcome Admin User, " . $_SESSION['username'] . " - ID: " . $_SESSION['u_id'] . "! </h2>";
            $verify=true;

        } else {
            header("location: index.php");
        }

    } catch (PDOException $ex) {
        echo("UNEXPECTED FAILURE<br>");
        echo($ex->getMessage());
    }
} else {
    header("location: index.php");
}


if ($verify) {
    try {
        $productquery = "SELECT * FROM products";
        $productrows = $db->query($productquery);

        $basketquery = "SELECT * FROM basket";
        $basketrows = $db->query($basketquery);

    } catch (PDOexception $ex) {
        echo "Critical Database Failure 🤯 <br>";
        echo "Your Hubris is as follows: <em>" . $ex->getMessage() . "</em>";
    }
}
?>

<html lang="en">
<head>
    <title>Life Essence - Admin Page</title>
</head>
<body>
<div class="container">
    <table cellspacing="10" cellpadding="20" id="products">
        <tr>
            <th align='left'><b>Product ID</b></th>
            <th align='left'><b>Product Name</b></th>
            <th align='left'><b>Description</b></th>
            <th align='left'><b>Price</b></th>
            <th align='left'><b>Stock</b></th>
        </tr>
        <?php
        if ($productrows && $productrows->rowCount() > 0) {
            // Fetch and  print all  the records.
            while ($productrow = $productrows->fetch()) {
                echo "<tr><td align='left'><a href='updateproduct.php?p_id=$productrow[p_id]'>" . $productrow['p_id'] . "</td>";
                echo "<td align='left'>" . $productrow['name'] . "</a></td>";
                echo "<td align='left'>" . substr($productrow['description'], 0, 100) . "-...</td>";
                echo "<td align='left'>£" . $productrow['price'] . "</td>";
                echo "<td align='left'>" . $productrow['stock'] . " Units</td></tr>\n";
            }
            echo '</table>';
        } else {
            echo "<p>No Database Entries Found.</p>\n"; //no match found
        }

        ?>
</div><br>
<div class="container">
    <table cellspacing="10" cellpadding="20" id="products">
        <tr>
            <th align='left'><b>Basket ID</b></th>
            <th align='left'><b>Username</b></th>
            <th align='left'><b>Products</b></th>
            <th align='left'><b>Cost</b></th>
            <th align='left'><b>Process State</b></th>
        </tr>
        <?php
        if ($basketrows && $basketrows->rowCount() > 0) {
            // Fetch and  print all  the records.
            while ($basketrow = $basketrows->fetch()) {

                //get username of owner of basket
                $userresult = ($db->query("SELECT username FROM users WHERE u_id =". $basketrow['u_id']))->fetchColumn();

                //get total cost of all products in basket
                $productlist = (explode(",", $basketrow['product_ids']));
                array_pop($productlist);
                foreach ($productlist as $x) {
                    $onecost = ($db->query("SELECT price FROM products WHERE p_id =". $x))->fetchColumn();
                    $totalcost = $totalcost + $onecost;
                }

                //get name and quantity of all products in basket
                $stupidproductarray = array_count_values($productlist); //too many variable names i wanted to shoot myself
                $array = array_reverse($stupidproductarray); //apparently this shit more efficient!!
                $productstring="";
                foreach ($stupidproductarray as $x) {
                    $getproductname = ($db->query("SELECT name FROM products WHERE p_id =". $stupidproductarray[$x]))->fetchColumn();
                    $productquantity = array_pop($array);
                    $productstring = $productstring . $productquantity . "x " . $getproductname . ", ";
                }

                echo "<tr><td align='left'><a href='updatebasket.php?b_id=$basketrow[b_id]'>" . $basketrow['b_id'] . "</a></td>";
                echo "<td align='left'>" . $userresult . "</td>";
                echo "<td align='left'>" . rtrim($productstring, ", ") . "</td>";
                echo "<td align='left'>£" . $totalcost . "</td>";
                echo "<td align='left'>" . $basketrow['processed'] . "</td></tr>\n";
            }
            echo '</table>';
        } else {
            echo "<p>No Database Entries Found.</p>\n"; //no match found
        }

        ?>
</div>
<p>
    Move to Index; <a href="index.php">Index</a>
</p>
</body>
</html>
