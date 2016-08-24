<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
if (isset($_GET['id'])) {
    $id = addslashes($_GET['id']);
} else {
    $id = "00";
}
if (!is_numeric($id)) {
    die("Такой записи нет!");
}
$id = intval($id);
$adm = dostup_adm();
$org_god = dostup_org_god($god_site);
if ($adm == "1" or $org_god == "1") {
    $summa_opl = addslashes($_POST['new_summa_opl']);
    mysql_query(" UPDATE room_us SET new_summa_opl = '$new_summa_opl', custom_opl = '1' where id_us = '$id' and god=$god_site");

    $mess_log = "Изменил данные";
    ad_log($mess_log);
    header("Location: $site/profile.php?id=$id");
} else {
    header("Location: $site/error.php?i=7");
}
?>