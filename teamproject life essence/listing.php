<?php //by mubaraq
include 'navbar.php';
    $products = [
      [
        'name' => 'Supplement 1',
        'image' => 'images/herbal 3.png',
        'description' => '19 nutrients destined to help support healthy hair',
        'amount' => '£50.00'
      ],
      [
        'name' => 'Supplement 2',
        'image' => 'images/Herbal 2.png',
        'description' => 'Herbal Secrets Joint Care 120 Veggie Capsules Supplement',
        'amount' => '£70.00'
      ],
      [
        'name' => 'Supplement 3',
        'image' => 'images/herbal 1.png',
        'description' => 'Herbalife Formula 1 is a delicious complete meal replacement',
        'amount' => '£25.00'
      ],
      [
        'name' => 'Supplement 4',
        'image' => 'images/herbal 5.png',
        'description' => 'For a moment of self-care, warm, press and smooth into the skin',
        'amount' => '£35.00'
      ],
      [
        'name' => 'Supplement 5',
        'image' => 'images/herbal 4.png',
        'description' => 'A food supplement consisting of standardised plant extracts',
        'amount' => '£60.00'
      ]
    ];

    foreach ($products as $product) {
      echo "<table>
              <thead>
                <tr>
                  <th>Product-name</th>
                  <th>product-image</th>
                  <th>Product description</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{$product['name']}</td>
                  <td><img src='{$product['image']}' alt='Product Image' class='product-image'></td>
                  <td><small>{$product['description']}</small></td>
                  <td><small>{$product['amount']}</small></td>
                </tr>
              </tbody>
            </table>";
    }
?>

<html>
<head>
    <title>Life Essence - Products</title>
</head>
<body>
</body>
</html>
