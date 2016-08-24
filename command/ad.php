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
	global $id_user;
if ($id_user == "")
{
	error(6);
}	
else
{
echo "<h2 align='center'>Создание новой команды</h2>";
echo "
<form name=\"form1\" method=\"post\" action=\"ad_post.php\">
<table>
<tr><td>Название команды:</td><td><input type=\"text\"  name='name' size=\"86\"></td></tr>
<tr><td>Тип:</td><td>
<select name=\"tip\" size=\"1\">
<option value=\"0\">Открытая</option>
<option value=\"1\">Закрытая</option>
</select></td></tr>

<tr><td>Кто может писать комментарии:</td><td>
<select name=\"tip_u\" size=\"1\">
<option value=\"0\">Все</option>
<option value=\"1\">Только зарегистрированные</option>
</select></td></tr>

<tr><td>Текстовое поле при подчи заявки на участие?</td><td>
<select name=\"tp\" size=\"1\">
<option value=\"0\">Нет</option>
<option value=\"1\">Да</option>
</select></td></tr>

<tr><td>Управление командой</td><td>
<select name=\"adm\" size=\"1\">
<option value=\"0\">Только мной</option>
<option value=\"1\">Руководством</option>
</select></td></tr>

<tr><td>Разрешить прикрепление файлов</td><td>
<select name=\"files\" size=\"1\">
<option value=\"0\">Да</option>
<option value=\"1\">Нет</option>
</select></td></tr>

<tr><td>Разрешить форум</td><td>
<select name=\"forum\" size=\"1\">
<option value=\"0\">Да</option>
<option value=\"1\">Нет</option>
</select></td></tr>

</table>
<p>Текст<br><textarea name='text' rows=\"36\" cols='96' >$text</textarea></p>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Создать команду</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\"/>                           
</form>
";
	}

}
function title()
{
	global $id_user, $name_site;
	echo "
<title>Добавление новости | $name_site</title>";
}
function right()
{
}
require ("../theme/$theme/$theme.htm");
?>