<?php
header("Content-Type: application/json");
include "db.php";

$q = mysqli_query(
  $conn,
  "SELECT id,name,quantity,price,location
   FROM crops
   WHERE status='active'
   ORDER BY id DESC"
);

$data = [];
while ($row = mysqli_fetch_assoc($q)) {
  $data[] = $row;
}

echo json_encode($data);
