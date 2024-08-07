
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
    <link rel="stylesheet" href="css/loginstyle.css"/>
</head>
<body style="background-image: url('img/bg.jpg');">
<div class="container">
<?php
include 'navbar.php';
        require_once("connectdatabase.php");



        $message = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            if (empty($username) || empty($password)) {
                $message = "All fields are required.";
            } else {
                // Prepare and execute SELECT statement
                $sql = "SELECT * FROM users WHERE username = ?";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(1, $username, PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($user && password_verify($password, $user['password'])) {
                    $message = "Login successful!"; //Redirect to the Homepage from here
                } else {
                    $message = "Invalid username or password.";
                }
            }
        }
        ?>
       
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3 class="center">Login to Your Account </h3>
			</div>
			<div class="card-body">
				<form method="POST">
					<div class="form-group  center">
						<img  height="120" width="300" src="img/logo.png" >
					</div>
					
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Username" name="username"  name="password" required>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Password" name="password" required>
					</div>
					
					<div class="form-group">
						<br>
						<input type="submit" value="Sign In" class="btn  login_btn">
					</div>
					<?php if (!empty($message)): ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
            <?php endif; ?>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="./signup.php">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="./forget.html">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
