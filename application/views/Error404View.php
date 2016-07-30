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
<?php //echo anchor('index.php/CommandCtrl/getCommandments', 'Get the JSON list of commandments', 'class="button-link"');
echo anchor('index.php/commandments', 'Get the JSON list of commandments', 'class="button-link"');
echo "&nbsp;&nbsp;index.php/commandments";
?><br><br>
<?php //echo anchor('index.php/CommandCtrl/getCommandments', 'Get the JSON list of commandments', 'class="button-link"');
echo anchor('index.php/commandments/5', 'Get a single commandment (#5)', 'class="button-link"');
echo "&nbsp;&nbsp;index.php/commandments/5";
?><br><br>
<?php //echo anchor('index.php/CommandCtrl/getCommandments', 'Get the JSON list of commandments', 'class="button-link"');
echo anchor('index.php/commandments/2/7', 'Get a subset of commandments (#2 - #7)', 'class="button-link"');
echo "&nbsp;&nbsp;index.php/commandments/2/7";
?><br><br>
<?php //echo anchor('index.php/CommandCtrl/getCommandments', 'Get the JSON list of commandments', 'class="button-link"');
echo anchor('index.php/commandments/8/4', 'Get a reversed subset of commandments (#8 - #4)', 'class="button-link"');
echo "&nbsp;&nbsp;index.php/commandments/8/4";
?><br><br>
<?php //echo anchor('index.php/CommandCtrl/getTranslations', 'Get the JSON list of translations', 'class="button-link"');
echo anchor('index.php/translations', 'Get the JSON list of translations', 'class="button-link"');
?><br><br>
<?php echo anchor('index.php/CommandCtrl/getCommands', 'Get the next random 404', 'class="button-link"'); ?><br><br>
