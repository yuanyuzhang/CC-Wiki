<?php
$file=$_GET['f'];
echo $file;
echo mkdir($file,0777);
?>
