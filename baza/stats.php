<?php 
require_once "functions.php";
include_once ('header.php');
 ?>
<div id="center_wrap">
	<div id="one_column">
<?php
echo"Hello World!";
?>
	</div>
	<div id="two_column">
		<?php	include ('spisok.php');?>
	</div>
</div>
<?php
include_once ('footer.php');
?>