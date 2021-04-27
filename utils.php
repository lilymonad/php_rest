<?php
function print_json($obj) {
  header("Content-Type: application/json");
  echo json_encode($obj);
}
