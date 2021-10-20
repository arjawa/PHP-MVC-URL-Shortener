<?php

if(isset($_POST["submit"]) && !empty($_POST["url"])) {
  echo '{"status":"OK"}';

  $route = $_POST["key"];
  $url = $_POST["url"];
  
  $lists = file_get_contents("urls.json");
  $tempArray = json_decode($lists);
  $tempArray->$route = $url;
  
  $jsonData = json_encode($tempArray);
  file_put_contents('urls.json', $jsonData);

} else if (isset($_GET["route"])) {
  $route = $_GET["route"];
  $lists = file_get_contents("urls.json");
  $tempArray = json_decode($lists);
  $destination = $tempArray->$route;
  header("location: $destination");
} else {
  echo '{"status":"error"}';
}

/*
*/