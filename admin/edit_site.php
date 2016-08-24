<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
$adm = dostup_adm();
if ($adm == "1")
{
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = 1;
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	$name_site = ($_POST['name_site']);
    $name_group = ($_POST['name_group']);
	$status_site = ($_POST['status_site']);
	$status_text = ($_POST['status_text']);
	$theme = ($_POST['theme']);
	$reg = ($_POST['reg']);
	$reg_text = ($_POST['reg_text']);
	$god = ($_POST['god']);
	$st_glav = ($_POST['st_glav']);
	$menu = ($_POST['menu']);
	$arhiv = ($_POST['arhiv']);
	$forum = ($_POST['forum']);
    $module = ($_POST['module']);
	$pp = ($_POST['pp']);
	$mail_adm = ($_POST['mail_adm']);
	$oth_on = htmlspecialchars($_POST['oth_on'], ENT_QUOTES);
	$oth_ob = ($_POST['oth_ob']);
	$god_on = ($_POST['god_on']);
	$god_ob = ($_POST['god_ob']);
	$pass_on = ($_POST['pass_on']);
	$pass_ob = ($_POST['pass_ob']);
	$telefon_on = ($_POST['telefon_on']);
	$telefon_ob = ($_POST['telefon_ob']);
	$osebe_on = ($_POST['osebe_on']);
	$osebe_ob = ($_POST['osebe_ob']);
	$contact_on = ($_POST['contact_on']);
	$contact_ob = ($_POST['contact_ob']);
	$interest_on = ($_POST['interest_on']);
	$interest_ob = ($_POST['interest_ob']);
	$otv_pos = ($_POST['otv_pos']);
		$shema = ($_POST['shema']);
	if ($oth_on == "on")
	{
		$oth_on = 1;
	}
	else
	{
		$oth_on = 0;
	}
	if ($oth_ob == "on")
	{
		$oth_ob = 1;
	}
	else
	{
		$oth_ob = 0;
	}
	if ($god_on == "on")
	{
		$god_on = 1;
	}
	else
	{
		$god_on = 0;
	}
	if ($god_ob == "on")
	{
		$god_ob = 1;
	}
	else
	{
		$god_ob = 0;
	}
	if ($pass_on == "on")
	{
		$pass_on = 1;
	}
	else
	{
		$pass_on = 0;
	}
	if ($pass_ob == "on")
	{
		$pass_ob = 1;
	}
	else
	{
		$pass_ob = 0;
	}
	if ($telefon_on == "on")
	{
		$telefon_on = 1;
	}
	else
	{
		$telefon_on = 0;
	}
	if ($telefon_ob == "on")
	{
		$telefon_ob = 1;
	}
	else
	{
		$telefon_ob = 0;
	}
	if ($osebe_on == "on")
	{
		$osebe_on = 1;
	}
	else
	{
		$osebe_on = 0;
	}
	if ($osebe_ob == "on")
	{
		$osebe_ob = 1;
	}
	else
	{
		$osebe_ob = 0;
	}
	if ($contact_on == "on")
	{
		$contact_on = 1;
	}
	else
	{
		$contact_on = 0;
	}
	if ($contact_ob == "on")
	{
		$contact_ob = 1;
	}
	else
	{
		$contact_ob = 0;
	}
	if ($interest_on == "on")
	{
		$interest_on = 1;
	}
	else
	{
		$interest_on = 0;
	}
	if ($interest_ob == "on")
	{
		$interest_ob = 1;
	}
	else
	{
		$interest_ob = 0;
	}
	mysql_query(" UPDATE setting_site SET name_site='$name_site', name_group='$name_group', status_site='$status_site', status_text='$status_text', theme='$theme', reg='$reg', reg_text='$reg_text', st_glav='$st_glav', arhiv='$arhiv', forum='$forum', module='$module', menu='$menu', god='$god', oth_on='$oth_on', oth_ob='$oth_ob', god_on='$god_on', god_ob='$god_ob', pass_on='$pass_on', pass_ob='$pass_ob', telefon_on='$telefon_on', telefon_ob='$telefon_ob', osebe_on='$osebe_on', osebe_ob='$osebe_ob', contact_on='$contact_on', contact_ob='$contact_ob', interest_on='$interest_on', interest_ob='$interest_ob' , pp='$pp', mail_adm='$mail_adm', otv_pos='$otv_pos' , shema='$shema' where id = '$id'");
	$mess_log = "Изменил настройки сайта.";
	ad_log($mess_log);
}
else
{
	header("Location: $site/error.php?i=7");
}
header("Location: $site/admin.php?id=2&ok=1");
?>