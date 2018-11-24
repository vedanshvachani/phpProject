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
function UploadProfilePhoto($profile_photo,$profile_image_type,$profile_image_size,$profile_image_tmp,$profile_target){
	if(!empty($profile_photo))
      {
        if($profile_image_type == "image/jpg" || $profile_image_type == "image/png" || $profile_image_type == "image/jpeg")
        {
          if($profile_image_size < 500000)
          {
            if(getimagesize($profile_image_tmp))
            {
              if(move_uploaded_file($profile_image_tmp, $profile_target))
              {
              	return 1;  
              }
              else
              {
              	return 0;
              } 
            }
            else
            {
              $errorP = "Please insert a image file";;
            	
            }
          }
          else
          { 
            $errorP = "Please upload a file of 5 mb";
          	
          }
          
        }
        else
        {
          $errorP = "Please insert a image file ('jpg/png/jpeg'x)";
          
        }
      }
      
      
}
?>
