<?php
header("Content-Type: application/json");
include "db.php";

if (!isset($_POST['bid_id'])) {
  http_response_code(400);
  echo json_encode(["error"=>"bid_id required"]);
  exit;
}

$bidId = intval($_POST['bid_id']);

/* 1. Accept bid */
mysqli_query(
  $conn,
  "UPDATE bids SET status='accepted' WHERE id=$bidId"
);

/* 2. Fetch bid + crop */
$q = mysqli_query(
  $conn,
  "SELECT b.*, c.farmer_id
   FROM bids b
   JOIN crops c ON b.crop_id=c.id
   WHERE b.id=$bidId"
);

$d = mysqli_fetch_assoc($q);

/* 3. Create order */
mysqli_query(
  $conn,
  "INSERT INTO orders
   (crop_id,bid_id,farmer_id,buyer_name,final_price,quantity)
   VALUES
   ('{$d['crop_id']}','$bidId','{$d['farmer_id']}',
    '{$d['buyer_name']}','{$d['price']}','{$d['quantity']}')"
);

/* 4. Mark crop sold */
mysqli_query(
  $conn,
  "UPDATE crops SET status='sold'
   WHERE id='{$d['crop_id']}'"
);

echo json_encode([
  "success" => true,
  "message" => "Bid accepted & order created"
]);
