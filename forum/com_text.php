<?
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
if (isset($_GET['id'])) {
        $id = addslashes($_GET['id']);
    } else {
        $id = 0;
    }
$ok_com = mysql_query("select * from `comment` where `id_com` = $id");
     
        while ($row = mysql_fetch_array($ok_com)) {
            $id_com = $row['id_com'];
			$id_us_com = $row['id_us'];
			$text_com = nl2br($row['text']);
			$avtor_com = user_info($id_us_com);
			$com_otv = $row['com_otv'];
			$date_com = $row['date'];
			$time_com = date("H:i", strtotime($date_com));
			$date_com = date("Y-m-d", strtotime($date_com));
			$date_com = format_date_html($date_com);
			$pic_com = "user/photo/$id_us_com.jpg";
			if (file_exists($pic_com))
			{
				list($width, $height, $type, $attr) = getimagesize($pict);
				if ($height > $width)
				{
					$vis1 = height;
				}
				else
				{
					$vis1 = width;
				}
			}
			else
			{
				$pic_com = "img/no.jpg";
			}
            }
echo iconv("CP1251", "utf-8", "<blockquote>$avtor_com $date_com $time_com");
echo iconv("CP1251", "utf-8", "<hr  style=border-width:1; border-style:dotted; color=#CCCCCC>");
echo iconv("CP1251", "utf-8", "$text_com</blockquote>");
            

?>