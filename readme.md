SmartEx
========

### A PHP class for smart extraction of string data

2012 by [Christian Doebler](http://www.christian-doebler.net/)

After stumbling upon [LakTEK's ExtractValues](https://github.com/laktek/extract-values),
I thought about sharing my almost similar PHP-Version, that helped me a lot, some time ago.


#### Examples

<pre>
require_once 'SmartEx.php';


$text = 'Name: Christian Doebler
Job: Developer';
$pattern = "Name: {name}\nJob: {job}";
$vars = SmartEx::get($text, $pattern);
var_dump($vars);

/*
array (
  'name' => 'Christian Doebler',
  'job'  => 'Developer',
)
*/


$text = 'Christian Doebler, Developer <info@christian-doebler.net>';
$pattern = '{name}, {job} <{email}>';
$vars = SmartEx::get($text, $pattern);
var_dump($vars);

/*
array (
  'name'  => 'Christian Doebler',
  'job'   => 'Developer',
  'email' => 'info@christian-doebler.net'
)
*/
</pre>
