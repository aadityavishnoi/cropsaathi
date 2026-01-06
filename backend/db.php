<?php
header("Content-Type: application/json");

$conn = mysqli_connect(
  "sql100.infinityfree.com",
  "if0_40838189",
  "RiyaRaj1234",
  "if0_40838189_cropsaathi"
);

if (!$conn) {
  http_response_code(500);
  echo json_encode(["error"=>"DB connection failed"]);
  exit;
}
?>
