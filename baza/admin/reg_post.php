<?php
// Your code here to handle a successful verification
 /**
 * @author ������
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
$login_us = htmlspecialchars($_POST['login_us']);
$passw_us = htmlspecialchars($_POST['passw_us']);
$pass_us = htmlspecialchars($_POST['passw_us']);
$nick_us = htmlspecialchars($_POST['nick_us']);
$name_us = htmlspecialchars($_POST['name_us']);
$fam_us = htmlspecialchars($_POST['fam_us']);
$gorod_us = htmlspecialchars($_POST['gorod_us']);
$otch_us = htmlspecialchars($_POST['otch_us']);
$mail_us = htmlspecialchars($_POST['email']);
$god_us = htmlspecialchars($_POST['god_us']);
$passport_us = htmlspecialchars($_POST['passport_us']);
$telefon_us = htmlspecialchars($_POST['telefon_us']);
$osebe = htmlspecialchars($_POST['osebe']);
$contact = htmlspecialchars($_POST['contact']);
$interest = htmlspecialchars($_POST['interest']);
$adress = htmlspecialchars($_POST['adress']);
$activate = '1';
//���� ���� ������� ���������� �� ������� - �� ��������� �����������
if (!($adress == ""))
{
 header("Location: $site/error.php?i=10");
}
else
{
 //��������� ������� �����
 if ($login_us == "")
 {
  header("Location: $site/reg.php?error=1");
 }
 else
  if ($pass_us == "")
  {
   header("Location: $site/reg.php?error=1");
  }
  else
   if ($nick_us == "")
   {
    header("Location: $site/reg.php?error=1");
   }
   else
    if ($name_us == "")
    {
     header("Location: $site/reg.php?error=1");
    }
    else
     if ($fam_us == "")
     {
      header("Location: $site/reg.php?error=1");
     }
     else
      if ($gorod_us == "")
      {
       header("Location: $site/reg.php?error=1");
      }
      else
      {
       //��������� ���� �� ��� ����� ������������ � ���� ������

       $query = "select * From us where
fam_us = '" . $fam_us. "'and
name_us = '" . $name_us . "'
and
gorod_us = '" . $gorod_us. "'
 ";
       $result = mysql_query($query) or die("Query failed : " . mysql_error());
       while ($link = mysql_fetch_array($result, MYSQL_ASSOC))
       {
        $id_us_s = "$link[id_us]";
        $act_us_s = "$link[act_us]";
       }
       if ($id_us_s == "")
       {
        $pass_us = md5($pass_us);
        $k = crypt("pfljkfkb $login_us tpjgfcyjcnm $name_us cdjtq $pass_us");
        if (!($id_user == ""))
        {
         mysql_query(" INSERT INTO `us` ( `login_us` , `pass_us` , `nick_us`, `name_us`, `fam_us`, `gorod_us` , `otch_us` , `mail_us`, `act_us`, `god_us`, `passport_us`, `telefon_us`, `osebe`, `contact`, `interest`, `k`, `master`)
							VALUES ('$login_us', '$pass_us' , '$nick_us', '$name_us', '$fam_us', '$gorod_us', '$otch_us', '$mail_us', '$activate', '$god_us', '$passport_us', '$telefon_us', '$osebe', '$contact', '$interest', '$k', '$id_user')");
         $date_news = date("Y-m-d H:i");
         $nit = mysql_insert_id();
         mysql_query("insert into `log`(data,name,whot) values('$date_news', '$id_user', '������� ����������� <a href = \"profile.php?id=$nit\">$nick_us - $name_us $fam_us</a> �� $gorod_us')");
        }
        else
        {
         mysql_query(" INSERT INTO `us` ( `login_us` , `pass_us` , `nick_us`, `name_us`, `fam_us`, `gorod_us` , `otch_us` , `mail_us`, `act_us`, `god_us`, `passport_us`, `telefon_us`, `osebe`, `contact`, `interest`, `k`)
							VALUES ('$login_us', '$pass_us' , '$nick_us', '$name_us', '$fam_us', '$gorod_us', '$otch_us', '$mail_us', '$activate', '$god_us', '$passport_us', '$telefon_us', '$osebe', '$contact', '$interest', '$k')");
         $nit = mysql_insert_id();
         $mess_log = "����� ����������� <a href = \"profile.php?id=$nit\">$nick_us - $name_us $fam_us</a> �� $gorod_us";
         ad_log($mess_log);
        }
        $ok = mysql_query("select mail_adm from setting_site ");
        while ($st = mysql_fetch_array($ok))
        {
         $mail_adm = $st['mail_adm'];
        }
        $mess = " �� ����� ������� ��������� $name_us $fam_us �� $gorod_us ����� $nick_us � ����������� ������ $mail_us � ���� ������������� �����������";
        // $to - ���� ����������
        // $from - �� ����
        $tit = "����� ����������� �� ����� $name_site";
        // $from - �� ����
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=windows-1251' . "\r\n";
        $headers .= "To: $nick_us <$mail_us>" . "\r\n";
        $headers .= "From: �������������� $name_site <autobot@$sit>" . "\r\n";
        $mess = "
$mess
<p>
��� ������ �������� ������������� � �� ������� ������.
";
        mail($mail_adm, $tit, $mess, $headers);
        //���������� ������ �����
        $tit = "���� ����������� �� ����� $name_site";
        $mess = "<p>������������, $name_us $fam_us! ��� ������, ������, $nick_us!!!
<br>�� ������������������ �� ����� $name_site
<br>���� ������:
<br>�����: $login_us
<br>������: $passw_us
<br>���: $name_us
<br>�������: $fam_us
<br>�����: $gorod_us
<br>���: $nick_us
<br>����������, ��������� ���� ������.
";
        // $from - �� ����
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=windows-1251' . "\r\n";
        $headers .= "To: $nick_us <$mail_us>" . "\r\n";
        $headers .= "From: �������������� $name_site <autobot@$sit>" . "\r\n";
        $mess = "
$mess
<p>
��� ������ �������� ������������� � �� ������� ������.
";
        mail($mail_us, $tit, $mess, $headers);
		sleep(3);
        //////////////////////////////////////
        header("Location: $site/baza/profile.php?id=$nit");
       }
       else
       {
        if ($act_us_s == "1")
        {
         function action()
         {
          global $name_us, $fam_us, $gorod_us;
          echo "
<div align=\"center\"><h2>��,�������� �����!</h2>
������� ������:
<br><h2><font color = red>� ��������� $name_us $fam_us �� ������ $gorod_us ��� ��������������� �� ����� ����� � �����������.</font></h2>
 ���� �� �������, ��� ��� ������ ��� �����������, ��������� � �������������� �����.
 <br>���� �� ������ ������ ������,�� �������������� �������� ����������� ������.
</div>
";
         }
        }
       }
      }
}
?>