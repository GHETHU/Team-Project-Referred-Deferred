<?php
session_start();
require_once("connectdatabase.php");
//if the form has been submitted
if (isset($_POST['submitted'])) {
    if (!isset($_POST['username'], $_POST['password'])) {
        exit('You are to fill all available fields;');
    }
    // connect DB
    try {
        //matching user/pass in query! :3
        $stat = $db->prepare('SELECT u_id, password FROM users WHERE username = ?');
        $stat->execute(array($_POST['username']));

        // fetching result
        if ($stat->rowCount() > 0) {
            $row = $stat->fetch();

            if (password_verify($_POST['password'], $row['password'])) {
                session_start();
                $_SESSION["username"] = $_POST['username'];
                $_SESSION["u_id"] = $row['u_id'];
                header("Location:index.php");
                exit();

            } else {
                echo "<p style='color:red'>PASSWORD INVALID </p>";
            }
        } else {
            //else display an error
            echo "<p style='color:red'>USERNAME INVALID </p>";
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
    <title>Login</title>
</head>
<body>
<div class="container">
    <h2>Login</h2>


    <form action="login.php" method="post">

        <label>User Name:</label>
        <input type="text" name="username" size="15" maxlength="25"/><br>
        <label>Password:</label>
        <input type="password" name="password" size="15" maxlength="25"/><br>

        <input type="submit" value="Login"/>
        <input type="reset" value="Clear"/>
        <input type="hidden" name="submitted" value="TRUE"/>
        <p>
            Not yet enlisted? Let's change that; <a href="signup.php">Register</a>
        </p><br>

    </form>

</div>
</body>
</html>
