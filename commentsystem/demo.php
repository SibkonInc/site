<?php

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

include "connect.php";
include "comment.class.php";


/*
/	Select all the comments and populate the $comments array with objects
*/

$comments = array();
$result = mysql_query("SELECT * FROM mer_comments ORDER BY id ASC");

while($row = mysql_fetch_assoc($result))
{
	$comments[] = new Comment($row);
}

?>
<link rel="stylesheet" type="text/css" href="styles.css" />
<div id="main">
<?php

/*
/	Output the comments one by one:
*/

foreach($comments as $c){
	echo $c->markup();
}

?>

<div id="addCommentContainer">
	<p>Обсуждение</p>
	<form id="addCommentForm" method="post" action="">
    	<div>
        	<label for="name">Имя</label>
        	<input type="text" name="name" id="name" />
            
            <label for="body">Текст комментария</label>
            <textarea name="body" id="body" cols="20" rows="5"></textarea>
            
            <input type="submit" id="submit" value="Отправить" />
        </div>
    </form>
</div>

</div>

<script type="text/javascript" src="script.js"></script>