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
    <form action="send_email.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required placeholder="Your name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="your_email@example.com">
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" cols="50" required placeholder="Your message"></textarea>
        <input type="submit" value="Submit">
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
