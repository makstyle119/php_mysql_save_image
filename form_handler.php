<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
$fileExistsFlag = 0; 
$fileName = $_FILES['Filename']['name'];
// 	/* 
// 	*	Checking whether the file already exists in the destination folder 
// 	*/
	$query = "SELECT filename FROM image_saver WHERE filename='$fileName'";	
	$result = $conn->query($query) or die("Error : ".mysqli_error($conn));
	while($row = mysqli_fetch_array($result)) {
		if($row['filename'] == $fileName) {
			$fileExistsFlag = 1;
		}		
	}
	/*
	* 	If file is not present in the destination folder
	*/
	if($fileExistsFlag == 0) { 
		$target = "images/";		
		$fileTarget = $target.$fileName;	
		$tempFileName = $_FILES["Filename"]["tmp_name"];
		$result = move_uploaded_file($tempFileName,$fileTarget);
		/*
		*	If file was successfully uploaded in the destination folder
		*/
		if($result) { 
			echo "Your file <html><b><i>".$fileName."</i></b></html> has been successfully uploaded";		
			$query = "INSERT INTO `image_saver`(`filename`, `url`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES ('$fileName','$fileTarget','0',NOW(),'0',NOW())";
			$conn->query($query) or die("Error : ".mysqli_error($conn));			
		}
		else {			
			echo "Sorry !!! There was an error in uploading your file";			
		}
		mysqli_close($conn);
	}
	/*
	* 	If file is already present in the destination folder
	*/
	else {
		echo "File <html><b><i>".$fileName."</i></b></html> already exists in your folder. Please rename the file and try again.";
		mysqli_close($conn);
	}	