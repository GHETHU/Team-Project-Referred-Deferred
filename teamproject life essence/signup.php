'navbar.php'



<!DOCTYPE html>
<html>
<head>
	<title>Sign UP Page</title>
   
	
	<style>
			.center {
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
    }
       



html,body{
background-image: url('./bg.jpg');
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 500px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #FFC312;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100%;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
input#form2Example3c {
    margin-left: 0px;
}
label.form-check-label {
    margin-left: 21px;
	color: #fff;

}
 /*new style start */
 .h-100 {
    height: 100% !important;
}
.justify-content-center {
    justify-content: center !important;
}
.d-flex {
    display: flex !important;
}
.input-group {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%;
}
.input-group-prepend {
    margin-right: -1px;
}
.input-group-append, .input-group-prepend {
    
    display: flex;
}
.input-group-text {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding: .375rem .75rem;
    margin-bottom: 0;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    text-align: center;
    white-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: .25rem;
}

*, ::after, ::before {
    box-sizing: border-box;
}
.input-group>.custom-select:not(:first-child), .input-group>.form-control:not(:first-child) {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
.input-group>.custom-file, .input-group>.custom-select, .input-group>.form-control {
    position: relative;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    width: 1%;
    margin-bottom: 0;
}
.form-control {
    display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
.form-group {
    margin-bottom: 1rem;
}
.card-body {
    
    flex: 1 1 auto;
    padding: 1.25rem;
}
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
.font {
    color: #fff;
}
 /*new style end*/
    </style>

</head>
<body>
<div class="container">


<?php
        
        require_once("connectdatabase.php");

        
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

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
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $message = "Email already registered.";
                } else {
                    
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    
                    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("sss", $username, $email, $hashed_password);

                    if ($stmt->execute()) {
                        $message = "Registration successful!";
                    } else {
                        $message = "Error: " . $stmt->error;
                    }
                }
                $stmt->close();
            }
        }
        $db->close();
        ?>

	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3 class="center">Sign Up </h3>
			</div>
			<div class="card-body">
				<form method="post" >
					<div class=" form-group center">
						<img  height="120" width="300" src="./logo.png" >
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
