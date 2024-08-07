<!DOCTYPE html>
<html>
<head>
	<title>Sign UP Page</title>
   
	
	
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
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
        
            if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                $message = "All fields are required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = "Invalid email format.";
            } elseif ($password !== $confirm_password) {
                $message = "Passwords do not match.";
            } else {
                $sql = "SELECT * FROM users WHERE email = ?";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(1, $email, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                if (count($result) > 0) {
                    $message = "Email already registered.";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
                    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(1, $username, PDO::PARAM_STR);
                    $stmt->bindParam(2, $email, PDO::PARAM_STR);
                    $stmt->bindParam(3, $hashed_password, PDO::PARAM_STR);
        
                    if ($stmt->execute()) {
                        $message = "Registration successful!";
                    } else {
                        $message = "Error: " . $stmt->errorInfo()[2];
                    }
                }
            }
        }
    
        ?>

	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3 class="center">Sign Up </h3>
			</div>
			<div class="card-body">
				<form method="post" >
					<div class=" form-group center">
						<img  height="120" width="300" src="img/logo.png" >
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Username" name="username" required >
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Enter your Email" name="email" required>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-lock"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Password" name="password" >
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" name="password" >
					</div>
					
					<div class="form-group">
						<br>
						<input type="submit" value="Register" class="btn  login_btn">
					</div>
					<?php if (!empty($message)): ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
            <?php endif; ?>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="./index.php">Login</a>
				</div>
				
			</div>
		</div>
	</div>
</div>
</body>
</html>
