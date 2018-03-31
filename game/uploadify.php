<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
				$servername = "mysql.hostinger.in.th";
				$username = "u739286913_sa";
				$password = "ttuiiiut";
					// Create connection
				$conn = new mysqli($servername, $username, $password);

				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
				
				
// Define a destination
$targetFolder = '/game/uploads'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$newfilename = round(microtime(true)) . '.' . end(explode(".", $_FILES["Filedata"]["name"]));
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $newfilename;
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		
	
		
		move_uploaded_file($tempFile,$targetFile);
		    $sql = "INSERT INTO `u739286913_find`.`IMAGE` (`IMAGEID`, `ALBUMID`, `FILENAME`) VALUES (NULL, ".$_SERVER['QUERY_STRING']. ", '" . $newfilename . "');";

			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error ;
			}
		
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}



$conn->close();
?>

