<?php
require_once('connectdatabase.php');
$query = "SELECT * FROM `basket`;";
$result = $db->query($query);
?>

<html>
<head>
    <title>Life Essence - Basket</title>
</head>
<body>
    <div id='maindiv' style='color:#62C0BF';>
   <?php  
if ($result->num_rows > 0)  
    { 
        // OUTPUT DATA OF EACH ROW 
        while($row = $result->fetch_assoc()) 
        { 
            echo "Basket id " . 
                $row["b_id"]. " - User ID: " . 
                $row["u_id"]. " | Product: " .  
                $row["product_ids"]. " | Processed " .  
                $row["processed"]. "<br>"; 
        } 
    }  
    else { 
        echo "Basket is empty"; 
    } 
?>
        
    </div>
</body>
</html>
