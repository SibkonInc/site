<?php /**
 * @author нукшсл
 * @copyright 2009
 */
 
 require_once "../functions.php";
        if (isset($_GET['id'])) {
            $id_u = addslashes($_GET['id']);		
        } else {
            echo"123";
        }
	$id_room = $_POST['spisok'];
		$tip_id = 3;
    mysql_query("INSERT INTO room_us ( `id_command`, `id_us`, `tip`,`god`)VALUES ($id_room, '$id_u', '$tip_id', '$god_site')");
	$mess_log = "$name поселил $id_u в $id_room";
	ad_log($mess_log);
    header("Location: ../profile.php?id=$id");
?>