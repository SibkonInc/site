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
				die("Такой записи нет!");
			}
			$id = intval($id);
			if (isset($_GET['ok']))
			{
				$ok = addslashes($_GET['ok']);
			}
			$ok = intval($ok);
			if ($ok == "1")
			{
				echo "<div align=\"center\"><font color = red><h4>Данные были изменены</h4></div>";
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
			echo "<div align=\"center\"><h3>Добавление $name_group к $god: $tema</h3></div>";
			if ($org == "0")
			{
				echo "<p align = \"center\"><b>Ваше мероприятие появится в списке мероприятий блока сразу после одобрения Оргкомитетом.</b></p>";
			}
			else
			{
				echo "<p align = \"center\"><b>Ваше мероприятие появится в списке мероприятий блока сразу после одобрения Оргкомитетом.</b></p>";
			}
			echo "
<form name=\"form1\" method=\"post\" action=\"ad_mer_post.php?id=$id_con\">
<table>
<tr><td>Название:</td><td><input type=\"text\"  name='name' size=\"86\" ></td></tr>
<tr>
<!--<td>Свойство:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=svostvo&amp;width=375\" class=\"jTip\" id=\"cvo\" name=\"Свойство\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"zakrito\" size=\"1\"><option value=\"0\">Открыто</option><option value=\"1\">Закрыто</option></select>
</td>
</tr>";
			if ($org == "1")
			{
				echo "<tr><td>ИД организатора:</td><td><input type=\"text\"  name='org' size=\"86\" ></td></tr>  ";
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
<td>Блок</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=name_tip_mer&amp;width=375\" class=\"jTip\" id=\"n_tip\" name=\"Тип мероприятия\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>Тип <select id=\"first\" name=\"tip\" size=\"1\"><option value=\"\">--</option></select>
</td>
</tr>";
			}
			echo "
			<!--
			<tr>
<td>Обсуждения:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=obs&amp;width=375\" class=\"jTip\" id=\"obsu\" name=\"Обсуждения\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"forum\" size=\"1\"><option value=\"0\">Не нужно</option><option value=\"1\">Нужно</option></select>
</td>

</tr>
<tr>
<td>Обсуждения разрешены незарегистрированным:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=obs_all&amp;width=375\" class=\"jTip\" id=\"obsuф\" name=\"Разрешение\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"forum_all\" size=\"1\">
<option value=\"0\">Нет</option>
<option value=\"1\">Да</option>
</select>
</td>
</tr>
--!>
<tr>
<td>Обсуждения:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=obs&amp;width=375\" class=\"jTip\" id=\"obsu\" name=\"Обсуждения\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"forum\" size=\"1\">
<option value=\"1\"";
        if ($forum == "1")
        {
          echo " selected ";
        }
        echo ">Нужно</option>
<option value=\"0\"";
        if ($forum == "0")
        {
          echo " selected ";
        }
        echo ">Не нужно</option>

</select>
</td>
</tr>
<tr>
<td>Обсуждения разрешены незарегистрированным:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=obs_all&amp;width=375\" class=\"jTip\" id=\"obsuф\" name=\"Разрешение\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"forum_all\" size=\"1\">

<option value=\"1\"";
        if ($forum_all == "1")
        {
          echo " selected ";
        }
        echo ">Да</option>
		<option value=\"0\"";
        if ($forum_all == "0")
        {
          echo " selected ";
        }
        echo ">Нет</option>
</select>
</td>
</tr>
<tr>
<td>Файлы:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=files&amp;width=375\" class=\"jTip\" id=\"file\" name=\"Файлы\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"files\" size=\"1\"><option value=\"0\">Нет</option><option value=\"1\">Да</option></select>
</td>
</tr>
<!--
<tr>
<td>Материалы:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=mat&amp;width=375\" class=\"jTip\" id=\"mate\" name=\"Материалы\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"mat\" size=\"1\"><option value=\"0\">Нет</option><option value=\"1\">Да</option></select>
</td>
</tr>
--!>
<tr>
<td>Новостная лента:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=news_lent&amp;width=375\" class=\"jTip\" id=\"n_lent\" name=\"Новостная лента\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"news\" size=\"1\"><option value=\"0\">Нет</option><option value=\"1\">Да</option></select>
</td>
</tr>
<tr>
<td>Управление:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=upravl&amp;width=375\" class=\"jTip\" id=\"upra\" name=\"Управление\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"uprav\" size=\"1\"><option value=\"0\">Только организатором</option><option value=\"1\">Командой организаторов</option></select>
</td>
</tr>
<!--
<tr>
<td>Необходима регистрация:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=us&amp;width=375\" class=\"jTip\" id=\"гы_г\" name=\"Участие\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"us\" size=\"1\"><option value=\"0\">Необходима регистрация участников</option><option value=\"1\">Регистрация не нужна</option></select>
</td>
</tr>
<tr>
<td>Анкеты для участника:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=anketa&amp;width=375\" class=\"jTip\" id=\"ank\" name=\"Анкета\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"anketa\" size=\"1\"><option value=\"0\">Не нужна, просто заявка на участие</option><option value=\"1\">Необходимо заполнение анкеты</option></select>
</td>
</tr>

<tr>
<td>Нужны группы (команды):</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=kom&amp;width=375\" class=\"jTip\" id=\"kom\" name=\"Анкета\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"komanda\" size=\"1\"><option value=\"0\">Не нужно, участие индивидуальное</option><option value=\"1\">Необходимо групповое участие</option><option value=\"2\">Возможно как групповое , так и индивидуальное участие</option></select>
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
                echo"<tr><td>Требования</td><td><textarea name='tender' rows=\"16\" cols='96' >$tender_v</textarea></td></tr>";
                
            }
            else
            {
               echo"<tr><td>Требования</td><td><textarea name='tender' rows=\"16\" cols='96' ></textarea></td></tr>"; 
            }
echo"</table>
<p>Анонс (дополнительные материалы можно будет прикрепить после создания.)</p><textarea name='text' rows=\"36\" cols='96' id = user_text></textarea></p>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Добавить $name_group</a></span> 
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
		   echo"<p align = \"center\">Вы не можете предлагать свое $name_group. Вам необходмио <a href = \"$site/registr.php\">Зарегистрироваться</a> для участия на $name_site $god_site</p>";  
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
?> "новое": 0
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
<title>Добавление $name_group | $name_site</title>";
}
function right()
{
    global $name_group;
echo"<h4 align = \"center\">Добавление</h4>
<p>
Вы предлагаете на рассмотрение новое $name_group.
<br>
Данное предложение не означает, что ваше $name_group будет включено в общий реестр.
<br>
Внимательно ознакомтесь с подсказками, которые обозначены у каждого поля.
</p>

";
}
require ("../theme/$theme/$theme.htm");
?>