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
	global $id_user, $tip_user, $site, $god_site, $name_group;
	$adm = dostup_adm();
	$org_god = dostup_org_god($god_site);
	if ($id_user == "")
	{
		error(7);
	}
	else
	{
		$status = status();
		if ($status > "0")
		{
			if ($adm == "1" or $org_god == "1")
			{
				$org = "1";
			}
			else
			{
				$org = "0";
			}
			if (isset($_GET['id']))
			{
				$id = addslashes($_GET['id']);
			}
			else
			{
				$id = "00";
			}
			if (!is_numeric($id))
			{
				die("����� ������ ���!");
			}
			$id = intval($id);
			if (isset($_GET['ok']))
			{
				$ok = addslashes($_GET['ok']);
			}
			$ok = intval($ok);
			if ($ok == "1")
			{
				echo "<div align=\"center\"><font color = red><h4>������ ���� ��������</h4></div>";
			}
			$ok_page = mysql_query("select * from sibkon where id = $id");
			if (!mysql_num_rows($ok_page)) die("error(12).<p>");
			else
			{
				while ($t_page = mysql_fetch_array($ok_page))
				{
					$id_con = $t_page['id'];
					$god = $t_page['god'];
					$tema = $t_page['tema'];
				}
			}
			echo "<div align=\"center\"><h3>���������� $name_group � $god: $tema</h3></div>";
			if ($org == "0")
			{
				echo "<p align = \"center\"><b>���� ����������� �������� � ������ ����������� ����� ����� ����� ��������� ������������.</b></p>";
			}
			else
			{
				echo "<p align = \"center\"><b>���� ����������� �������� � ������ ����������� ����� ����� ����� ��������� ������������.</b></p>";
			}
			echo "
<form name=\"form1\" method=\"post\" action=\"ad_mer_post.php?id=$id_con\">
<table>
<tr><td>��������:</td><td><input type=\"text\"  name='name' size=\"86\" ></td></tr>
<tr>
<!--<td>��������:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=svostvo&amp;width=375\" class=\"jTip\" id=\"cvo\" name=\"��������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>
<select  name=\"zakrito\" size=\"1\"><option value=\"0\">�������</option><option value=\"1\">�������</option></select>
</td>
</tr>";
			if ($org == "1")
			{
				echo "<tr><td>�� ������������:</td><td><input type=\"text\"  name='org' size=\"86\" ></td></tr>  ";
			}
			else
			{
				echo "<input type=\"hidden\"  name='org' size=\"86\" volume = \"$id_user\">";
			}
			if ($org == "1")
			{
				echo "
--!>
				<tr>
<td>����</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=name_tip_mer&amp;width=375\" class=\"jTip\" id=\"n_tip\" name=\"��� �����������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>��� <select id=\"first\" name=\"tip\" size=\"1\"><option value=\"\">--</option></select>
</td>
</tr>";
			}
			echo "
			<!--
			<tr>
<td>����������:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=obs&amp;width=375\" class=\"jTip\" id=\"obsu\" name=\"����������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>
<select  name=\"forum\" size=\"1\"><option value=\"0\">�� �����</option><option value=\"1\">�����</option></select>
</td>

</tr>
<tr>
<td>���������� ��������� ��������������������:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=obs_all&amp;width=375\" class=\"jTip\" id=\"obsu�\" name=\"����������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>
<select  name=\"forum_all\" size=\"1\">
<option value=\"0\">���</option>
<option value=\"1\">��</option>
</select>
</td>
</tr>
--!>
<tr>
<td>����������:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=obs&amp;width=375\" class=\"jTip\" id=\"obsu\" name=\"����������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>
<select  name=\"forum\" size=\"1\">
<option value=\"1\"";
        if ($forum == "1")
        {
          echo " selected ";
        }
        echo ">�����</option>
<option value=\"0\"";
        if ($forum == "0")
        {
          echo " selected ";
        }
        echo ">�� �����</option>

</select>
</td>
</tr>
<tr>
<td>���������� ��������� ��������������������:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=obs_all&amp;width=375\" class=\"jTip\" id=\"obsu�\" name=\"����������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>
<select  name=\"forum_all\" size=\"1\">

<option value=\"1\"";
        if ($forum_all == "1")
        {
          echo " selected ";
        }
        echo ">��</option>
		<option value=\"0\"";
        if ($forum_all == "0")
        {
          echo " selected ";
        }
        echo ">���</option>
</select>
</td>
</tr>
<tr>
<td>�����:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=files&amp;width=375\" class=\"jTip\" id=\"file\" name=\"�����\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>
<select  name=\"files\" size=\"1\"><option value=\"0\">���</option><option value=\"1\">��</option></select>
</td>
</tr>
<!--
<tr>
<td>���������:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=mat&amp;width=375\" class=\"jTip\" id=\"mate\" name=\"���������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>
<select  name=\"mat\" size=\"1\"><option value=\"0\">���</option><option value=\"1\">��</option></select>
</td>
</tr>
--!>
<tr>
<td>��������� �����:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=news_lent&amp;width=375\" class=\"jTip\" id=\"n_lent\" name=\"��������� �����\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>
<select  name=\"news\" size=\"1\"><option value=\"0\">���</option><option value=\"1\">��</option></select>
</td>
</tr>
<tr>
<td>����������:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=upravl&amp;width=375\" class=\"jTip\" id=\"upra\" name=\"����������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>
<select  name=\"uprav\" size=\"1\"><option value=\"0\">������ �������������</option><option value=\"1\">�������� �������������</option></select>
</td>
</tr>
<!--
<tr>
<td>���������� �����������:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=us&amp;width=375\" class=\"jTip\" id=\"��_�\" name=\"�������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>
<select  name=\"us\" size=\"1\"><option value=\"0\">���������� ����������� ����������</option><option value=\"1\">����������� �� �����</option></select>
</td>
</tr>
<tr>
<td>������ ��� ���������:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=anketa&amp;width=375\" class=\"jTip\" id=\"ank\" name=\"������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>
<select  name=\"anketa\" size=\"1\"><option value=\"0\">�� �����, ������ ������ �� �������</option><option value=\"1\">���������� ���������� ������</option></select>
</td>
</tr>

<tr>
<td>����� ������ (�������):</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=kom&amp;width=375\" class=\"jTip\" id=\"kom\" name=\"������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a>
<select  name=\"komanda\" size=\"1\"><option value=\"0\">�� �����, ������� ��������������</option><option value=\"1\">���������� ��������� �������</option><option value=\"2\">�������� ��� ��������� , ��� � �������������� �������</option></select>
</td>
</tr>
--!>";
$ok_page = mysql_query("select * from sibkon where god = $god_site");
		if (!mysql_num_rows($ok_page)) die("error(12).<p>");
		else
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$tender_v = $t_page['tender'];
			}
            if ($tender == "")
            {
                echo"<tr><td>����������</td><td><textarea name='tender' rows=\"16\" cols='96' >$tender_v</textarea></td></tr>";
                
            }
            else
            {
               echo"<tr><td>����������</td><td><textarea name='tender' rows=\"16\" cols='96' ></textarea></td></tr>"; 
            }
echo"</table>
<p>����� (�������������� ��������� ����� ����� ���������� ����� ��������.)</p><textarea name='text' rows=\"36\" cols='96' id = user_text></textarea></p>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">�������� $name_group</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\"/>                           
</form>
<p>
";
		}
		else
		{
		   echo"<p align = \"center\">�� �� ������ ���������� ���� $name_group. ��� ���������� <a href = \"$site/registr.php\">������������������</a> ��� ������� �� $name_site $god_site</p>";  
		}
