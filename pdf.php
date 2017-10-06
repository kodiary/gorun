<?php 
$source = realpath('files/events/'.$_GET['pdf']);
$im     = new Imagick($source."[0]"); // 0-first page, 1-second page
$im->setImageFormat('jpg');
$im->thumbnailimage(120, 150);
header('Content-Type: image/jpeg');
echo $im;