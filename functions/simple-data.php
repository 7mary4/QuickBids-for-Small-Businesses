<?php
//grab xml using curl and generate a php data object
function My_simplexml_load_file($URL)
  {
  $ch = curl_init($URL);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HEADER, 0);

  $xml = simplexml_load_string(curl_exec($ch));

  curl_close($ch);

  return $xml;
  }   

// grab json using curl and generate a php data object
function My_simplejson_load_file($URL)
  {
  $ch = curl_init($URL);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HEADER, 0);

  $json = json_decode(curl_exec($ch));

  curl_close($ch);

  return $json;
  }
?>