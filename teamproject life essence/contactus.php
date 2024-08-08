<?php
//connecting time !
$db_host = 'localhost';
$db_name = 'u_220192145_aproject';
$username = 'u-220192145';
$password = '020Z2XvJGO02ikG';

try {
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
} catch (PDOException $ex) {
    echo("Failed to connect to database;<br>");
    echo($ex->getMessage());
    exit;
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $db->prepare("INSERT INTO contact_us (name, email, message) VALUES (:name, :email, :message)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);
    $stmt->execute();

    echo "Message sent successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        /* Add some basic styling to make the form look nicer */
        form {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <h1>Contact Us</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required placeholder="Your name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="your_email@example.com">
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" cols="50" required placeholder="Your message"></textarea>
        <input type="submit" value="Submit" name="submit">
    </form>

    <script>
        // Add event listener to the name field
        document.getElementById('name').addEventListener('input', function() {
            // Get the current value of the name field
            var name = this.value;

            // Check if the name contains any numbers
            if (/\d/.test(name)) {
                // If it does, remove the numbers
                this.value = name.replace(/\d/g, '');
            }
        });
    </script>
</body>
</html>
