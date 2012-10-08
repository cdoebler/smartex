<?php

require_once 'SmartEx.php';

$text = 'Name: Christian Doebler
Job: Developer';
$pattern = "Name: {name}\nJob: {job}";
$vars = SmartEx::get($text, $pattern);
var_dump($vars);
/*
array(2) {
  ["name"]=>
  string(17) "Christian Doebler"
  ["job"]=>
  string(9) "Developer"
}
*/

$text = 'Christian Doebler, Developer <info@christian-doebler.net>';
$pattern = '{name}, {job} <{email}>';
$vars = SmartEx::get($text, $pattern);
var_dump($vars);
/*
array(3) {
  ["name"]=>
  string(17) "Christian Doebler"
  ["job"]=>
  string(9) "Developer"
  ["email"]=>
  string(26) "info@christian-doebler.net"
}
*/
