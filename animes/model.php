<?php

function getAllAnimes() {
  $all_animes = json_decode(file_get_contents('animes.json'), true);
  return $all_animes;
}

function getCharactersOfAnime($anime) {
  $all_animes = json_decode(file_get_contents('animes.json'), true);
  return $all_animes[$anime]['characters'];
}

function addCharacterInAnime($anime, $data) {
  // TODO: implement
  return false;
}
