<?php
// Configuration
$from_email = 'your_email@example.com';
$from_name = 'Your Name';
$subject = 'Invoice Request';

// Connect to database
$db_host = 'localhost';
$db_name = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

try {
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
} catch (PDOException $ex) {
    echo("Failed to connect to database;<br>");
    echo($ex->getMessage());
    exit;
}

// Check if user is logged in
if (isset($_SESSION['username'])) {
    $user_id = $_SESSION['uid'];
    $user_email = $_SESSION['email'];
} else {
    echo "You must be logged in to request an invoice.";
    exit;
}

// Check if invoice request has been submitted
if (isset($_POST['request_invoice'])) {
    // Get user's order history
    $stmt = $db->prepare("SELECT * FROM orders WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $orders = $stmt->fetchAll();

    // Create invoice PDF
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Cell(0, 10, 'Invoice for ' . $_SESSION['username'], 0, 1, 'C');
    $pdf->Ln(10);

    foreach ($orders as $order) {
        $pdf->Cell(0, 10, 'Order #' . $order['order_id'] . ' - ' . $order['order_date'], 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Cell(0, 10, 'Items:', 0, 1, 'L');
        $pdf->Ln(5);

        foreach ($order['items'] as $item) {
            $pdf->Cell(0, 10, $item['product_name'] . ' x ' . $item['quantity'], 0, 1, 'L');
            $pdf->Ln(5);
        }

        $pdf->Cell(0, 10, 'Subtotal: ' . $order['subtotal'], 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Cell(0, 10, 'Tax: ' . $order['tax'], 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->Cell(0, 10, 'Total: ' . $order['total'], 0, 1, 'L');
        $pdf->Ln(10);
    }

    // Send invoice via email
    $pdf->Output('invoice.pdf', 'S');
    $attachment = chunk_split(base64_encode($pdf->Output('invoice.pdf', 'S')));
    $headers = "From: $from_name <$from_email>\r\n";
    $headers .= "Reply-To: $from_email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";
    $message = "Dear " . $_SESSION['username'] . ",\r\n\r\n";
    $message .= "Please find attached your invoice.\r\n\r\n";
    $message .= "Best regards,\r\n";
    $message .= "$from_name\r\n";
    $message .= "--boundary\r\n";
    $message .= "Content-Type: application/pdf; name=\"invoice.pdf\"\r\n";
    $message .= "Content-Disposition: attachment; filename=\"invoice.pdf\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $message .= $attachment;
    mail($user_email, $subject, $message, $headers);

    echo "Invoice sent successfully!";
} else {
    // Display invoice request form
    ?>
    <h1>Request Invoice</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="submit" name="request_invoice" value="Request Invoice">
    </form>
    <?php
}
?>
