<?php
// ���� ���� ���� ����� ��� ���������� ������ Ajax �������
sleep(1); 
header("Content-type: text/plain; charset=windows-1251");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
// ����������� ��������� ������ � ������ ���������
while(list ($key, $val) = each ($_POST)){$_POST[$key] = iconv("UTF-8","CP1251", $_POST[$key]);}
// ������������� �������� ����
$date_add = date('d.m.Y � H:i');
// ������������� ��������� ���������
mysql_query("select id from meropriatia")
$nl = strlen($_POST['name']);
$ml = strlen($_POST['mail']);
$tl = strlen($_POST['text']);
$id = $_GET['id'];
$name = $_POST['name'];
$mail = $_POST['mail'];
$text = $_POST['text'];
if($nl<0 or $nl>60 or $ml<0 or $ml>60 or $tl<0 or $tl>500 or $_POST['nr']!='nerobot')
{$validate = false;}
elseif(!eregi('^[a-z0-9]+(([a-z0-9_.-]+)?)@[a-z0-9+](([a-z0-9_.-]+)?)+\.+[a-z]{2,4}$',$_POST['mail']))
{$validate = false;}
else{$validate = true;}
// ���� ������ ���������
if($validate)
{
// ��������� �����������
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
mysql_query("insert into mer_comments (id, name, mail, text, date_add, public) values ('{$id}', '{$name}', '{$mail}', '{$text}', '{$date_add}', '0')") or die ("Error! query - add_comment");
echo '<font color="green">����������� �������� � ������� ��������!</font>';
}
else
{
echo '<font color="red">��������� ��������� ���� �����!</font>';
}
?>