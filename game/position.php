<!DOCTYPE html>  
 <head>  
 <title>Playing YouTube video on HTML5 canvas</title>  
 <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width" />  
 <style type="text/css">  
body {
        margin: 0px;
        padding: 0px;

      } 
 </style>  
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

 </head>  
 <body >  
 <form action="position.php?<?php echo $_SERVER['QUERY_STRING']?>" method="post" id="formSubmit">
 <input type="hidden" name="IMAGEID" value="<?php echo $_SERVER['QUERY_STRING']?>"/>
 <input type="hidden" name="ix" id="ix" />
  <input type="hidden" name="iy" id="iy" />
   <input type="hidden" name="iwidth" id="iwidth" />
  <input type="hidden" name="iheight" id="iheight" />

 </form>
 <canvas id='myCanvas' width='100%' height='100%' ></canvas>
	<?php
				$servername = "mysql.hostinger.in.th";
				$username = "u739286913_sa";
				$password = "ttuiiiut";
				$imgMain = "";
				$pX = 0;
				$pY = 0;
				$pW = 0;
				$pH = 0;
				// Create connection
				$conn = new mysqli($servername, $username, $password);

				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 


				  if (!empty($_POST["ix"]) and !empty($_POST["iy"]) and !empty($_POST["iwidth"]) and !empty($_POST["iheight"]) and !empty($_POST["IMAGEID"])) {
					  
						

						$updateSql = "UPDATE  `u739286913_find`.`IMAGE` SET  `X` =  '". $_POST["ix"] ."',
						`Y` =  '". $_POST["iy"] ."',
						`WIDTH` =  '". $_POST["iwidth"] ."',
						`HEIGHT` =  '". $_POST["iheight"]."' WHERE  `IMAGE`.`IMAGEID` =". $_POST["IMAGEID"] .";";

						// echo "<script>alert('".$updateSql."')</script>";
					if ($conn->query($updateSql) === TRUE) {
							// echo "New record created successfully";
						 } else {
							 //echo "Error: " . $sql . "<br>" . $conn->error ;
						 }
						
		
				  }else{
					  			

			

				  }
				  
					$sql = "SELECT * FROM u739286913_find.`IMAGE` WHERE u739286913_find.`IMAGE`.IMAGEID =" . $_SERVER['QUERY_STRING'];
					$result = $conn->query($sql);
					//echo $sql;
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							$imgMain = $row["FILENAME"];
							//echo "<img id='imgMain'  src='http://rataphon.xyz/game/uploads/" . $row["FILENAME"]. "'/>";
							if (!is_null ( $row["X"] ))
								$pX = $row["X"];
							
								if (!is_null ( $row["Y"] ))
							$pY = $row["Y"];
						
							if (!is_null ( $row["WIDTH"] ))
							$pW = $row["WIDTH"];
						
							if (!is_null ( $row["HEIGHT"] ))
							$pH = $row["HEIGHT"];
	
						}
					} else {
						echo "GET : " . $sql;
					}


		
					$conn->close();
	?>
 


<script>
(function() {
	
	})();
   // your page initialization code here
   // the DOM will be available here
   var canvas = document.getElementById('myCanvas'),
    ctx = canvas.getContext('2d'),
    rect = {},
    drag = false;
	


	var img = document.createElement("img");
	img.src = "http://rataphon.xyz/game/uploads/<?php  echo $imgMain ?>";

	document.body.style.backgroundImage = "url('http://rataphon.xyz/game/uploads/<?php  echo $imgMain ?>')";
	document.body.style.backgroundRepeat = "no-repeat";
	
    canvas.style.cursor = "crosshair";
	canvas.width = img.width;
	canvas.height= img.height;

	ctx.lineWidth=5;
	init();
	rect.startX  = <?php  echo $pX ?>;
	rect.startY  = <?php  echo $pY ?>;
	 rect.w  = <?php  echo $pW ?>;
	 rect.h = <?php  echo $pH ?>;
	draw();

function draw() {
 	var gradient=ctx.createLinearGradient(rect.startX, rect.startY, rect.w, rect.h);
	gradient.addColorStop("0","magenta");
	gradient.addColorStop("0.5","blue");
	gradient.addColorStop("1.0","red");

	// Fill with gradient
	ctx.strokeStyle=gradient;
	ctx.strokeRect(rect.startX, rect.startY, rect.w, rect.h);
  //ctx.fillRect(rect.startX, rect.startY, rect.w, rect.h);

}

function mouseDown(e) {
  rect.startX = e.pageX - this.offsetLeft;
  rect.startY = e.pageY - this.offsetTop;
  drag = true;
}

function mouseUp() {
    drag = false;
  
	var txt;
	var r = confirm("Save? " + rect.startX + "," + rect.startY + " | " + rect.w + "x" + rect.h);
	if (r == true) {
		txt = "You pressed OK!";
		
		document.getElementById("ix").value = rect.startX ;
		document.getElementById("iy").value = rect.startY;
		document.getElementById("iwidth").value = rect.w ;
		document.getElementById("iheight").value = rect.h;
		document.getElementById("formSubmit").submit();

		
	} else {
		txt = "You pressed Cancel!";
	}

}

function mouseMove(e) {
  if (drag) {
    rect.w = (e.pageX - this.offsetLeft) - rect.startX;
    rect.h = (e.pageY - this.offsetTop) - rect.startY ;
    ctx.clearRect(0,0,canvas.width,canvas.height);
    draw();
  }
}

function init() {
  canvas.addEventListener('mousedown', mouseDown, false);
  canvas.addEventListener('mouseup', mouseUp, false);
  canvas.addEventListener('mousemove', mouseMove, false);
}



</script>
 </html>  