<?php


require_once(__DIR__.'/../utils.php');
require_once('model.php');

function routeAnimes($path, $method) {
  if (isset($path[0])) {

    $anime = $path[0];
    specificAnime(array_slice($path, 1), $method, $anime);

  } else {
    switch ($method) {
    case 'GET':
      print_json(getAllAnimes());
      break;
    case 'POST':
      // TODO: implement adding an anime
      http_response_code('501');
    default:
      // method not allowed
      http_response_code('405');
    }
  }
}

function specificAnime($path, $method, $anime) {
  // if path continues, handle continuation
  if (isset($path[0])) {
    switch ($path[0]) {
    case 'characters': // /animes/{id}/characters
      switch ($method) {
      case 'GET':
        print_json(getCharactersOfAnime($anime));
        break;
      default:
        http_response_code('405');
      }
      break;
    default:
      http_response_code('404');
    }

  // if path ends, handle method
  } else {
    switch ($method) {
    case 'PUT':
      $data = json_decode(file_get_contents("php://input"), true);
      if (updateAnime($anime, $data)) {
        http_response_code('200');
      } else {
        http_response_code('424');
      }
      http_response_code('501');
    default:
      // method not allowed
      http_response_code('405');
    }
  }
}
