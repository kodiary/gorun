<?php 
$source = realpath('files/events/'.$_GET['pdf']);
$im     = new Imagick($source."[0]"); // 0-first page, 1-second page
$im->setImageFormat('jpg');
header('Content-Type: image/jpeg');
echo $im;