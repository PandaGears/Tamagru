<?php
	include("header_front.php");
	if(!$_SESSION["username"]){
		header("Location: login.php");
	}
	$headers = getallheaders();
	if ($headers["Content-type"] == "application/json") {
    	$stuff = json_decode(file_get_contents("php://input"), true);
		switch($stuff){
			case "sticker1":
				$sticker = imagecreatefrompng('./images/sticker1.png');
				$src = "./images/sticker1.png";
				break;
			case "sticker2":
				$sticker = imagecreatefrompng('./images/sticker2.png');
				$src = "./images/sticker2.png";
				break;
			case "sticker3":
				$sticker = imagecreatefrompng('./images/sticker3.png');
				$src = "./images/sticker3.png";
				break;
			case "sticker4":
				$sticker = imagecreatefrompng('./images/sticker4.png');
				$src = "./images/sticker4.png";
				break;
		}
		$im = imagecreatefrompng('./bot.png');
		imagecopyresampled($im, $sticker, 0, 0, 0, 0, 640, 480, 640, 480);
		imagepng($im, $_SESSION["username"]."new.png");
	}
?>
<!DOCTYPE html>
<html lang="en">
<body>
	<div style="position:absolute; z-index:1; top:10%; display:flex; flex-direction:column">
		<video class="webcamma" autoplay="true" id="video"></video><br>
		<button class="button is-dark" style="margin-top:10px; flex:1; width:100%" onclick="snap();">Take Picture</button>
		<input id="add_gal" type="submit" name="addgal" class="button is-dark" value="Add to gallery">
		<input  type="file" class="button is-dark"  id="imageLoader" name="imageLoader"/><br>

		<div style='width:300px; height:200px; position:relative; z-index:2; color:white; font-family:K2D' id='canvdiv'>
			<canvas class="webcamma" id="canvas"></canvas>
		</div>
		<div style='width:640px; height:50px; position:relative; z-index:2; color:white; font-family:K2D' id='errdiv'>
		</div>
	</div>
	<div class="filterdiv" style="position:absolute; right: 0;">
		<?php
			$i = 0;
			$imarray = $db->returnRecord("SELECT * FROM images WHERE username = ".toQuote($_SESSION["username"]));
			while ($imarray[$i]){
			echo "<div style='position:relative; display:flex; flex-direction:column'><img style='width:380px;height:280px;margin:auto' src=".$imarray[$i]["image"]."></div><br>";
				$i++;
			}
		?>
	</div>

	<div class="centerdiv" style=" left:900px">
		<img src='./images/sticker1.png' id='sticker1' width='200px' onclick='addSticker(id)'><br>
		<img src='./images/sticker2.png' id='sticker2' width='200px' onclick='addSticker(id)'><br>
		<img src='./images/sticker3.png' id='sticker3' width='200px' onclick='addSticker(id)'><br>
		<img src='./images/sticker4.png' id='sticker4' width='200px' onclick='addSticker(id)'><br>
		<img src='./images/sticker5.png' id='sticker5' width='200px' onclick='addSticker(id)'>
	</div>

</body>

<script src='js/imagery.js'>

</script>

				</html>