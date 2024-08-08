<?php
include 'navbar.php';
require_once('connectdatabase.php');
?>

<html>
<head>
    <title>Life Essence - Basket</title>
</head>
<body>
    <div id='maindiv' style='color:#62C0BF';>
   <?php
$query = "SELECT * FROM `basket`;";
try{
$result = $db->query($query);

if ($result->num_rows > 0)  
    { 
        // OUTPUT DATA OF EACH ROW 
        while($row = $result->fetch_assoc()) 
        { 
            
$productlist = (explode(",", $basketrow['product_ids']));
array_pop($productlist);

           $query1 = "SELECT * FROM `products` where product_id=$productlist[0];";
            $result2=$db->query($query1);
           if ($result2->num_rows > 0)  
    { 
        // OUTPUT DATA OF EACH ROW 
        while($row2 = $result->fetch_assoc()) {

      <table> 
<tr>
      <th> name</th>
	<th> description </th>
	<th> price </th>
	<th> stock</th>
</tr>
<tr>
 <td>echo $row2["name"] </td>
<td> echo $row2["description"]</td>
<td>echo $row2["price"] </td>
<td> echo $row2["stock"]</td>
</tr>      
</table>
}
            

                    
        } 
    }  
    else { 
        echo "Basket is empty"; 
    }
}
    catch(exception $e){
        echo@ 'Fatal Error';    }
?>
        
    </div>
</body>
</html>
