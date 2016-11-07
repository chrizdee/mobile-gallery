<?php
$file_url = $_GET['image'];
if (substr(strtolower($file_url), -3) == 'jpg' && strpos($file_url, 'data/big') && file_exists($file_url))
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: Binary'); 
header('Content-disposition: attachment; filename="' . basename($file_url) . '"'); 
readfile($file_url); 