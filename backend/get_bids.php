<?php
header("Content-Type: application/json");
include "db.php";

$q = mysqli_query(
  $conn,
  "SELECT b.id,b.buyer_name,b.price,b.quantity,c.name AS crop
   FROM bids b
   JOIN crops c ON b.crop_id=c.id
   WHERE b.status='pending'"
);

$data = [];
while ($row = mysqli_fetch_assoc($q)) {
  $data[] = $row;
}

echo json_encode($data);
