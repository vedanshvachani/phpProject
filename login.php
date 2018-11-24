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
?>
