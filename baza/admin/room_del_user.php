<?php /**
 * @author нукшсл
 * @copyright 2009
 */
 require_once "../functions.php";
 
        if (isset($_GET['id'])) {
            $id_u = addslashes($_GET['id']);
        } else {
            echo"none";
        }
  $site = mysql_query("select * from setting_site");
{
    while ($site_i = mysql_fetch_array($site)) {
	        $god_site = $site_i['god'];
  
      mysql_query("DELETE FROM room_us WHERE id_us = $id_u and god = $god_site");
      header("Location: ../profile.php?id=$id");
	   }
}
?>