<?
//�������� ��������
$title = "����������� ������ ������������";
//�������� ������������
//����������� ����
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function reg_form()
{
	global $id_user, $name_site, $site;
	$site_info = mysql_query("select pp from setting_site");
	while ($site_i = mysql_fetch_array($site_info))
	{
		$pp = $site_i['pp'];
	}
	if (!($pp == ""))
	{
		echo "<div align=\"center\">������������ � <a href = \"$site/?id=$pp\">��������� ���������</a> �� ����� $name_site</div>";
	}
	$site_info = mysql_query("select * from setting_site");
	while ($site_i = mysql_fetch_array($site_info))
	{
		$oth_on = $site_i['oth_on'];
		$god_on = $site_i['god_on'];
		$pass_on = $site_i['pass_on'];
		$telefon_on = $site_i['telefon_on'];
		$osebe_on = $site_i['osebe_on'];
		$contact_on = $site_i['contact_on'];
		$interest_on = $site_i['interest_on'];
		$oth_ob = $site_i['oth_ob'];
		$god_ob = $site_i['god_ob'];
		$pass_ob = $site_i['pass_ob'];
		$telefon_ob = $site_i['telefon_ob'];
		$osebe_ob = $site_i['osebe_ob'];
		$contact_ob = $site_i['contact_ob'];
		$interest_ob = $site_i['interest_ob'];
	}
	echo "<script type=\"text/javascript\">
 var RecaptchaOptions = {
    theme : 'clean'
 };
 </script>";
	echo "<br>
���� ���������� <font color = \"#FF0000\">������� ������</font> ����������� ��� ����������.

<form id=\"formID\" class=\"formular\" method=\"post\" action=\"$site/reg/post.php\">
<table>
<tr><td><font color = \"#FF0000\">�����</font>:</td><td><input type=\"text\" name=\"login_us\" size = \"50\" class=\"validate[required,custom[noSpecialCaracters],length[0,20],]\" id=\"login\"></td></tr>
<tr><td><font color = \"#FF0000\">������</font>:</td><td><input size = \"50\" class=\"validate[required,length[5,11]] text-input\" type=\"password\" name=\"passw_us\"  id=\"password\" ></td></tr>
<tr><td><font color = \"#FF0000\">����������� ������</font>:</td><td><input name=\"passw2_us\" size = \"50\"  class=\"validate[required,confirm[password]] text-input\" type=\"password\" id=\"password2\"></td></tr>
<tr><td><font color = \"#FF0000\">���</font>:</td><td><input type=\"text\" name=\"nick_us\" class=\"validate[required]\" id=\"nick_us\" size = \"50\"></td></tr>
<tr><td><font color = \"#FF0000\">���</font>:</td><td><input type=\"text\" name=\"name_us\" class=\"validate[required,custom[namer]]\" id=\"name_us\"size = \"50\"></td></tr>
<tr><td><font color = \"#FF0000\">�������</font>:</td><td><input type=\"text\" name=\"fam_us\" class=\"validate[required,custom[namer]]\" id=\"fam_us\" size = \"50\"></td></tr>
<tr><td><font color = \"#FF0000\">�����</font>:</td><td><input type=\"text\" name=\"gorod_us\"  id=\"example\" class=\"validate[required,custom[namer]]\" size = \"50\"></td></tr>
<tr><td><font color = \"#FF0000\">Email ����� </font>: </td><td><input value=\"\"  class=\"validate[required,custom[email]] text-input\" type=\"text\" name=\"email\" id=\"email\" size=\"50\" ></td></tr>
<tr><td><font color = \"#FF0000\">����������� email �����</font> : </td><td><input value=\"\" class=\"validate[required,confirm[email]] text-input\" type=\"text\" name=\"email2\"  id=\"email2\" size=\"50\"></td></tr>
";
	if ($oth_on == "1")
	{
		if ($oth_ob == "1")
		{
			echo "<tr><td><font color = \"#FF0000\">��������</font>:</td><td><input type=\"text\" name=\"otch_us\"  size = \"50\" id=\"oth_ob\" class=\"validate[required]\"></td></tr>";
		}
		else
		{
			echo "<tr><td>��������:</td><td><input type=\"text\" name=\"otch_us\"  size = \"50\" ></td></tr>";
		}
	}
	if ($god_on == "1")
	{
		if ($god_ob == "1")
		{
			echo "<tr><td><font color = \"#FF0000\">��� ��������</font>:</td><td><input type=\"text\" name=\"god_us\"  size = \"50\" id=\"god_ob\" class=\"validate[required,length[4,4]]\"></td></tr>";
		}
		else
		{
			echo "<tr><td>��� ��������:</td><td><input type=\"text\" name=\"god_us\"  size = \"50\"></td></tr>";
		}
	}
	if ($pass_on == "1")
	{
		if ($pass_ob == "1")
		{
			echo "<tr><td><font color = \"#FF0000\">������� (����� � �����, 10 ����)</font>:</td><td><input type=\"text\" name=\"passport_us\" size = \"50\" id=\"passport_us\" class=\"validate[required]\"></td></tr>";
		}
		else
		{
			echo "<tr><td>������� (����� � �����, 10 ����):</td><td><input type=\"text\" name=\"passport_us\"  size = \"50\"></td></tr>";
		}
	}
	if ($telefon_on == "1")
	{
		if ($telefon_ob == "1")
		{
			echo "<tr><td><font color = \"#FF0000\">���������� ������� (��� �������������)</font>:</td><td><input type=\"text\" name=\"telefon_us\"  size = \"50\" id=\"example\" class=\"validate[required]\"></td></tr>";
		}
		else
		{
			echo "<tr><td>���������� ������� (��� �������������):</td><td><input type=\"text\" name=\"telefon_us\"  size = \"50\"></td></tr>";
		}
	}
	if ($osebe_on == "1")
	{
		if ($osebe_ob == "1")
		{
			echo "<tr><td><font color = \"#FF0000\">� ����</font>:</td><td><textarea name=\"osebe\" rows='5' cols='41' id=\"osebe_ob\" class=\"validate[required]\"></textarea></td></tr>";
		}
		else
		{
			echo "<tr><td>� ����:</td><td><textarea name=\"osebe\" rows='5' cols='41' ></textarea></td></tr>";
		}
	}
	if ($contact_on == "1")
	{
		if ($contact_ob == "1")
		{
			echo "<tr><td><font color = \"#FF0000\">��������</font>:</td><td><textarea name=\"contact\" rows='5' cols='41' id=\"contact_ob\" class=\"validate[required,custom[namer]]\">$contact</textarea></td></tr>";
		}
		else
		{
			echo "<tr><td>��������:</td><td><textarea name=\"contact\" rows='5' cols='41'></textarea></td></tr>";
		}
	}
	if ($interest_on == "1")
	{
		if ($interest_ob == "1")
		{
			echo "<tr><td><font color = \"#FF0000\">�������� (����� �������)</font>:</td><td><textarea name=\"interest\" rows='5' cols='41' id=\"interest_ob\" class=\"validate[required]\"></textarea></td></tr>";
		}
		else
		{
			echo "<tr><td>�������� (����� �������):</td><td><textarea name=\"interest\" rows='5' cols='41'></textarea></td></tr>";
		}
	}
	echo "
<tr><td> �����:</td><td>";
  require_once('captcha/recaptchalib.php');
  $publickey = "6LdoWtkSAAAAANdfpvptYvdriMp4v-Lxa4bh2LQw"; // you got this from the signup page
  echo recaptcha_get_html($publickey);
  echo "
  </td></tr>
</table>
<input name=\"adress\" type=\"hidden\" value=\"\">
<p align=\"right\">
<input type=\"submit\" value=\"�����������\" ></p>
</form>
";
?>
<script type="text/javascript">
$(document).ready(function(){
// --- �������������� ---
$("#example").autocompleteArray([
<?
	$rows = mysql_query("SELECT gorod_us FROM `us` GROUP BY gorod_us");
	while ($st_mail_us_reg = mysql_fetch_array($rows))
	{
		$kto1 = $st_mail_us_reg['gorod_us'];
		echo "'$kto1',\n";
	}
	echo "
";
?>
],
		{
			delay:10,
			minChars:1,
			matchSubset:1,
			autoFill:true,
			maxItemsToShow:10
		}
);
});
</script>
<?
?>
<script type="text/javascript">
$(function () { 
	$('form').submit(function () {
		$('input[type="submit"]', this).replaceWith('<p><strong>����� ������ � ��������� �����...</strong></p>');
	});
});
</script>   
<?
}
//������� ��������
function action()
{
	global $id_user, $reg_on;
	if ($reg_on == "1")
	{
		if (isset($_GET['ok']))
		{
			$ok = addslashes($_GET['ok']);
		}
		else
		{
			$ok = 0;
		}
		if (!is_numeric($ok))
		{
			die("����� ������ ���!");
		}
		$ok = intval($ok);
		if ($ok == "1")
		{
			echo "<div align=\"center\"><h3>����������� �� ����� ���������!</h3>��� � �������������� ����� ���������� ������ � ����� �����������. ��� ������ ������������� ���������� ���� ������� ������, ��� ����� �������� �� ����������� �����, ��������� ����.</div>";
		}
		else
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
				die("����� ������ ���!");
			}
			$id = intval($id);
			if (isset($_GET['error']))
			{
				$error = addslashes($_GET['error']);
			}
			else
			{
				$error = 0;
			}
			if (!is_numeric($error))
			{
				die("����� ������ ���!");
			}
			$error = intval($error);
			if ($id_user == "")
			{
				echo "<div align=\"center\"><h3>����������� �� �����.</h3></div>";
				if ($error == "1")
				{
					echo "<font color = \"#FF0000\"><h3>���� �� ����� �� �������</h3></font>";
				}
				reg_form();
			}
			else
			{
				if ($id == "2")
				{
					echo "<div align=\"center\"><h3>����������� ����������� �� �����.</h3></div>
					���������� - ������������, ������� �� ����� ������ � ����, ���� ����� ��� ������ �����.<br>
					� ������ ������ �� ���������� ��� �������������� �� �����, ��� ������ �� ����� ��� ���������� �����������, ��������� � ������������ �����������.			
					";
					if ($error == "1")
					{
						echo "<font color = \"#FF0000\"><h3>���� �� ����� �� �������</h3></font>";
					}
					reg_form();
				}
				else
				{
					error(9);
				}
			}
		}
	}
	else
	{
		$site_info = mysql_query("select reg_text from setting_site");
		while ($site_i = mysql_fetch_array($site_info))
		{
			$reg_text = $site_i['reg_text'];
			echo "<div align=\"center\"><h3>����������� �������.</h3></div>$reg_text";
		}
	}
}
function title()
{
	global $name_site, $site;
	echo "
<script src=\"$site/js/jquery.autocomplete.js\" type=\"text/javascript\"></script>
<link type=\"text/css\" rel=\"stylesheet\" href=\"$site/js/jtip.css\" media=\"all\">
<script src=\"$site/js/jtip.js\" type=\"text/javascript\"></script>
";
	echo "
<script type=\"text/javascript\" src=\"$site/js/jquery.validationEngine.js\"></script>
<link type=\"text/css\" rel=\"stylesheet\" href=\"$site/js/validationEngine.jquery.css\">
";
	echo "
<title>����������� �� ����� | $name_site</title>";
}
function right()
{
}

// ���������� ���������
require ("theme/$theme/$theme.htm");
?>