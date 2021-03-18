<?php

// Get the array of classifications
$classifications = getClassifications();

// confirm that the email address is correct
function checkEmail($clientEmail)
{
  $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
  return $valEmail;
}

// check that password has at least 8 characters, one lowercase, one capital, one number, one special char
function checkPassword($clientPassword)
{
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
  return preg_match($pattern, $clientPassword);
}

// creates and displays the navigation bar in each view
function navList($classifications) {
  $navList = '<ul>';
  $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
  foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
      . urlencode($classification['classificationName'])
      . "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>';

  return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
  $classificationList = '<select name="classificationId" id="classificationList">'; 
  $classificationList .= "<option>Choose a Classification</option>"; 
  foreach ($classifications as $classification) { 
   $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
  } 
  $classificationList .= '</select>'; 
  return $classificationList; 
 }

 // this function will build a display of vehicles within an unordered list (dv stands for display vehicle)
 function buildVehiclesDisplay($vehicles) {
   $dv = '<ul id="inv-display">';
   foreach($vehicles as $vehicle) {
     $dv .= "<li><a href='/phpmotors/vehicles/index.php?action=getVehicleInfo&invId="
      . urlencode($vehicle['invId'])
      . "'>";
     $dv .= "<img src='$vehicle[invThumbnail]' class='invImage' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
     $dv .= '<hr>';
     $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
     $dv .= "<span>$"; 
     $dv .= number_format($vehicle['invPrice'], 2);
     $dv .= "</span><br>";
     $dv .= '</li>';
   }
   $dv .= '</ul>';
   return $dv; // returns the variable $dv to the controller where it is stored as $vehicleDisplay and is then ready to be used in the view
 }

 function vehicleInfo($getVehicleInfo) {
    $vi = "<div id='vehicleInfo-display'>";
    $vi .= "<h1>$getVehicleInfo[invMake] $getVehicleInfo[invModel]</h1>";
    $vi .= "<img src='$getVehicleInfo[invImage]' alt='Image of $getVehicleInfo[invMake] $getVehicleInfo[invModel] on phpmotors.com'>";
    $vi .= "<section>";
    $vi .= "<h2>Price:</h2>";
    $vi .= "<p>$"; 
    $vi .= number_format($getVehicleInfo['invPrice'], 2);
    $vi .= "</p>";
    $vi .= "<h2>Description:</h2>";
    $vi .= "<p>$getVehicleInfo[invDescription]</p>";
    $vi .= "<h2>Color:</h2>";
    $vi .= "<p>$getVehicleInfo[invColor]</p>";
    $vi .= "<h2>Stock:</h2>";
    $vi .= "<p>$getVehicleInfo[invStock]</p>";
    $vi .= "</section>";
    $vi .= '</div>';
    return $vi;
 }

// **********************************************************
// functions for working with images
// **********************************************************

// adds "-tn" designation to file name
function makeThumbnailName($image) {
  $i = strrpos($image, '.');
  $image_name = substr($image, 0, $i);
  $ext = substr($image, $i);
  $image = $image_name . '-tn' . $ext;
  return $image;
}

// build images display for image management view
function buildImageDisplay($imageArray) {
  $id = '<ul id="image-display">';
  foreach($imageArray as $image) {
    $id .= '<li>';
    $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on Php Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
    $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
    $id .= '</li>';
  }
  $id .= '</ul>';
  return $id;
}

// build the vehicles select list
function buildVehiclesSelect($vehicles) {
  $prodList = '<select name="invId" id="invId">';
  $prodList .= "<option>Choose a vehicle</option>";
  foreach($vehicles as $vehicle) {
    $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
  }
  $prodList .= '</select>';
  return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
  
  // gets the paths, full and local directory
  global $image_dir, $image_dir_path;
  if(isset($_FILES[$name])) {
    // gets the actual file name
    $filename = $_FILES[$name]['name'];
    if(empty($filename)) {
      return;
    }

    // get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];

    // sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;

    // moves the file to the target folder
    move_uploaded_file($source, $target);

    // send file for further processing
    processImage($image_dir_path, $filename);

    // sets the path for the image for database storage
    $filepath = $image_dir . '/' . $filename;

    // returns the path where the file is stored
    return $filepath;
  }
}

// processes images by getting paths
// and creating smaller versions of the image
function processImage($dir, $filename) {
  // set up the variables
  $dir = $dir . '/';

  // set up hte image path
  $image_path = $dir . $filename;

  // set up the thumbnail image path
  $image_path_tn = $dir.makeThumbnailName($filename);

  // create a thumbnail image that's a maximum of 200px square
  resizeImage($image_path, $image_path_tn, 200, 200);

  // resize original to a maximum of 500px square
  resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
  // Get image type
  $image_info = getimagesize($old_image_path);
  $image_type = $image_info[2];
 
  // Set up the function names
  switch ($image_type) {
  case IMAGETYPE_JPEG:
   $image_from_file = 'imagecreatefromjpeg';
   $image_to_file = 'imagejpeg';
  break;
  case IMAGETYPE_GIF:
   $image_from_file = 'imagecreatefromgif';
   $image_to_file = 'imagegif';
  break;
  case IMAGETYPE_PNG:
   $image_from_file = 'imagecreatefrompng';
   $image_to_file = 'imagepng';
  break;
  default:
   return;
 } // ends the swith
 
  // Get the old image and its height and width
  $old_image = $image_from_file($old_image_path);
  $old_width = imagesx($old_image);
  $old_height = imagesy($old_image);
 
  // Calculate height and width ratios
  $width_ratio = $old_width / $max_width;
  $height_ratio = $old_height / $max_height;
 
  // If image is larger than specified ratio, create the new image
  if ($width_ratio > 1 || $height_ratio > 1) {
 
   // Calculate height and width for the new image
   $ratio = max($width_ratio, $height_ratio);
   $new_height = round($old_height / $ratio);
   $new_width = round($old_width / $ratio);
 
   // Create the new image
   $new_image = imagecreatetruecolor($new_width, $new_height);
 
   // Set transparency according to image type
   if ($image_type == IMAGETYPE_GIF) {
    $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
    imagecolortransparent($new_image, $alpha);
   }
 
   if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
    imagealphablending($new_image, false);
    imagesavealpha($new_image, true);
   }
 
   // Copy old image to new image - this resizes the image
   $new_x = 0;
   $new_y = 0;
   $old_x = 0;
   $old_y = 0;
   imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
 
   // Write the new image to a new file
   $image_to_file($new_image, $new_image_path);
   
   // Free any memory associated with the new image
   imagedestroy($new_image);
   } 
   else {

   // Write the old image to a new file
   $image_to_file($old_image, $new_image_path);
   }

   // Free any memory associated with the old image
   imagedestroy($old_image);
 } // ends resizeImage function

?>