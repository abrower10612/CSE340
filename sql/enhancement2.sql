-- NUMBER ONE 
INSERT INTO clients (
    `clientFirstname`,
    `clientLastname`,
    `clientEmail`,
    `clientPassword`,
    `comment`
  )
VALUES (
    'Tony',
    'Stark',
    'tony@starkent.com',
    'Iam1ronM@n',
    'I am the real Ironman'
  ) -- NUMBER TWO
UPDATE clients
SET clientLevel = '3'
WHERE `clientID` = '327' -- NUMBER THREE
UPDATE inventory
set `invDescription` = REPLACE(`invDescription`, 'small', 'spacious')
WHERE `invModel` = 'hummer' -- NUMBER FOUR
SELECT inventory.invModel,
  carclassification.classificationName
FROM inventory
  INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId
WHERE carclassification.classificationName = 'SUV';
-- NUMBER FIVE
DELETE FROM `inventory`
WHERE invModel = 'Wrangler' -- NUMBER 6
UPDATE `inventory`
SET `invImage` = CONCAT("/phpmotors", `invImage`),
  `invThumbnail` = CONCAT("/phpmotors", `invThumbnail`)