<?php 
function DatabaseConnection(){
	$servername = "localhost";
	$db_username = "root";
	$db_password = "00011000";
	$dbname = "project";	
	try{
		$connection = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
	}
	catch(PDOException $error){
		echo "Error".$error->getMessage();
		die();
	}
}

function Authentication_Username($username){
	try
	{		
		$connection = DatabaseConnection();		
		$stmt = $connection->prepare("select username from signup where username=:username");
        $stmt->bindParam(':username',$username);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count>0){
        	return true;
        }
        else{
          return false;
        }
	}
	catch(PDOException $exception_error)
	{
		echo "Error".$exception_error->getMessage();
	}
}
function Authentication_Password($pd){
	try
	{	
		$password_protection = md5($pd);	
		$connection = DatabaseConnection();		
		$stmt = $connection->prepare("select password from signup where password=:pass");
        $stmt->bindParam(':pass',$password_protection);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count>0){
        	return true;
        }
        else{
        	return false;
        }
	}
	catch(PDOException $exception_error)
	{
		echo "Error".$exception_error->getMessage();
	}
}
function data_check($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  
$usernameErr = $mobile_numberErr = $passwordErr = $noError = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  if (empty($_POST['username']))
  {
    $usernameErr = "Username is required";
  }   
  else 
   { 
    	if (!preg_match("/^[a-zA-Z ]*$/",$_POST['username'])) 
        {
            $usernameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST['password']))
    {
    	$passwordErr = "Password is required";
    }
    else
    {
        if(!strlen($_POST['password']) > 8)
        {
            $passwordErr = "Password is less than 8 characters.";
        }
    } 
    if($usernameErr == "" && $mobile_numberErr == "" && $passwordErr == "")
    {
      $fm_username = data_check($_POST['username']);
      $mobile_number = data_check($_POST['mobile_number']);
      $fm_password = data_check($_POST['password']);
      if(!Authentication_Username($fm_username)){
      	$usernameErr = "Invalid username";
      }
      elseif(!Authentication_Password($fm_password)){
      	$passwordErr = "Invalid Password";
      }
      elseif (!Authentication_Password($fm_password) && !Authentication_Username($fm_username)) {
      	$usernameErr = "Invalid username and password";
      }
      elseif(Authentication_Password($fm_password) && Authentication_Username($fm_username)){
      	$noError = "Successful Login";
      }
    }
  }
?>