?>
<script type="text/JavaScript">
 $(document).ready(function()
 {
	    var selectoptions = {
    		<?
		$ok_tip = mysql_query("SELECT * FROM tip_mer");
		while ($t_tip = mysql_fetch_array($ok_tip))
		{
			$id_tip = $t_tip['id'];
			$name_tip = $t_tip['name'];
?>"<?
			echo $name_tip
?>": {
    	         "key" : <?
			echo $id_tip
?>,
                 "defaultvalue" : 11,
    	         "values" : {
                     <?
			$ok_pod = mysql_query("SELECT * FROM podtip_mer where id_tip = $id_tip");
			while ($t_pod = mysql_fetch_array($ok_pod))
			{
				$id_pod = $t_pod['id'];
				$pod_tip = $t_pod['id_tip'];
				$name_pod_tip = $t_pod['name'];
?>
					 "<?
				echo $name_pod_tip
?>": <?
				echo "$id_pod";
?>,
                     <?
			}
?> "�����": 0
                     }
              },
              
<?
		}
?>
    };

	    $('#first').doubleSelect('second', selectoptions);      
 });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#user_text").bbcode({teg_bold:true,teg_italic:true,teg_underline:true,teg_linck:true,teg_image:true,button_image:true});
  });
</script>
<?
	}
}
function title()
{
	global $name_site, $name_group;
	echo "
<script type=\"text/javascript\" src=\"$site/js/jquery.doubleSelect.min.js\"></script>
<link type=\"text/css\" rel=\"stylesheet\" href=\"$site/js/jtip.css\" media=\"all\">
<script src=\"$site/js/jtip.js\" type=\"text/javascript\"></script>
<script src=\"$site/js/jquery.bbcode.js\" type='text/javascript'></script>
";
	echo "
<title>���������� $name_group | $name_site</title>";
}
function right()
{
    global $name_group;
echo"<h4 align = \"center\">����������</h4>
<p>
�� ����������� �� ������������ ����� $name_group.
<br>
������ ����������� �� ��������, ��� ���� $name_group ����� �������� � ����� ������.
<br>
����������� ����������� � �����������, ������� ���������� � ������� ����.
</p>

";
}
require ("../theme/$theme/$theme.htm");
?>