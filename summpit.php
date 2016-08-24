<? 
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
   global $id_user, $site, $name_site, $god_site;
$stmt = odbc_prepare($conn, "SELECT * FROM room_opros");
$sqldata = array($_SERVER['PHP_AUTH_USER']);
if (!odbc_execute($stmt) || !odbc_fetch_into($stmt, $tmp)) {
    // если процедура извлечения данных не удалась, то инициализируем пустой массив
    $session_data = array();
} else {
    // сейчас у нас должны быть сериализованные данные в $tmp[0].
    $session_data = unserialize($tmp[0]);
    if (!is_array($session_data)) {
        // что-то пошло не так, инициализируем пустой массив
        $session_data = array();
    }

}
	echo "$session_data";
?>