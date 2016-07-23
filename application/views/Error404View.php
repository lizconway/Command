<?php
/*
 * REF :  http://stackoverflow.com/questions/1761252/how-to-get-random-image-from-directory-using-php
 */
$imageDir = "404s";
$pattern = $imageDir."/*.{jpg,jpeg,png,gif}";
$images = glob($pattern, GLOB_BRACE);
$randomNumber = array_rand($images);

$randomImage = $images[$randomNumber];
?>
<div id="container">
	<h1>Oops!</h1>
	<img src="<?php echo base_url()?>/<?php echo $randomImage?>" />
	<h2>
		This page shows a random 404 error message/image everytime you
		go to a non-existing page
	</h2>
</div>
<br><br>
<?php echo anchor('CommandCtrl/getCommandments', 'Get the JSON list of commandments', 'class="button-link"') ?><br><br>
<?php echo anchor('CommandCtrl/getTranslations', 'Get the JSON list of translations', 'class="button-link"') ?><br><br>
<?php echo anchor('CommandCtrl/getCommands', 'Get the next random 404', 'class="button-link"') ?><br><br>
