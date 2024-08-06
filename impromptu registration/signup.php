<?php
if (isset($_POST['submitted'])) {
    // connect to the database
    require_once('connectdatabase.php');
    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $username = isset($_POST['username']) ? $_POST['username'] : false;
    $password1 = isset($_POST['password1']) ? password_hash($_POST['password1'], PASSWORD_DEFAULT) : false;
    $password2 = isset($_POST['password2']);

    $u_check = $db->prepare('SELECT * FROM users WHERE username = ?');
    $u_check->execute(array($_POST['username']));

    if (!($email)) {
        echo "EMAIL INVALID";
        echo "<p><h3><a href=signup.php>Return</a></h3></p>";
        exit;
    }
    if (!($username)) {
        echo "USERNAME INVALID";
        echo "<p><h3><a href=signup.php>Return</a></h3></p>";
        exit;
    }
    if ($u_check->rowCount() > 0) {
        echo "USERNAME TAKEN";
        echo "<p><h3><a href=signup.php>Return</a></h3></p>";
        exit;
    }
    if (!$password1 || strlen($_POST['password1']) < 3) {
        echo "PASSWORD INVALID";
        echo "<p><h3><a href=signup.php>Return</a></h3></p>";
        exit;
    }
    if ($_POST['password1'] != $_POST['password2']) {
        echo "PASSWORD IS NOT EQUAL";
        echo "<p><h3><a href=signup.php>Return</a></h3></p>";
        exit;
    }
    try {

        #register user by inserting the user info
        $stat = $db->prepare("insert into users values(default,?,?,?,0)");
        $stat->execute(array($username, $password1, $email));

        $id = $db->lastInsertId();
        echo "Your new ID is; $id - Godspeed, soldier.";

    } catch (PDOexception $ex) {
        echo "A database error has occurred, try again- if you dare. <br>";
        echo "Your Hubris is as Follows: <em>" . $ex->getMessage() . "</em>";
    }
}
?>
<html lang="en">
<head>
    <title>Life Essence - Signup</title>
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <form method="post" action="signup.php">
        Email: <input type="text" name="email"/><br>
        Username: <input type="text" name="username"/><br>
        Password: <input type="password" name="password1"/><br>
        Re-Enter Password: <input type="password" name="password2"/><br><br>

        <input type="submit" value="Register"/>
        <input type="reset" value="Clear"/>
        <input type="hidden" name="submitted" value="true"/>
    </form>
    <p> Already Enlisted? <a href="login.php">Login</a></p>

</div>
</body>
</html>