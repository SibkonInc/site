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
  global $site, $status_site, $name_group, $god_site, $id_user, $name_site;
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
  $adm = dostup_adm();
  $org_god = dostup_org_god($god_site);
  $upravlenie = dostup_mer_adm($id);
  if ($id_user == "")
  {
    error(7);
  }
  else
  {
    if ($upravlenie == "1")
    {
      $ok_page = mysql_query("select * from meropriatia where id = $id");
      {
        while ($t_page = mysql_fetch_array($ok_page))
        {
          $id = $t_page['id'];
          $name = $t_page['name'];
          $text = nl2br($t_page['text']);
          $id_con = $t_page['id_con'];
          $tip = $t_page['tip'];
          $tip = name_tip($tip);
          $podtip = $t_page['podtip'];
          $podtip = name_podtip($podtip);
          $name_mer = name_mer($id);
          $command = $t_page['komand'];
        }
      }
      $ok_sibkon = mysql_query("SELECT * FROM `sibkon` WHERE `id` = $id_con");
      while ($t_sibkon = mysql_fetch_array($ok_sibkon))
      {
        $id_sibkon = $t_sibkon['id_con'];
        $god = $t_sibkon['god'];
        $tema = $t_sibkon['tema'];
      }
      echo "
<p>
	<a href = \"$site/sibkon.php?id=$god\">$name_site $god: $tema</a> | $tip | $podtip | $name_mer
	";
      echo "<h3 align = \"center\">Управлениe анкетой участника $name</h3>";
      
      
      if ($command == "1")
      {
        echo "Выставлен режим требования команд. В вопросах анкеты не надо вводить вопрос о принадлежности к команде.";
      }
      
      
      
      
      
      
      
      
      
      echo "<table>";
      $ok_page_a = mysql_query("select * from anketa where tip = 2 and id_id = $id");
      while ($t_page_a = mysql_fetch_array($ok_page_a))
      {
        $id_v = $t_page_a['id'];
        $vopros = $t_page_a['vopros'];
        echo "<form name=\"form$id_v\" method=\"post\" action=\"ed_anketa_post.php?id=$id_v\">
                        <tr>
                            <td>
                                <input type=\"text\"  name='vopros' size=\"86\" value = \"$vopros\">
                                </td>
                            <td>
                        <div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form$id_v.submit()\">Изменить</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
                            </td>
                            <td>
                        <div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/mer/del_anketa.php?id=$id_v\">Удалить</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
                            </td>
                        </tr>
                        
                         </form>                      
                        ";
      }
      echo "</table>";
      echo "
            <p>Добавить новый вопрос к анкете</p>
            <form name=\"form\"  method=\"post\" action=\"$site/mer/ad_anketa.php?id=$id\">
            <input type=\"text\"  name='vopros' size=\"86\" >
            <p><input type=\"submit\" name=\"formbutton1\" value=\"Добавить\"></p>
            </form>
            ";
    }
    else
    {
      error(7);
    }
  }
}
function title()
{
  global $name_site, $name_group;
  echo "

";
  echo "
    <script src=\"$site/js/addElements.js\" type='text/javascript'></script>
<title>Управление анкетой $name_group | $name_site</title>";
}
function right()
{
  echo "
<h5 align = \"center\">Небольшая справка по управлению.</h5>
<ul>
<li>Приведен список вопросов для анкеты участника.</li> 
<li>Для добавления нового вопроса воспользуйтесь формой внизу.</li>
<li>Для изменние введите в поле новое название и нажмите кнопку \"Изменить\".</li>
<li>Для удаления нажмите кнопку \"Удалить\" напротив вопроса. Внимание, вопрос удаляется без предупреждения.</li>
</il>   
";
}
require ("../theme/$theme/$theme.htm");
?>