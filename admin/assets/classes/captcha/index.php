<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" 	href="/favicon.ico" 				type="image/x-icon">		

		<meta http-equiv="Content-Type" 		content="text/html;charset=utf-8">		
		<meta name="viewport" 					content="width=device-width, initial-scale=1.0">

	</head>

	<body style="width:100%; background-color:grey">	
	
	<?php
	//This is the new script I need
	//It doesn't work yet...
	$imageName = "images/test6.png";
	$fontSize=10;
	$fontFamily="Arial";
	$fontColor="000000";
	$bgColor="00ff00";
	$width=500;
	$txt="Directeur de publication : M. XXXXXXXXX YYYYYYYYY
Blabla";
	
	?>
	<form action="imageGenerator.php" method="GET">
		<input type="text" name="bg-color" value="ffffff">
		<input type="text" name="font-color" value="000000">
		<input type="text" name="width" value="400">
		<input type="text" name="font-size" value="10">
		<input type="text" name="font-family" value="Arial">
		<textarea name="txt"></textarea>
		<input type=submit>
	</form>
	
	<?
	//echo "imageGenerator.php?font-size=".$fontSize."&font-family=".$fontFamily."&font-color=".$fontColor."&width=".$width."&txt=".$txt;
	
	//header("location: http://78.47.108.149/ca/imageGenerator.php?font-size=".$fontSize."&font-family=".$fontFamily."&font-color=".$fontColor."&width=".$width."&txt=".$txt."&bg=".$bgColor);
	//if(file_exists($imageName)) echo "<img src=\"$imageName\">";
	//	$content = file_get_contents("http://78.47.108.149/ca/imageGenerator.php?font-size=".$fontSize."&font-family=".$fontFamily."&font-color=".$fontColor."&width=".$width."&txt=".$txt."&bg=".$bgColor);
	//else {
	//	file_put_contents($imageName, $content);
	//	echo "<img src=\"$imageName\">";
		
	//}
	?>
		<!--
		<form action="imageGenerator.php" method="GET" style="width:700px; margin:0 auto">
			<h2>Convert text to image</h2>
			<p>
				<label for="font-size">Font size:</label>
				<select id="font-size" name="font-size">
					<option>8</option>
					<option>10</option>
					<option>12</option>
					<option>14</option>
					<option>16</option>
					<option>24</option>
					<option>36</option>
				</select>
		
				<label for="font-family">Font family:</label>
				<select id="font-family" name="font-family">
					<option>Arial</option>
					<option>Sintony</option>
					<option>Ubuntu</option>
				</select>

				<label for="font-color">Font color:</label>
				<select id="font-color" name="font-color">
					<option value="000000">Black</option>
					<option value="C0C0C0">Gray</option>
					<option value="FF0000">Red</option>
					<option value="00FF00">Green</option>
				</select>	
				
				<label for="width">Image width:</label>
				<input type="text" placeholder="Width" value="500" id="width" name="width">
			</p>
			
			<textarea name="txt" cols="76" rows="20"></textarea>
			<input type="submit" value="Generate >>">
		</form>
		-->
	</body>
</html>