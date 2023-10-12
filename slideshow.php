<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport"content="width=device-width,initial-scale=1.
    8">
    <title>Simplet jQuery Slideshow</title>
</head>
<style>
body {font-family:Arial, Helvetica, sans-serif; font-size:12px;}
 
.fadein
 { 
position:relative; height:900px; width:1000px; margin:0 auto;

padding: 10px;
 }
 .fadein img{
	position:absolute;
	width: calc(96%);
    height: calc(94%);
    width: 1250px;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
$(function(){
	$('.fadein img:gt(0)').hide();
	setInterval(function(){$('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');}, 5000);
});
</script>

<body>
<div class="fadein">
<?php 
// display images from directory
// directory path
$dir = "./slider/";
 
$scan_dir = scandir($dir);
foreach($scan_dir as $img):
	if(in_array($img,array('.','..')))
	continue;
?>
<img src="<?php echo $dir.$img ?>" alt="<?php echo $img ?>">
<?php endforeach; ?>
</div>


</body>
</html>