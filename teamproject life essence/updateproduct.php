<?php
session_start();
include 'navbar.php';
require_once('connectdatabase.php');

//getting id <3
if (isset($_GET['p_id'])) {
    $apple = $_GET['p_id'];
}

try {
    $productquery = "SELECT  * FROM products WHERE p_id = " . $apple;
    $rows = $db->query($productquery);
    $row = $rows->fetch();
} catch (PDOexception $ex) {
    echo "Critical Database Failure 🤯 <br>";
    echo "Your Hubris is as follows: <em>" . $ex->getMessage() . "</em>";
}

//CUE THE LAZIEST CODING EVER!!
if (isset($_POST['submitted'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : false;
    $description = isset($_POST['description']) ? $_POST['description'] : false;
    $price = isset($_POST['price']) ? $_POST['price'] : false;
    $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : false;
    if (!$name || !$description || !$price || !$stock) {
        echo "INVALID INPUT";
        echo "<p><h3><a href=updateproduct.php?p_id=$apple.php>Return</a></h3></p>";
        exit;
    }
    try {
        //matching user/pass in query! :3
        $query = "SELECT password FROM users WHERE `username` = '" . $user . "'";
        $v_rows = $db->query($query);
        $v_row = $v_rows->fetch();

        if (password_verify($_POST['password'], $v_row['password'])) {
            $stat = $db->prepare("UPDATE products SET name='$name',description='$description',price='$price',stock='$stock' WHERE products.`p_id` =" . $apple);
            $stat->execute();

            echo "Product '$name' successfully updated.";

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
    <title>Update Product</title>
</head>
<?php
echo "<h2>Update Product - ID: " . $apple . " - " . $row['name'] . "  </h2>";
?>
<body>
<div class="container">
    <form action="updateproduct.php?p_id=<?php echo $apple; ?>" method="post">

        <label>Product Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" size="35" maxlength="45"
               height="20"><br>
        <label>Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50"><?php echo $row['description']; ?></textarea><br>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>"/><br>
        <label>Stock:</label>
        <input type="number" name="stock" value="<?php echo $row['stock']; ?>"/><br>
        <p>
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
</div>
</body>
</html>
