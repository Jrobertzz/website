<?php

session_start();
if(count($_SESSION) == 0)
	header("location: login.php");

$filename = $_GET['filename'];

    //****CHANGE TO LOCATION YOU HAVE R/W PERMISSIONS*******
$path = ''.$filename;
$download = "Content-Disposition: attachment; filename=" . $filename;

header('Content-Type: application/octet-stream');
header($download);

  $handle = fopen($path, 'rb'); 
  $buffer = ''; 
  while (!feof($handle)) { 
    $buffer = fread($handle, 4096); 
    echo $buffer; 
    ob_flush(); 
    flush(); 
  } 
  fclose($handle); 
?>
