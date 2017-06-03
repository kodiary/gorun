<?php if($this->constrainImage):
?>
	<img class="" width="<?php echo $this->width;?>" height="<?php echo $this->height;?>" src="<?php echo $src;?>" alt="<?php echo $alt;?>" />
<?php else: ?>
	<a href='<?php echo $url;?>'><img  src="<?php echo $src;?>" alt="<?php echo $alt;?>" /></a>
<?php endif ?>
