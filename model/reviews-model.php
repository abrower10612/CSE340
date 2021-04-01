<?php

// REVIEWS MODEL

//insert a review 
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
function getVehicleReviews($invId) {
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM reviews JOIN clients WHERE invId = :invId AND reviews.clientId = clients.clientId';
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $vehicleReviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $vehicleReviews; 
}


// get reviews written by a specific client 
function getClientReviews($clientId) {
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM reviews JOIN inventory WHERE clientId = :clientId AND reviews.invId = inventory.invId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $clientReviews = $stmt->fetchAll(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $clientReviews; 
}


// get a specific review 
function getSpecificReview($reviewId) {
  $db = phpmotorsConnect(); 
  $sql = ' SELECT * FROM reviews JOIN clients WHERE reviewId = :reviewId AND reviews.clientId = clients.clientId'; 
  $stmt = $db->prepare($sql); 
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT); 
  $stmt->execute(); 
  $reviewInfo = $stmt->fetch(PDO::FETCH_ASSOC); 
  $stmt->closeCursor(); 
  return $reviewInfo; 
}


// update a specific review 
// UPDATE ME - IN PROGRESS
function updateReview($reviewText, $reviewId) {
  $db = phpmotorsConnect();
  $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}


// delete a specific review 
// UPDATE ME
function deleteReview($reviewId) {
  $db = phpmotorsConnect();
  $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

?>