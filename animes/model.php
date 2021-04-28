<?php

function getAllAnimes() {
  $all_animes = json_decode(file_get_contents('animes.json'), true);
  return $all_animes;
}

function getCharactersOfAnime($anime) {
  $all_chars = json_decode(file_get_contents('characters.json'), true);
  $filter = function($char) use ($anime) {
    return $char['anime'] == $anime;
  };
  return array_values(array_filter($all_chars, $filter));
}

function updateAnime($anime, $data) {
  // TODO: implement
  return false;
}
