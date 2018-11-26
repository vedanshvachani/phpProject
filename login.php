<html>
<head>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css'>
</head>
<body>
	<?php
    require_once("loginPHP.php"); 
 	?>
	<div class='row'>
		<div class='col-sm-5 well ' style='margin-top: 50px; margin-left: 400px;'>
			<form method='post' >
				<div class='text-center ml-1 mt-5 pl-1'>
					<label ><b> Login </b></label>
					<?php echo $noError; ?>
				</div>
				<div class='form-group '>
					<label><b> Username </b></label>
					<input type='text'  name='username' class='form-control'><?php echo $usernameErr; ?>
				</div>
				<div class='form-group '>
					<label><b> Password </b></label>
					<input type="password" name="password"  class='form-control' title="Password should be more than 8 characters"><?php echo $passwordErr ;?>
				</div>
				<div class='form-group text-center'>	
					<input type='submit' value='Login' style="cursor:pointer;" class='btn btn-primary'>
					
				</div>
			</form>
		</div>
	</div>
</body>
</html>