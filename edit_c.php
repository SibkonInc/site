<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function action()
{
 global $id_user, $tip_user, $site, $god_site;
 if ($id_user == "")
 {
  error(6);
 }
 else
 {
 // $adm = dostup_adm();
 //if ($adm == "1")
 // {
   if (isset($_GET['id']))
   {
    $id = addslashes($_GET['id']);
   }
   else
   {
    $id = 0;
   }
   if (!is_numeric($id))
   {
    die("Такой записи нет!");
   }
   $ok_page = mysql_query("select * from comment where  id_com  = $id");
   while ($t_page = mysql_fetch_array($ok_page))
   {
    $text = nl2br($t_page['text']);
   }
   echo "
		<h4 align = \"center\">Редактирование форума</h4>
        Автор: $avtor
<form name=\"form1\" method=\"post\" action=\"edit_c_post.php?id=$id\">
<p>Текст<br><textarea name='text' rows=\"36\" cols='96' >$text</textarea></p>
<div align=\"right\">
<ul class='nNav' style=\"width:235px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/forum/del.php?i=2&id=$id\">Удалить</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Изменить</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\"/>                           
</form>
";
  //}
  // else
  //{
  // error(7);
  //}
 }
}
function title()
{
 global $id_user, $name_site;
 echo "
<title>редактирование коментария | $name_site</title>";
}
function right()
{
}
require ("../theme/$theme/$theme.htm");
?>