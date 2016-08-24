<?php
 require_once "../functions.php";
        if (isset($_GET['id'])) {
            $id_u = addslashes($_GET['id']);		
        } else {
            echo"Нечего";
        }
		$proverka = $_POST['proverka'];
		$pitanie = $_POST['pitanie'];		
		$sanvznos = $_POST['sanvznos'];
		$summa_sanvznos = $_POST['summa_sanvznos'];
		$comment = $_POST['comment'];
		$room = $_POST['room'];
		
		   
        $query = mysql_query("SELECT * FROM `stat_baza` WHERE id_us = $id_u");
        if (!$result = mysql_fetch_array($query))
		{
        mysql_query("INSERT INTO stat_baza (`id_us`, `proverka`, `pitanie`, `god`, `sanvznos`, `summa_sanvznos`, `comment`, `room`) VALUES ('$id_u', '$proverka', '$pitanie', '$god_site', '$sanvznos', '$summa_sanvznos', '$comment', '$room')");   
                $mess_log = "$name подтвердил приезд на базу - $id_u";
	ad_log($mess_log);
		}
        else
        {
//        mysql_query("UPDATE stat_baza set (`id_us`, `proverka`, `pitanie`, `god`, `sanvznos`, `summa_sanvznos`, `comment`, `room`) VALUES ('$id_u', '$proverka', '$pitanie', '$god_site', '$sanvznos', '$summa_sanvznos', '$comment', '$room') where id_us = $id_u");
		mysql_query("UPDATE stat_baza set `proverka` = '$proverka', `pitanie` = '$pitanie', `god` = '$god_site', `sanvznos` = '$sanvznos', `summa_sanvznos` = '$summa_sanvznos', `comment` = '$comment', `room` = '$room' where id_us = '$id_u'");   		
        $mess_log = "$name еще раз подтвердил приезд на базу - $id_u";
	ad_log($mess_log);
		}
    
    
    header("Location: ../profile.php?id=$id");
?>