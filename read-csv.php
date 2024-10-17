<?php
$csv = array();
$name_file = 'cus.csv';
$lines = file($name_file, FILE_IGNORE_NEW_LINES);
//dua du lieu tu file csv vao mang:
foreach ($lines as $key => $value)
{
$csv[$key] = str_getcsv($value);
}
//in mang
echo '<pre>';
print_r($csv);
echo '</pre>';
?>