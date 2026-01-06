<?php
header("Content-Type: application/json");

echo json_encode([
  "temperature" => "32°C",
  "humidity" => "58%",
  "soil" => "41%",
  "ndvi" => "0.72",
  "alert" => "अगले 48 घंटों में बारिश की संभावना"
]);
