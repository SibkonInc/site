<? 
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
   global $id_user, $site, $name_site, $god_site;
$stmt = odbc_prepare($conn, "SELECT * FROM room_opros");
$sqldata = array($_SERVER['PHP_AUTH_USER']);
if (!odbc_execute($stmt) || !odbc_fetch_into($stmt, $tmp)) {
    // ���� ��������� ���������� ������ �� �������, �� �������������� ������ ������
    $session_data = array();
} else {
    // ������ � ��� ������ ���� ��������������� ������ � $tmp[0].
    $session_data = unserialize($tmp[0]);
    if (!is_array($session_data)) {
        // ���-�� ����� �� ���, �������������� ������ ������
        $session_data = array();
    }

}
	echo "$session_data";
?>