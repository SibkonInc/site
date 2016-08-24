<?php
function show_comments($id_article)//âûâîäâñåõêîììåíòàğèåâêñòàòüå
{
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
 $res = mysql_query("select * from mer_comments where id like $id order by id_comment", $con) or die ("Error! query – show comments");
 while($arr = mysql_fetch_array($res, MYSQL_NUM))
	 {
		echo "
			<div class=main>
			<img src=images/comentator.jpg>
				<div class=block_name>
					<span class=name>$arr[2]</span>
					<span class=date>$arr[5]</span>
				</div>
				<div class=coment>
					<div>$arr[4]</div>
				</div>
			</div>
		";
	}
}
?>