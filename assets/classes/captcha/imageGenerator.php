<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
//Getting vars from POST or GET
$string = ' ' . (string)$_REQUEST['txt'];                                           
$fontSize = (float)$_REQUEST['font-size'];                                           
$fontColor = $_REQUEST['font-color'];                                           
$bgColor = $_REQUEST['bg-color'];                                           
$width = (int)$_REQUEST['width']; 
$noise = (int)$_REQUEST['noise']; 
$noiseLines = (int)$_REQUEST['noiseLines']; 


//Setting GD basepath
putenv('GDFONTPATH=' . realpath('./font/'));
//Getting font from POST
$font =  $_REQUEST['font-family'].".ttf"; 

/**
	
	//image name
	$imageName = str_replace(" ", "_", substr($string,0,25));
	$badCharacters = array(0 => '.', 
							1 => "'",
							2 => "\\",
							3 => "/",
							4 => ":",
							5 => "*",
							6 => "?",
							7 => "\"",
							8 => "<",
							9 => ">",
							10 => "|",
							11 => "/",
							12 => "/",
							13 => "'");
							
	foreach($badCharacters as $char){
		$imageName = str_replace($char, "", $imageName);
	}
	
**/

generateImage($string, $fontSize, $fontColor, $width, $font, $bgColor, $noise, $noiseLines);
	
function generateImage($string, $fontSize, $fontColor, $width, $font, $bgColor, $noiseDots = 500, $noiseLines = 10){
	$line = null;
	//Interline 
	$interline = 1.5;

	//Background settings
	//Count of dots
	
	
	//Count of lines
	$noiseLines = 10;
	
	//Explode paragraphs	
	$paragraphs = explode("\r\n", $string);

	foreach($paragraphs as $string){
		//Getting string width
		$bbox = imagettfbbox($fontSize, 0, $font, $string);
		
		//print "font:".$font." size:".$fontSize." string:".$string;
		//If string width less then canvas width draw only one line
		if($bbox[2] <= $width){
			$lines[] = $string;
		}
		else{ //else break string in lines
			$strArr = explode(' ', $string);
			
			//Checking how much words in current line
			$minus = getLineWordsCount($strArr, $width, $bbox, $fontSize, $font );
			
			$wordsCount = count($strArr) - $minus;
			
			//Push line in array $lines and unseting no need values from main array of strings
			for($i = 0; $i < $wordsCount; $i++){
				$line .= $strArr[$i].' ';
				unset($strArr[$i]);
			}			
			
			$lines[] = $line;
			
			//Rebuild array for good indexes
			$str = implode(' ',$strArr);		
			$strArr = explode(' ', $str);
			$line = null;
			
			//while function return count of words do
			while(count($strArr) > 0){
				$bbox = imagettfbbox($fontSize, 0, $font, $str);
				$minus = getLineWordsCount($strArr, $width, $bbox, $fontSize, $font );
			
				$wordsCount = count($strArr) - $minus;
				for($i = 0; $i < $wordsCount; $i++){
					$line .= $strArr[$i].' ';
					unset($strArr[$i]);
				}
				$lines[] = $line;
				$str = implode(' ',$strArr);	
				$strArr = explode(' ', $str);
				$line = null;
				if(count($strArr) == 1) break;
			}
		}
	}
		//Create canvas 
		$im = @imagecreatetruecolor($width, $fontSize * $interline * (count($lines) + 0.5));	
		
		//Font color
		$fontColor = hex2RGB($fontColor);
		$fontColor = imagecolorallocate($im, $fontColor['red'], $fontColor['green'], $fontColor['blue']);	
		
		
		
		//filling BG		
		// Make the background transparent
		if(!empty($bgColor)) {	
			$bgColor = hex2RGB($bgColor);
			$bgColor = imagecolorallocate($im, $bgColor['red'], $bgColor['green'], $bgColor['blue']);	
			imagefill($im,0,0,$bgColor);
		}
		else {		
			$bgColor = imagecolorallocate($im, 255,255,255);
			imagefill($im,0,0,$bgColor);
			imagecolortransparent($im, $bgColor);
		}
		
		//Drawing dots noise
		for ($c = 0; $c < count($lines) *  $noiseDots; $c++){
		   $x = rand(0, $width - 1);
		   $y = rand(0, $fontSize * $interline * (count($lines) + 0.5) - 1);
		   imagesetpixel($im, $x, $y, $fontColor);	   
		}

		
		//Drawing lines noise
		for ($c = 0; $c < count($lines) * $noiseLines; $c++){
		   $x = rand(0, $width - 1);
		   $y = rand(0, $fontSize * $interline * (count($lines) + 0.5) - 1);
		   $x1 = rand(0, $width - 1);
		   $y1 = rand(0, $fontSize * $interline * (count($lines) + 0.5) - 1);
		   imageline($im, $x, $y, $x1, $y1, $fontColor);	   
		}

		//Drawing lines
		for($i = 0; $i < count($lines); $i++){
			imagettftext ($im, $fontSize, 0, 0, $fontSize * $interline * ($i + 1), $fontColor, $font, $lines[$i]);
		}
		
								
		//Output png 
		// Output the image to browser
		//header('Content-Type: image/png');
		imagepng($im, "../../../files/captcha.png");
		imagedestroy($im);	
}

function getLineWordsCount($strArr, $width, $bbox, $fontSize, $font){
	$minus = 0;
	while($bbox[2] >= $width) {
		$minus++;
		$line = getLineWidth($minus, $strArr);
		$bbox = imagettfbbox($fontSize, 0, $font, $line);			
	}
	return $minus;
}

function getLineWidth($minus, $strArr){
	$line = null;
	for($i = 0; $i < count($strArr) - $minus; $i++){
		$line .= ' '.$strArr[$i];
	}
	return $line;
}

function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}
?>