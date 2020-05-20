<?php 


	//Access the $_FILES global variable for this specific file being uploaded
	//and creates local PHP variables from the $_FILES array of information
$fileName = $file['name']; //The file name
$fileTmpLoc = $file['tmp_name']; //File in the PHP tmp folder
$fileType = $file['type']; //The type of file it is
$fileSize = $file['size']; //File size in bytes
$fileErrorMsg = $file['error']; //0 for false and 1 for true
$kaboom = explode('.',$fileName); //Split file name into an array using dot
$fileExt = end($kaboom); //Now target the last array element to get extension

  //START PHP Image Upload Error Handling....
if (!$fileTmpLoc) { //if file not chosen
	echo "ERROR: Please browse for a file before clicking the upload button";
	exit();
} elseif ($fileSize > 2000000) { //if file size larger than 5 Megabyte
	echo "ERROR: Your file was larger than 5 Megabytes in size";
	unlink($fileTmpLoc);//Remove the uploaded file from the PHP temp folder
	exit();
} elseif (!preg_match('/\.(gif|jpg|png)$/i',$fileName)) {
	//This condition is only if you wish to allow uploading of specific file types
	echo "ERROR: Your image was not .gif, .jpg, or .png";
	unlink($fileTmpLoc);//Remove the uploaded file from the PHP temp folder
	exit();
} elseif ($fileErrorMsg == 1) {//if file upload error key is 1
	echo "ERROR: An error occured while processing the file. Try again";
	exit();
}
//END PHP Image Upload ERROR Handling...
//Place it into your "uploads" folder now using the move_uploaded_file() function
$fileNameNew = 'upload_'.uniqid('',true).'.'.$fileExt;
$file_thumb = $fileNameNew;
$fileNameNew2 = $location.$fileNameNew;
$moveResult = move_uploaded_file($fileTmpLoc, $fileNameNew2);
//Check to make sure the move result is true before continning
if ($moveResult != true) {
	echo "ERROR: File not uploaded. Try again";
	unlink($fileTmpLoc);//Remove the uploaded file from the PHP temp folder
	exit();
}
//unlink($fileTmpLoc);//Remove the uploaded file from the PHP temp folder
//Include the Universal Image Resizing Function...
include_once 'compressor.php';
$target_file = $fileNameNew2;
$resized_file = $location."TL".$fileNameNew;
$wmax = 800;
$hmax = 600;
ak_img_resize($target_file,$resized_file,$wmax,$hmax,$fileExt);
//End of Universal Image Resizing Function...
//Delete the Image originally uploaded
$path = $fileNameNew2;
unlink($path);

$paths = "photo/Thumb/";
if ($location != "photo/Upload/") {
	img_crop($resized_file, $file_thumb, $paths, 500, 500);
} else {
	img_crop($resized_file, $file_thumb, $paths, 600, 370);
}


 ?>