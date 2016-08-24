<?php
// Your code here to handle a successful verification
 /**
 * @author нукшсл
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
//если поле скрытое заполненно от роботов - то закрываем регистрацию
if (!($adress == ""))
{
 header("Location: $site/error.php?i=10");
}
else
{
 //проверяем пустоту полей
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
       //проверяем есть ли уже такой пользователь в базе данных

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
         mysql_query("insert into `log`(data,name,whot) values('$date_news', '$id_user', 'Добавил подопечного <a href = \"profile.php?id=$nit\">$nick_us - $name_us $fam_us</a> из $gorod_us')");
        }
        else
        {
         mysql_query(" INSERT INTO `us` ( `login_us` , `pass_us` , `nick_us`, `name_us`, `fam_us`, `gorod_us` , `otch_us` , `mail_us`, `act_us`, `god_us`, `passport_us`, `telefon_us`, `osebe`, `contact`, `interest`, `k`)
							VALUES ('$login_us', '$pass_us' , '$nick_us', '$name_us', '$fam_us', '$gorod_us', '$otch_us', '$mail_us', '$activate', '$god_us', '$passport_us', '$telefon_us', '$osebe', '$contact', '$interest', '$k')");
         $nit = mysql_insert_id();
         $mess_log = "Новая регистрация <a href = \"profile.php?id=$nit\">$nick_us - $name_us $fam_us</a> из $gorod_us";
         ad_log($mess_log);
        }
        $ok = mysql_query("select mail_adm from setting_site ");
        while ($st = mysql_fetch_array($ok))
        {
         $mail_adm = $st['mail_adm'];
        }
        $mess = " На сайте сибкона зарегился $name_us $fam_us из $gorod_us ником $nick_us с электронной почтой $mail_us и ждет подтверждения регистрации";
        // $to - кому отправляем
        // $from - от кого
        $tit = "Новая регистрация на сайте $name_site";
        // $from - от кого
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=windows-1251' . "\r\n";
        $headers .= "To: $nick_us <$mail_us>" . "\r\n";
        $headers .= "From: Автоинформатор $name_site <autobot@$sit>" . "\r\n";
        $mess = "
$mess
<p>
Это письмо созданно автоматически и не требует ответа.
";
        mail($mail_adm, $tit, $mess, $headers);
        //отправляем письмо юзеру
        $tit = "Ваша регистрация на сайте $name_site";
        $mess = "<p>Здравствуйте, $name_us $fam_us! Или просто, привет, $nick_us!!!
<br>Вы зарегистрировались на сайте $name_site
<br>Ваши данные:
<br>Логин: $login_us
<br>Пароль: $passw_us
<br>Имя: $name_us
<br>Фамилия: $fam_us
<br>Город: $gorod_us
<br>Ник: $nick_us
<br>Пожалуйста, сохраните ваши данные.
";
        // $from - от кого
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=windows-1251' . "\r\n";
        $headers .= "To: $nick_us <$mail_us>" . "\r\n";
        $headers .= "From: Автоинформатор $name_site <autobot@$sit>" . "\r\n";
        $mess = "
$mess
<p>
Это письмо созданно автоматически и не требует ответа.
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
<div align=\"center\"><h2>Ой,ошибочка вышла!</h2>
Причина ошибки:
<br><h2><font color = red>К сожалению $name_us $fam_us из города $gorod_us уже зарегистрирован на нашем сайте и активирован.</font></h2>
 Если вы уверены, что это просто ваш однофомилец, свяжитесь с администрацией сайта.
 <br>Если вы просто забыли пароль,то воспользуйтесь системой напоминания пароля.
</div>
";
         }
        }
       }
      }
}
?>