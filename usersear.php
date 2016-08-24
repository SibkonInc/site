<?php

ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";


if (isset($_GET['id'])) {
    $id = addslashes($_GET['id']);
} else {
    $id = 0;
}
if (!is_numeric($id)) {
    die("Такой записи нет!");
}
$id = intval($id);
if (isset($_GET['id_us'])) {
    $id_us = addslashes($_GET['id_us']);
} else {
    $id_us = $id_user;
}
if (!is_numeric($id_us)) {
    die("Такой записи нет!");
}
$id_us = intval($id_us);

$registr = mysql_query("select * from registr where id_us = $id_us");
    while ($registr_s = mysql_fetch_array($registr)) {
        $god = $registr_s['god'];
    echo "<li>регистрация $god</li> ";
    }




$mer_s = mysql_query("select * from meropriatia ");
while ($mer_s_m = mysql_fetch_array($mer_s)) {
    $id_mer = $mer_s_m['id'];
    $ok_page = mysql_query("select * from mer_us where id_command = $id_mer and id_us = $id_us");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id_us_m = $t_page['id_us'];
        if (!($id_us_m == "")) {
            $merop = name_mer($id_mer);
            echo "<li>$merop</li> ";
        }
    }
}
$registr = mysql_query("select * from room_us where id_us = $id_us");
    while ($registr_s = mysql_fetch_array($registr)) {
        $id = $registr_s['id_command'];
         $name_room = name_room( $id);
    echo "<li>поселение из $name_room</li> ";
    }
   

?>
