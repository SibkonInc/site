<?php
/**
 * @author Yerick
 * @copyright 2009
 * @name YCMS 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function action()
{
  global $id_user, $tip_user, $site, $god_site;
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
  $adm = dostup_adm();
  $org_god = dostup_org_god($god_site);
  $org_mer = dostup_mer_adm($id);
  if ($adm == "1" or $org_god == "1" or $org_mer == "1")
  {
    $dostup = "1";
  }
  $ok_page = mysql_query("select * from meropriatia where id = $id");
  if (!mysql_num_rows($ok_page))
    die("error(12).<p>");
  else
    while ($t_page = mysql_fetch_array($ok_page))
    {
      $id = $t_page['id'];
      $id_con = $t_page['id_con'];
      $name = $t_page['name'];
      $text = $t_page['text'];
      $tip = $t_page['tip'];
      $podtip = $t_page['podtip'];
      $yes = $t_page['yes'];
      $forum = $t_page['forum'];
      $forum_all = $t_page['forum_all'];
      $files = $t_page['files'];
      $mat = $t_page['mat'];
      $uprav = $t_page['uprav'];
      $news = $t_page['news'];
      $zakrito = $t_page['zakrito'];
      $tender = $t_page['tender'];
      $anketa = $t_page['anketa'];
      $komand = $t_page['komand'];
	  $v_spiske = $t_page['v_spiske'];
      $ok_pag = mysql_query("select * from mer_us where id_command = $id  and tip = 1");
      while ($t_pag = mysql_fetch_array($ok_pag))
      {
        $id_org = $t_pag['id_us'];
      }
    }
  echo "<h3 align = \"center\">Редактирование $name</h3>";
  if ($yes == "1")
  {
    echo "<h4 align = \"center\"><font color = \"#FA0707\"><strong>Требует одобрения</strong></font></h4>";

  }
  else
    if ($yes == "3")
    {
      echo "<h4 align = \"center\"><font color = \"#FA0707\"><strong>Мероприятие не принято к проведению</strong></font></h4>";
    }
    else
    {
      echo "<h4 align = \"center\"><strong>Мероприятие одобрено, редактирование разрешено только организатору мероприятия.</font></h4>";
    }
    if ($dostup == "1")
    {
      echo "<form name=\"form1\" method=\"post\" action=\"edit_post.php?id=$id\">
<table>";
      //показываем все, что показывается всем
      echo "
<tr><td>Название:</td><td><input type=\"text\"  name='name' size=\"86\" value= \"$name\"></td></tr>";
      if ($org_god == "1" or $adm == "1")
      {
        echo "<tr bgcolor=\"#FF002A\" ><td>ИД организатора:</td><td><input type=\"text\"  name='org' size=\"86\" value= \"$id_org\"></td></tr>  ";
        echo "<tr bgcolor=\"#FF002A\" ><td>Относится к :</td><td><SELECT NAME=\"id_con\" SIZE=\"1\" id = \"reg\">";
		
        $ok_sib = mysql_query("select * from sibkon order by god desc");
        if (!mysql_num_rows($ok_sib))
          die("error(12).<p>");
        else
        {
          while ($t_sib = mysql_fetch_array($ok_sib))
          {
            $sib = $t_sib['id'];
            $god = $t_sib['god'];
            $tema = $t_sib['tema'];
            echo "
            <OPTION VALUE=\"$sib\"";
            if ($id_con == $sib)
              echo "SELECTED";
            echo ">$god: $tema</OPTION>";
          }
        }
        echo "</select></td></tr>";
      }
      else
      {
        echo "<input type=\"hidden\"  name='id_con' size=\"86\" value= \"$id_con\">";
      }
      if ($org_god == "1" or $adm == "1")
      {
        echo "<tr bgcolor=\"#FF002A\" >
<td>Одобрено:</td>
<td>
<select  name=\"yes\" size=\"1\">
<option value=\"0\"";
        if ($yes == "0")
        {
          echo " selected ";
        }
        echo ">Да</option>
<option value=\"1\"";
        if ($yes == "1")
        {
          echo " selected ";
        }
        echo ">Необходимо одобрение</option>
</select>
";
//показывать\не показывать в списке мероприятий

	echo "Видно в списке меню:<select  name=\"v_spiske\" size=\"1\">
			<option value=\"0\"";
			if ($v_spiske == "0")
			{
			  echo " selected ";
			}
			echo ">Виден</option>
			<option value=\"1\"";
			if ($v_spiske == "1")
			{
			  echo " selected ";
			}
			echo ">Не виден</option>
			</select>


</td>
</tr>
<tr><td bgcolor=\"#FF002A\" >
Ссылка на мероприятие:
</td>
<td  bgcolor=\"#FF002A\" >";
echo "$site/mer.php?id=$id";
echo "</td></tr>";
      }
      if ($org_god == "1" or $adm == "1")
      {
        echo "
            <tr bgcolor=\"#FF002A\" ><td>Тип:</td>";
        echo "
            <td><span class=\"formInfo\"><a href=\"$site/help.php?id=name_tip_mer&amp;width=375\" class=\"jTip\" id=\"n_tip\" name=\"Тип мероприятия\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span> <select id=\"first\" name=\"tip\" size=\"1\"><option value=\"\">--</option></select><a href = \"$site/tip/ad.php\">Добавить новый тип</a>  </td></tr>";
        echo "
            <tr bgcolor=\"#FF002A\" ><td>Подтип:</td>
            ";
        echo "<td><span class=\"formInfo\"><a href=\"$site/help.php?id=name_podtip_mer&amp;width=375\" class=\"jTip\" id=\"p_tip\" name=\"Подтип мероприятия\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span> <select id=\"second\" name=\"podtip\" size=\"1\"><option value=\"\">--</option></select><a href = \"$site/podtip/ad.php\">Добавить новый подтип</a> </td></tr>";
      }
      if ($adm == "1" or $org_mer == "1" or $org_god == "1")
      {
        echo "<tr>
<td>Свойство:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=svostvo&amp;width=375\" class=\"jTip\" id=\"cvo\" name=\"Свойство\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"zakrito\" size=\"1\">
<option value=\"0\"";
        if ($zakrito == "0")
        {
          echo " selected ";
        }
        echo ">Открыто</option>
<option value=\"1\"";
        if ($zakrito == "1")
        {
          echo " selected ";
        }
        echo ">Закрыто</option>
</select>
</td>";
        echo "<tr>
<td>Обсуждения:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=obs&amp;width=375\" class=\"jTip\" id=\"obsu\" name=\"Обсуждения\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"forum\" size=\"1\">
<option value=\"0\"";
        if ($forum == "0")
        {
          echo " selected ";
        }
        echo ">Не нужно</option>
<option value=\"1\"";
        if ($forum == "1")
        {
          echo " selected ";
        }
        echo ">Нужно</option>
</select>
</td>
</tr>
<tr>
<td>Обсуждения разрешены незарегистрированным:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=obs_all&amp;width=375\" class=\"jTip\" id=\"obsuф\" name=\"Разрешение\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"forum_all\" size=\"1\">
<option value=\"0\"";
        if ($forum_all == "0")
        {
          echo " selected ";
        }
        echo ">Нет</option>
<option value=\"1\"";
        if ($forum_all == "1")
        {
          echo " selected ";
        }
        echo ">Да</option>
</select>
</td>
</tr>
<tr>
<td>Файлы:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=files&amp;width=375\" class=\"jTip\" id=\"file\" name=\"Файлы\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"files\" size=\"1\">
<option value=\"0\"";
        if ($files == "0")
        {
          echo " selected ";
        }
        echo ">Нет</option>
<option value=\"1\"";
        if ($files == "1")
        {
          echo " selected ";
        }
        echo ">Да</option>
</select>
</td>
</tr>
<tr>
<td>Материалы:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=mat&amp;width=375\" class=\"jTip\" id=\"mate\" name=\"Материалы\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"mat\" size=\"1\">
<option value=\"0\"";
        if ($mat == "0")
        {
          echo " selected ";
        }
        echo ">Нет</option>
<option value=\"1\"";
        if ($mat == "1")
        {
          echo " selected ";
        }
        echo ">Да</option>
</select>
</td>
</tr>
<tr>
<td>Новостная лента:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=news_lent&amp;width=375\" class=\"jTip\" id=\"n_lent\" name=\"Новостная лента\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"news\" size=\"1\">
<option value=\"0\"";
        if ($news == "0")
        {
          echo " selected ";
        }
        echo ">Нет</option>
<option value=\"1\"";
        if ($news == "1")
        {
          echo " selected ";
        }
        echo ">Да</option>
</select>
</td>
</tr>
<tr>";
        echo "<td>Управление:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=upravl&amp;width=375\" class=\"jTip\" id=\"upra\" name=\"Управление\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"uprav\" size=\"1\">
<option value=\"0\"";
        if ($uprav == "0")
        {
          echo " selected ";
        }
        echo ">Только организатором</option>
<option value=\"1\"";
        if ($uprav == "1")
        {
          echo " selected ";
        }
        echo ">Командой организаторов</option>
</select>
</td>
</tr>";
        echo "
        <tr>
<td>Необходима регистрация:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=us&amp;width=375\" class=\"jTip\" id=\"us_u\" name=\"Регистрация\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"us\" size=\"1\">
<option value=\"0\"";
        if ($us == "0")
        {
          echo " selected ";
        }
        echo ">Необходима регистрация участников</option>
<option value=\"1\"";
        if ($us == "1")
        {
          echo " selected ";
        }
        echo ">Регистрация не нужна</option>
</select>
</td>
</tr>
<tr>
<td>Анкеты для участника:</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=anketa&amp;width=375\" class=\"jTip\" id=\"ank\" name=\"Анкета\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"anketa\" size=\"1\">
<option value=\"0\"";
        if ($anketa == "0")
        {
          echo " selected ";
        }
        echo ">Не нужна, просто заявка на участие</option>
<option value=\"1\"";
        if ($anketa == "1")
        {
          echo " selected ";
        }
        echo ">Необходимо заполнение анкеты</option>
</select>
</td>
</tr>
<tr>
<td>Нужны группы (команды):</td>
<td><span class=\"formInfo\"><a href=\"$site/help.php?id=kom&amp;width=375\" class=\"jTip\" id=\"kom\" name=\"Анкета\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a>
<select  name=\"komand\" size=\"1\">
<option value=\"0\"";
        if ($komand == "0")
        {
          echo " selected ";
        }
        echo ">Не нужно, участие индивидуальное</option>
<option value=\"1\"";
        if ($komand == "1")
        {
          echo " selected ";
        }
        echo ">Необходимо групповое участие</option>
<option value=\"2\"";
        if ($komand == "2")
        {
          echo " selected ";
        }
        echo ">Возможно как групповое , так и индивидуальное участие</option>
</select>
</td>
</tr>";
        $ok_page = mysql_query("select * from sibkon where god = $god_site");
        if (!mysql_num_rows($ok_page))
          die("error(12).<p>");
        else
          while ($t_page = mysql_fetch_array($ok_page))
          {
            $tender_v = $t_page['tender'];
          }
        if ($tender == "")
        {
          echo "<tr><td>Требования</td><td><textarea name='tender' rows=\"16\" cols='96' >$tender_v</textarea></td></tr>";
        }
        else
        {
          echo "<tr><td>Требования</td><td><textarea name='tender' rows=\"16\" cols='96' >$tender</textarea></td></tr>";
        }
      }
      echo "</table>";
      if ($yes == "0")
      {
        if ($org_mer == "1" or $adm == "1" or $org_god == "1")
        {
          $text_ok = "1";
        }
      }
      else
      {
        $text_ok = "1";
      }
      if ($text_ok == "1")
      {
        echo "
<p>Текст Материала<br><textarea name='text' rows=\"36\" cols='96' >$text</textarea></p>
";
      }
      echo "
   <div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Изменить данные</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\"/>                           
</form>
<p>";
?>
<script type="text/JavaScript">
 $(document).ready(function()
 {

var options = {
                    preselectFirst : <?
      echo "$tip";
?>, 
                    preselectSecond : <?
      echo "$podtip";
?>, 
                    emptyOption: true, 
                    emptyValue: '...', 
                    emptyKey: 'nothing'
                   };


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
                 "defaultvalue" : <?
        echo "$podtip";
?>,
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
?>
                     }
              },
<?
      }
?>
    };

                   
    $('#first').doubleSelect('second', selectoptions, options);  
	      
 });
</script>
	<?
    }
    else
    {
      error(7);
    }
}
function title()
{
  global $name_site;
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
  $ok_page = mysql_query("select * from meropriatia where id = $id");
  if (!mysql_num_rows($ok_page))
    die("error(12).<p>");
  else
  {
    while ($t_page = mysql_fetch_array($ok_page))
    {
      $name = $t_page['name'];
    }
  }
  echo "
<script type=\"text/javascript\" src=\"$site/js/jquery.doubleSelect.min.js\"></script>
<link type=\"text/css\" rel=\"stylesheet\" href=\"$site/js/jtip.css\" media=\"all\">
<script src=\"$site/js/jtip.js\" type=\"text/javascript\"></script>
";
  echo "
<title>Редактирование $name | $name_site</title>";
}
function right()
{
}
require ("../theme/$theme/$theme.htm");
?>