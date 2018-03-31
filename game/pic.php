<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>
</head>
<body>
				
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
	</form>

	
	<h3><u>PIC LIST</u></h3>
	<div id="filesUploaded">
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
				    $sql = "SELECT * FROM u739286913_find.`IMAGE` WHERE u739286913_find.`IMAGE`.ALBUMID =" . $_SERVER['QUERY_STRING'];
					$result = $conn->query($sql);
					//echo $sql;
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							
							echo "<img width='200' onclick='setPosition(" . $row["IMAGEID"]. ")'  src='http://rataphon.xyz/game/uploads/" . $row["FILENAME"]. "'/>";
	
						}
					} else {
						echo "0 results";
					}
					$conn->close();
	?>
				
</div>
	<script type="text/javascript">
	
		function setPosition(imageid){
			
			window.open("http://rataphon.xyz/game/position.php?"+imageid);
		}
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : 'uploadify.swf',
				'uploader' : 'uploadify.php?<?php echo $_SERVER['QUERY_STRING'] ?>'  ,
				'onQueueComplete' : function(queueData) {
					location.reload();
					
					 // var img = document.createElement("img")
					 // img.src = "http://rataphon.xyz/game/uploads/" + file.name;
					 // img.width = 200;
					 // img.onclick = setPosition();
						// // var br = document.createElement("br")
						 // document.getElementById("filesUploaded").appendChild(img);
						// // //document.getElementById("filesUploaded").appendChild(br);/ var img = document.createElement("img")
					 // img.src = "http://rataphon.xyz/game/uploads/" + file.name;
					 // img.width = 200;
					 // img.onclick = setPosition();
						// // var br = document.createElement("br")
						 // document.getElementById("filesUploaded").appendChild(img);
						// // //document.getElementById("filesUploaded").appendChild(br);

						
				}
			});
		});
	</script>

</body>
</html>