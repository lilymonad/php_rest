<?php

if (preg_match('/^\/api(\/.*)?/', $_SERVER['REQUEST_URI'])) {
  $path = explode('/', $_SERVER['REQUEST_URI']);
  $method = $_SERVER['REQUEST_METHOD'];

  // $path[0] == '' and $path[1] == 'api' so we start at $path[2]
  switch ($path[2]) {
  case 'animes':
    require_once('animes/router.php');
    routeAnimes(array_slice($path, 3), $method);
    break;
  case 'characters':
    require_once('characters/router.php');
    routeCharacters(array_slice($path, 3), $method);
    break;
  default:
    http_response_code('404');
  }
} else {
  return false;
}
