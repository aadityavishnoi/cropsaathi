<?php
header("Content-Type: application/json");

echo json_encode([
  "status" => "OK",
  "service" => "Crop Saathi Backend",
  "time" => date("Y-m-d H:i:s")
]);
