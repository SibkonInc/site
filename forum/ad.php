<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
if ($id_user == "")
{
	header("Location: $site/error.php?i=7");
}
else
{
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = "0";
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	if (isset($_GET['otv']))
	{
		$otv = addslashes($_GET['otv']);
	}
	else
	{
		$otv = "0";
	}
	if (!is_numeric($otv))
	{
		die("Такой записи нет!");
	}
	$otv = intval($otv);
	$text = addslashes($_POST['text']);
	$date = date("Y-m-d H:i");
	mysql_query("insert into `comment`(id_us,id_page,text,date,com_otv) values('$id_user', '$id','$text', '$date', '$otv')");
	$nit = mysql_insert_id();
	$ok_news = mysql_query("select com_count from forum where id = '".$id."'");
			while ( $t_news = mysql_fetch_array($ok_news) )
		{		 $com_count = $t_news['com_count'];
		}
  $com_count1 = $com_count + 1;
		mysql_query  (" UPDATE forum SET com_count='$com_count1',data_old='$date' where id = '$id'");
	$q = "SELECT count(*) FROM `comment` where `id_page` = $id";
	$res = mysql_query($q);
	$row = mysql_fetch_row($res);
	$total_rows = $row[0];
	$per_page = 20;
	$num_pages = ceil($total_rows / $per_page);
	header("Location: $site/forum.php?id=$id&str=$num_pages#$nit");
}
?>