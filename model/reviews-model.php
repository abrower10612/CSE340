<?php

// REVIEWS MODEL

//insert a review 
// UPDATE ME
function insertReview($reviewText, $invId, $clientId) {
  $db = phpmotorsConnect(); 
  $sql = ' INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR ); 
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT ); 
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT ); 
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}


// get reviews for a specific inventory item 
// UPDATE ME - IN PROGRESS
function getVehicleReviews($invId) {
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM reviews WHERE reviewId = invId';
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $vehicleReviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $vehicleReviews; 
}


// get reviews written by a specific client 
// UPDATE ME
function getClientReviews() {
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $inventory; 
}


// get a specific review 
// UPDATE ME
function getSpecificReview() {
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $inventory; 
}


// update a specific review 
// UPDATE ME
function updateReview() {
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $inventory; 
}


// delete a specific review 
// UPDATE ME
function deleteReview() {
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $inventory; 
}

?>