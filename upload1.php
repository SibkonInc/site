<?php
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
if (isset($_GET['id']))
{
	$id = ($_GET['id']);
}
else
{
	$id = "0";
}
if (isset($_GET['tip']))
{
	$tip = ($_GET['tip']);
}
else
{
	$tip = "0";
}
if (isset($_POST['name']))
{
	$name = ($_POST['name']);
}
else
{
	$name = "new";
}
function file_ext($file_name) 
{
    $name_ar = explode(".", basename($file_name));
    $ext = "";
    if (count($name_ar) > 1) {
        $ext = strtolower($name_ar[count($name_ar) - 1]);
    }
    return ($ext);
}
if($tip == "2")
{
	$mat = "files/mat/$id/";
	if (!(file_exists($mat)))
	{
		mkdir("files/mat/$id/", 0770);
	}
	$uploaddir = "files/mat/$id/";
	$ext = file_ext($_FILES['matfile']['name']);
	$i = 0;
	while (file_exists($uploaddir . $i . "." . $ext))
	{
		$i++;
	}
	$fn = $i . "." . $ext;
	move_uploaded_file($_FILES['matfile']['tmp_name'], "files/mat/$id/" . $fn);
}
mysql_query("insert into files(tip,name,file,id_id,us) values(\"$tip\",\"$name\", \"$fn\", \"$id\", \"$id_user\")");
$otkuda = $_SERVER['HTTP_REFERER'];
header("Location: $otkuda");
?>