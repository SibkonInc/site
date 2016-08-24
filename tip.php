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
	global $name_site, $god_site;
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = "0";
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	$ok_page_s = mysql_query("select * from sibkon where god = $god_site");
	while ($t_page_s = mysql_fetch_array($ok_page_s))
	{
		$id_s = $t_page_s['id'];
	}
	if ($id == "0")
	{
		$ok_page_tm = mysql_query("select * from tip_mer");
	}
	else
	{
		$ok_page_tm = mysql_query("select * from tip_mer where id = $id");
	}
	while ($t_page_tm = mysql_fetch_array($ok_page_tm))
	{
		$id_tipm = $t_page_tm['id'];
		$name_tipm = $t_page_tm['name'];
		echo "<h3 align = \"center\">$name_tipm</h3>";
		echo "<table><thead><th>Название</th><th>Организатор</th><th>Участников</th></thead>";
		$ok_page_tmm = mysql_query("select * from meropriatia where tip = $id_tipm and id_con = $id_s and yes = 0 order by name");
		while ($t_page_tmm = mysql_fetch_array($ok_page_tmm))
		{
			$id_tipmm = $t_page_tmm['id'];
			$name_mer = name_mer($id_tipmm);
			echo "<tr><td>$name_mer</td><td>"; 
            
            $ok_page = mysql_query("select * from mer_us where id_command = $id_tipmm and tip = 1");
                  while ($t_page = mysql_fetch_array($ok_page))
                  {
                     $id_us_m = $t_page['id_us'];
             $name_org_mer = user_info($id_us_m);
            echo "$name_org_mer ";
            
            
            }
            
            echo"</td><td>"; 
            
            $ok_reg = mysql_query("select * from mer_us  WHERE id_command = $id_tipmm and tip = 3");
      $itog_reg1 = mysql_num_rows($ok_reg);
            
            echo"$itog_reg1";
            
            
            
            
            
            
            
            
            echo"</td></tr>";
		}
		echo "</table>";
	}
}
function title()
{
	global $name_site, $site;
	echo "
<title>Типы на сайте | $name_site</title>
";
}
function right()
{
	echo "<h4 align = \"center\">Типы</h4>
    ";
}
require ("theme/$theme/$theme 2.htm");
?>