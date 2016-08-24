<?php
if (isset($_GET['tip']))
{
	$tip = addslashes($_GET['tip']);
}
else
{
	$tip = 0;
}
if (!is_numeric($tip))
{
	die("Такой записи нет!");
}
$tip = intval($tip);
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
	die("Такой записи нет!");
}
$id = intval($id);
$error = "";
$msg = "";
$fileElementName = 'fileToUpload';
$i = 0;
$files_count = sizeof($_FILES[$fileElementName]["name"]);
for ($i = 0; $i < $files_count - 1; $i++)
{
	if (!empty($_FILES[$fileElementName]['error'][$i]))
	{
		switch ($_FILES[$fileElementName]['error'][$i])
		{
			case '1':
				$error = 'размер загруженного файла превышает размер установленный параметром upload_max_filesize  в php.ini ';
				break;
			case '2':
				$error = 'размер загруженного файла превышает размер установленный параметром MAX_FILE_SIZE в HTML форме. ';
				break;
			case '3':
				$error = 'загружена только часть файла ';
				break;
			case '4':
				$error = 'файл не был загружен (Пользователь в форме указал неверный путь к файлу). ';
				break;
			case '6':
				$error = 'неверная временная дирректория';
				break;
			case '7':
				$error = 'ошибка записи файла на диск';
				break;
			case '8':
				$error = 'загрузка файла прервана';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	} elseif (empty($_FILES[$fileElementName]['tmp_name'][$i]) || $_FILES[$fileElementName]['tmp_name'][$i] ==
	'none')
	{
		$error = 'No file was uploaded..';
	}
	else
	{
		if ($tip == "2")
		{
			$mat = "upload/mat/$id/";
			if (!(file_exists($mat)))
			{
				mkdir("upload/mat/$id/", 0770);
			}
			$d = "mat/";
			$uploaddir = "mat/$id/";
			$ext = file_ext($_FILES[$fileElementName]['matfile']['name']);
			$i = 0;
			while (file_exists($uploaddir . $i . "." . $ext))
			{
				$i++;
			}
			$fn = $i . "." . $ext;
		}
		$msg .= " File Name: " . $_FILES[$fileElementName]['name'][$i] . "<br/>";
		//$msg .= " File Temp Name: " . $_FILES['fileToUpload']['tmp_name'] . "<br/>";
		$msg .= " File Type: " . $_FILES[$fileElementName]['type'][$i] . "<br/>";
		$msg .= " File Size: " . (@filesize($_FILES[$fileElementName]['tmp_name'][$i]) /
			1024) . "Kb";
		move_uploaded_file($_FILES[$fileElementName]['matfile']['tmp_name'], "mat/$id/" .
			$fn);
		//for security reason, we force to remove all uploaded file
		@unlink($_FILES[$fileElementName][$i]);
	}
	echo iconv("CP1251", "utf-8", "error: '" . $error . "',\n");
	echo iconv("CP1251", "utf-8", "msg: '" . $msg . "'\n");
}
?>