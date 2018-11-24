<?php 
function DatabaseConnection(){
	$servername = "localhost";
	$db_username = "root";
	$db_password = "";
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
function Search($SearchName){
	try{
		$connection = DatabaseConnection();		
		$stmt = $connection->prepare("select fname, lname from user_details where fname LIKE  CONCAT('%', :name, '%') or lname LIKE  CONCAT('%', :name, '%')");
        $stmt->bindParam(':name',$SearchName);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0)
        {
        	if($count > 1){

        	}
	        while($row = $stmt->fetch())
	        {
	        	$resultFname = $row["fname"];
	        	$resultLname = $row["lname"];
	        	
	        }
	    }
	    else{
	    	echo "No results found";
	    }
	}
	catch(PDOException $error){
		echo $error->getMessage();
	}
}
?>
