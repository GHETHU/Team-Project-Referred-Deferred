<?php
session_start();
include 'navbar.php';
require_once('connectdatabase.php');

//getting id <3
if (isset($_GET['b_id'])) {
    $orange = $_GET['b_id'];
}

try {
    $basketquery = "SELECT  * FROM basket WHERE b_id = " . $orange;
    $rows = $db->query($basketquery);
    $row = $rows->fetch();
} catch (PDOexception $ex) {
    echo "Critical Database Failure 🤯 <br>";
    echo "Your Hubris is as follows: <em>" . $ex->getMessage() . "</em>";
}

//i hate all the code below

//get total cost of all basket items duhh
$productlist = (explode(",", $row['product_ids']));
array_pop($productlist);
foreach ($productlist as $x) {
    $onecost = ($db->query("SELECT price FROM products WHERE p_id =". $x))->fetchColumn();
    $totalcost = $totalcost + $onecost;
}

//get name and quantity of all products in basket
$stupidproductarray = array_count_values($productlist); //too many variable names i wanted to shoot myself
$awfularray = array_reverse($stupidproductarray); //apparently this shit more efficient!!
$productstring="";
foreach ($stupidproductarray as $x) {
    $getproductname = ($db->query("SELECT name FROM products WHERE p_id =". $stupidproductarray[$x]))->fetchColumn();
    $productquantity = array_pop($awfularray);
    $productstring = $productstring . $productquantity . "x " . $getproductname . ", ";
}

// i love lazy code YEAHH LETS UPDATE THE BASKET!!!
if (isset($_POST['submitted'])) {
    $processed = isset($_POST['processed']) ? $_POST['processed'] : false;
    try {
        //matching user/pass in query! :3
        $query = "SELECT password FROM users WHERE `username` = '" . $user . "'";
        $v_rows = $db->query($query);
        $v_row = $v_rows->fetch();

        if (password_verify($_POST['password'], $v_row['password'])) {
            $stat = $db->prepare("UPDATE basket SET processed='$processed' WHERE basket.`b_id` =" . $orange);
            $stat->execute();

            echo "Basket ID '$orange' successfully updated.";

        } else {
            echo "<p style='color:red'>PASSWORD INVALID </p>";
        }
    } catch (PDOException $ex) {
        echo("UNEXPECTED FAILURE<br>");
        echo($ex->getMessage());
        exit;
    }
}


?>

<html>
<head>
    <title>Update Basket</title>
</head>
<?php
echo "<h2>Update Basket - ID: " . $orange . " </h2>";
$valueArray = ['Payment Required', 'Awaiting Approval', 'Approved']; //YIPPEE ENUM!!
$userresult = ($db->query("SELECT username FROM users WHERE u_id =". $row['u_id']))->fetchColumn(); //get username!
?>
<body>
<div class="container">
    <form action="updatebasket.php?b_id=<?php echo $orange; ?>" method="post">

        <label>Username: <?php echo $userresult . " - ID: " . $row['u_id']; ?></label><br>
        <label>Contents: <?php echo rtrim($productstring, ", "); ?></label><br>
        <label>Total Price: £<?php echo $totalcost; ?></label><br>
        <label>Process State:</label>
        <select name="processed" id="processed">
            <?php
            foreach ($valueArray as $key => $value) {
                if ($value == $row['processed']) {
                    echo "<option value='$value' selected='selected'>" . ucfirst($value) . "</option>";
                } else {
                    echo "<option value='$value'>" . ucfirst($value) . "</option>";
                }
            }
            ?>
        </select><br>
        <br><p>
            <?php
            echo "User: " . $user;
            ?>
            <br><label>Confirm Password: </label>
            <input type="password" name="password" size="15" maxlength="25"/></p>

        <input type="submit" value="Update Product"/>
        <input type="hidden" name="submitted" value="TRUE"/>
        <p>
            <a href="admin.php">Return to Admin Page</a>
        </p><br>

    </form>
</div>
</body>
</html>
