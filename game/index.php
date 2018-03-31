<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>BURAPHA GAME</title>

<link rel="stylesheet" type="text/css" href="uploadify.css">

</head>

<body>

	
	<h3><u>GIRL LIST</u></h3>
	<form action="index.php" method="post">
		<span>
<input type="text" name="NAME"/>
<input type="submit" value="ADD"/>
		</span>
		
</form>
	<?php

				
				$servername = "mysql.hostinger.in.th";
				$username = "u739286913_sa";
				$password = "ttuiiiut";

				// Create connection
				$conn = new mysqli($servername, $username, $password);

				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 


				  if (!empty($_POST["NAME"])) {

						$insertSql = "INSERT INTO `u739286913_find`.`GIRL` (`GIRLID`, `NAME`) VALUES (NULL, '".$_POST["NAME"]."');";

						if ($conn->query($insertSql) === TRUE) {
							//echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . $conn->error ;
						}
				  }


				    $sql = "SELECT * FROM u739286913_find.`GIRL`";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							
							echo "<a href='album.php?" . $row["GIRLID"]. "'>". $row["NAME"] . "</a>";
							echo "<br>";
						}
					} else {
						echo "0 results";
					}



					$conn->close();
	?>
				


</body>
</html>