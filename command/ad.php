<?php
/**
 * @author ������
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
echo "<h2 align='center'>�������� ����� �������</h2>";
echo "
<form name=\"form1\" method=\"post\" action=\"ad_post.php\">
<table>
<tr><td>�������� �������:</td><td><input type=\"text\"  name='name' size=\"86\"></td></tr>
<tr><td>���:</td><td>
<select name=\"tip\" size=\"1\">
<option value=\"0\">��������</option>
<option value=\"1\">��������</option>
</select></td></tr>

<tr><td>��� ����� ������ �����������:</td><td>
<select name=\"tip_u\" size=\"1\">
<option value=\"0\">���</option>
<option value=\"1\">������ ������������������</option>
</select></td></tr>

<tr><td>��������� ���� ��� ����� ������ �� �������?</td><td>
<select name=\"tp\" size=\"1\">
<option value=\"0\">���</option>
<option value=\"1\">��</option>
</select></td></tr>

<tr><td>���������� ��������</td><td>
<select name=\"adm\" size=\"1\">
<option value=\"0\">������ ����</option>
<option value=\"1\">������������</option>
</select></td></tr>

<tr><td>��������� ������������ ������</td><td>
<select name=\"files\" size=\"1\">
<option value=\"0\">��</option>
<option value=\"1\">���</option>
</select></td></tr>

<tr><td>��������� �����</td><td>
<select name=\"forum\" size=\"1\">
<option value=\"0\">��</option>
<option value=\"1\">���</option>
</select></td></tr>

</table>
<p>�����<br><textarea name='text' rows=\"36\" cols='96' >$text</textarea></p>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">������� �������</a></span> 
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
<title>���������� ������� | $name_site</title>";
}
function right()
{
}
require ("../theme/$theme/$theme.htm");
?>