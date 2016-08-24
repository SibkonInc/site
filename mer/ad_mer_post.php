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
	$adm = dostup_adm();
	$org_god = dostup_org_god($god_site);
	$id_con = addslashes($_GET['id']);
	$name = addslashes($_POST['name']);
	$tip = addslashes($_POST['tip']);
	$podtip = addslashes($_POST['podtip']);
	$zakrito = addslashes($_POST['zakrito']);
	$forum = addslashes($_POST['forum']);
    $forum_all = addslashes($_POST['forum_all']);
	$files = addslashes($_POST['files']);
	$org_m = addslashes($_POST['org']);
	$mat = addslashes($_POST['mat']);
	$news = addslashes($_POST['news']);
	$uprav = addslashes($_POST['uprav']);
	$anketa = addslashes($_POST['anketa']);
	$us = addslashes($_POST['us']);
	$text = getHtml($_POST['text']);
	$tender = addslashes($_POST['tender']);
	if ($adm == "1" or $org_god == "1")
	{
		$org = "$org_m";
		$yes = "0";
	}
	else
	{
		$org = "$id_user";
		$yes = "1";
	}
	if ($org == "")
	{
		$org = "$id_user";
	}
	mysql_query("insert into `meropriatia`(id_con ,tip,podtip,name,text,yes,forum,forum_all,files,mat,uprav,news,zakrito,anketa,us,tender) values
                     ('$id_con', '$tip', '$podtip', '$name', '$text', '$yes', '$forum', '$forum_all', '$files', '$mat', '$uprav', '$news','$zakrito', '$anketa' , '$us', '$tender')");
	$nit = mysql_insert_id();
	mysql_query("insert into `mer_us`(id_command,id_us,tip) values('$nit', '$org', '1')");
	$ok_page = mysql_query("select * from sibkon where id = $id_con");
	{
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$id_con = $t_page['id'];
			$god = $t_page['god'];
			$tema = $t_page['tema'];
		}
	}
	$mess_log = "Добавил $name_group <a href = $site/mer.php?id=$nit>$name</a> к проекту <a href = $site/sibkon.php?id=$god>$god: $tema</a> ";
	ad_log($mess_log);
	header("Location: $site/mer.php?id=$nit&ok=1");
}
?>