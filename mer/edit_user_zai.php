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
    error(7);
  }
  else
  {
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
    $id = intval($id);
    if (isset($_GET['t']))
    {
      $t = addslashes($_GET['t']);
    }
    else
    {
      $t = 0;
    }
    if (!is_numeric($t))
    {
      die("Такой записи нет!");
    }
    $t = intval($t);
    if ($t == "2")
    {
      $zap1 = mysql_query("select * from query where id = $id");
      {
        while ($zp1 = mysql_fetch_array($zap1))
        {
          $ok = $zp1['ok'];
          if ($ok == "5")
            $id_us = $zp1['id_master'];
          else
          {
            $id_us = $zp1['id_us'];
          }
          $id_mer = $zp1['id_mer'];
          $tip_us = "0";
        }
      }
    }
    else
    {
      $zap = mysql_query("select * from mer_us where id = $id");
      {
        while ($zp = mysql_fetch_array($zap))
        {
          $id_zap = $zp['id'];
          $id_us = $zp['id_us'];
          $id_mer = $zp['id_command'];
          $tip_us = $zp['tip'];
        }
      }
    }
    $zap = mysql_query("select * from meropriatia where id = $id_mer");
    {
      while ($zp = mysql_fetch_array($zap))
      {
        $anketa = $zp['anketa'];
        $komand = $zp['komand'];
      }
    }
    $adm = dostup_adm();
    $org = dostup_org();
    $master = dostup_mer_adm($id_mer);
    if ($adm == "1" or $org == "1" or $master == "1" or $id_us == $id_user)
    {
      $user = user_info($id_us);
      $name_mer = name_mer($id_mer);
      echo "<h3 align = \"center\">Редактирование заявки</h3>";
      echo "<p align = \"center\">$user к $name_mer</p>";
      if ($ok == "5")
      {
        echo "Пользователь приглашен на мероприятие. Данных на данный момент нет.";
      }
      else
      {
        echo "<form method=\"post\" action=\"$site/mer/edit_user_zai_post.php?id=$id&t=$t\">";
        echo "<table>";
        if (!($tip_us == "0"))
        {
          echo "<tr><td>Тип участника</td><td>";
          echo "
  <SELECT NAME=\"tip\" SIZE=\"1\">
  <OPTION VALUE=\"1\"";
          if ($tip_us == "1")
            echo "SELECTED";
          echo ">Главный организатор</OPTION>";
          echo "<OPTION VALUE=\"2\"";
          if ($tip_us == "2")
            echo "SELECTED";
          echo ">Организатор</OPTION>";
          echo "<OPTION VALUE=\"3\"";
          if ($tip_us == "3")
            echo "SELECTED";
          echo ">Участник</OPTION>
            </select>
            ";
        }
        if ($komand == "1" or $komand == "2")
        {
          $ok_prig = mysql_query("select * from mer_command where id_mer = $id_mer and id_us = $id_us");
          while ($t_prig = mysql_fetch_array($ok_prig))
          {
            $name_komand = $t_prig['name'];
            $us_komand = $t_prig['id_us'];
          }
          echo "<tr><td>Команда</td><td><input type=\"text\" name=\"komand\" value = \"$name_komand\">";
        }
        if ($anketa == "1")
        {
          $ok_prig = mysql_query("select * from mer_anketa where id_mer = $id_mer and id_us = $id_us");
          while ($t_prig = mysql_fetch_array($ok_prig))
          {
            $vopros = $t_prig['vopros'];
            $us_komand = $t_prig['id_us'];
          }
          if ($vopros == "")
          {
            echo "<tr><td>Анкета</td><td>";
             echo "	<textarea name= \"vopros\" rows=\"15\" cols=\"49\">";
                      $orgkom5 = mysql_query("	SELECT * FROM `anketa` WHERE `id_id` =$id_mer");
                      while ($orgkom15 = mysql_fetch_array($orgkom5))
                      {
                        $vopros = $orgkom15['vopros'];
                        echo "$vopros
";
                      }
                      echo "</textarea>";
            echo"</td>";
          }
          else
          {
            echo "<tr><td>Анкета</td><td><textarea name= \"vopros\" rows=\"15\" cols=\"49\">$vopros</textarea></td>";
          }
        }
        echo "</table><p align=\"right\">
<input type=\"submit\" value=\"Изменить данные\" ></p>
</form>";
      }
    }
    else
    {
      error(7);
    }
  }
  //выясняем тип участника
  //выясняем название команды
  //выясняем анкету
  //выясняем общий статус - одобрено отклонено
}
function title()
{
  global $name_site, $name_group;
  echo "

";
  echo "
    <script src=\"$site/js/addElements.js\" type='text/javascript'></script>
<title>Редактирование анкеты участника $name_group | $name_site</title>";
}
function right()
{
}
require ("../theme/$theme/$theme.htm");
?>