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
	if ($id == "0")
	{
		error(1);
		function title()
		{
			echo "<title>Ошибка!</title>";
		}
		function right()
		{
		}
	}
	else
	{
		$ok_page = mysql_query("select * from module where id = $id");
		if (!mysql_num_rows($ok_page)) die("error(12).<p>");
		else
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$file = $t_page['file'];
				ini_set("include_path", getenv("DOCUMENT_ROOT") . "/module");
				require_once "$file.php";
			}
		}
	}
}
function title()
		{
			
		}
		function right()
		{
		}
require ("theme/$theme/$theme.htm");
?>