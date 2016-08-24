<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
if ($id_user == "")
{
 echo "Не могу";
}
else
{
 if (isset($_GET['id']))
 {
  $id = addslashes($_GET['id']);
 }
 $id = intval($id);

 mysql_query("DELETE FROM podpiska WHERE   id_forum = '$id'");
 header("Location: $site/forum.php?f=2");
}
?>