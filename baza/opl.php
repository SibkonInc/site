<?php

require_once "functions.php";
 if (isset($_GET['id'])) {
    $id = addslashes($_GET['id']);
} else {
    $id = "00";
}
if (!is_numeric($id)) {
    die("Такой записи нет!");
}
$id = intval($id);
    $summa_opl = addslashes($_POST['summa_opl']);
    $tip_opl = addslashes($_POST['tip_opl']);
    mysql_query(" UPDATE room_us SET summa_opl = '$summa_opl', tip_opl = '$tip_opl' where id_us = '$id' and god=$god_site");
	$mess_log = "$name изменил сумму у $id на $summa_opl";
	ad_log($mess_log);
    header("Location: profile.php?id=$id");

?>