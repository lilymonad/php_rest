<?php

require_once(__DIR__.'/../utils.php');
require_once('model.php');

function routeCharacters($path, $method) {
  switch ($method) {
  case 'GET':
    print_json(getCharacters());
    break;
  case 'POST':
    // TODO: implement adding a character
    http_response_code('501');
  default:
    // method not allowed
    http_response_code('405');
  }
}
