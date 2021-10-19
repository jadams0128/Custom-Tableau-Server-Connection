<?php 
	$page = 'login';  
	$title = "Login";
?>
<?php include_once('./includes/header.php'); ?>
<?php include_once('./includes/navbar.php'); ?>
	<div class="container m-tp-50 wrapper flex-grow-1">
		<div class="row text-center">
		    <div class="col-12">
		    	<h4 class="red-text"><?php echo $_GET['message']; ?></h4>
		      	<h4 class="white-text">Enter Tableau Login Credentials to access available dashboards</h4>
		    </div>
	  	</div>
		<div class="row justify-content-center m-tp-50">
		    <div class="col-12 col-sm-8 col-md-6">
		      	<form class="form-signin" role="form" action="./login.php" method="post">
			        <input type="text" placeholder="Username" class="form-control" name="username" required autofocus></br>
			        <input type="password" placeholder="Password" id="myInput" class="form-control" name="password" required>
			        <div class="m-tp-25 g-recaptcha" data-sitekey="6LfgAc4cAAAAAHI2NJ6q1KMMbwoosQkhQSQG_jwN"></div>
			        <label class="white-text" for="checkbox">Show Password</label>
			        <input class="m-tp-25 showPassword" type="checkbox"/><br>
			        <button id="login_form" class="m-tp-25 btn btn-lg btn-primary" type="submit" name="login">Login</button>
			    </form>
		    </div>
	  	</div>
	</div>
	<script src='https://www.google.com/recaptcha/api.js'></script>
<?php include_once('./includes/footer.php'); ?>