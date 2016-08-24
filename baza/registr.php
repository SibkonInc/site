<?php
require_once "functions.php";
    global $id_user, $site, $name_site, $god_site;
                 if (isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
        } else {
            $id = 0;
        }
        if (!is_numeric($id)) {
            die("Такой записи нет!!!");
        }
        $id = intval($id);
        if (isset($_GET['id_u'])) {
            $id_us = addslashes($_GET['id_u']);
        } else {
            $id_us = $id_user;
        }
        if (!is_numeric($id_us)) {
            die("Такой записи нет!");
        }
				
				if ($id == "1") {
                    mysql_query("insert into `registr`(god,id_us,reg) values('$god_site', '$id_us','1')");
                    } elseif ($id == "2") 
					{
                    mysql_query(" UPDATE registr SET reg=2 where god = '$god_site' and id_us = $id_us");
					} elseif ($id == "3") 
					{
                    mysql_query(" UPDATE registr SET reg=1 where god = '$god_site' and id_us = $id_us");
					}  elseif ($id == "4") {
                    mysql_query("delete from registr where god = '$god_site' and id_us = $id_us");
                    }
					
			header("Location: profile.php?id=$id_u"); 
?>