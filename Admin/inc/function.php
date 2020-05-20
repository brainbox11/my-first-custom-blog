<?php
// Destroys every existing session.
function destroySession()
{
session_unset();
session_destroy();
}

// This function sanitizes any input from the user
function mysql_entities_fix_string($conn, $string)
{
return htmlentities(mysql_fix_string($conn, $string));
}


function mysql_fix_string($conn, $string)
{
if (get_magic_quotes_gpc()) $string = stripslashes($string);
return $conn->real_escape_string($string);
}
// Sanitizes an input to avoid hijacks.
function sanitizeString($var)
{
global $conn;
$var = strip_tags($var);
$var = htmlentities($var);
$var = stripslashes($var);
return $conn->real_escape_string($var);
}


// 
function showProfile($user)
{
if (file_exists("$user.jpg"))
echo "<img src='$user.jpg' style='float:left;'>";
$result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
if ($result->num_rows) {
$row = $result->fetch_array(MYSQLI_ASSOC);
echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
}
}

// Crop Image Size...
function img_crop($filename, $new_image, $path, $w, $h){

$image_size = getimagesize($filename);
	$image_width = $image_size[0];
	$image_heigth = $image_size[1];

//width and height of output image
$width = $w;
$height = $h;

$left = ($image_width - $width) / 2;
$top = 0;
if ($image_width < $width) {
 	$width = $image_width;
 	$height = $image_width;
 } 

//Get image to be cropped
$new_file = imagecreatetruecolor($width, $height);

$img = imagecreatefromjpeg($filename);

//echo "<img src='$img2'><br><img src='post-test.jpg'>";
//Output to the browser
//header("Content-Type: image/jpeg");
imagecopy($new_file,$img,0,0,$left,$top,$image_width,$image_heigth);
imagejpeg($new_file, $path."thumb_TL".$new_image, 65);
}

function userTimeout($timeout)
{
	$idletime = 600;

	if ((time() - $timeout) > $idletime) {
		header("Location: logout.php?session=expired");
		exit();
	} else {
		$_SESSION['timestamp'] = time();
	}
}


?>