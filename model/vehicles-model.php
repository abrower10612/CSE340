<?php

// VEHICLES MODEL

// this function handles the adding of a vehicle to the inventory 
function newVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId)
{
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();

  // The SQL statement
  $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId
  )
  VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';

  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);

  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
  $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
  $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);

  // Insert the data
  $stmt->execute();

  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();

  // Close the database interaction
  $stmt->closeCursor();

  // Return the indication of success (rows changed)
  return $rowsChanged;
}

function newClassification($classificationName)
{
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();

  // The SQL statement
  $sql = 'INSERT INTO carclassification (classificationName)
  VALUES (:classificationName)';

  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);

  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);

  // Insert the data
  $stmt->execute();

  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();

  // Close the database interaction
  $stmt->closeCursor();

  // Return the indication of success (rows changed)
  return $rowsChanged;
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $inventory; 
 }

// Get vehicle information by invId
function getInvItemInfo($invId){
  $db = phpmotorsConnect();
  $sql = 'SELECT * FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
 }

 // this function handles the updating of a vehicle in the inventory 
function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId)
{
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();

  // The SQL statement
  $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId';

  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);

  // The next four lines replace the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
  $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
  $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
  $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
  $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
  $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
  $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
  $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

  // Insert the data
  $stmt->execute();

  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();

  // Close the database interaction
  $stmt->closeCursor();

  // Return the indication of success (rows changed)
  return $rowsChanged;
}

// This function will carry out a vehicle deletion
function deleteVehicle($invId)
{
  // Create a connection object using the phpmotors connection function
  $db = phpmotorsConnect();

  // The SQL statement
  $sql = 'DELETE FROM inventory WHERE invId = :invId';

  // Create the prepared statement using the phpmotors connection
  $stmt = $db->prepare($sql);

  // Replaces the placeholders in the SQL
  // statement with the actual values in the variables
  // and tells the database the type of data it is
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

  // Insert the data
  $stmt->execute();

  // Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();

  // Close the database interaction
  $stmt->closeCursor();

  // Return the indication of success (rows changed)
  return $rowsChanged;
}


// this function is used to query the database for all cars in the classification selected in the menu on phpmotors site
function getVehiclesByClassification($classificationName) {
  $db = phpmotorsConnect();
  // the following line basically says select all from inventory table 
  // where class id matches class id in carclassification table where name equals the class name provided
  // it then returns an array of vehicles in that classification
  $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)'; 
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
  $stmt->execute();
  $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $vehicles;
}

// this function will obtain information about all vehicles in inventory
function getVehicles() {
  $db = phpmotorsConnect();
  $sql = 'SELECT invId, invMake, invModel FROM inventory';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $invInfo;
}


?>