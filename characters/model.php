<?php

function getCharacters() {
  $all_chars = json_decode(file_get_contents('characters.json'), true);
  return $all_chars;
}
