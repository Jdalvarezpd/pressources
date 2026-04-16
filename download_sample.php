<?php 

$file =  file("pressources_project.pdf");
$file = implode("", $file);
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=pressources_project.pdf");

 ?>