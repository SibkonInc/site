<?php
/**
 * @author ������
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
if ($id_user == "")
{
	header("Location: $site/error.php?i=7");
}
else
{
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = 0;
	}
	if (!is_numeric($id))
	{
		die("����� ������ ���!");
	}
	$id = intval($id);

 $name_komand = addslashes($_POST['name_komand']);
$mass = ($_POST);
          
          
            
    
            //����� �������� ����������
            //�������
      

echo "$name_komand";

	//header("Location: $site/news.php?id=$nit");
}
?>