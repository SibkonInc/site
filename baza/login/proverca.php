<?php
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_ALL,'ru_RU.65001','rus_RUS.65001','Russian_Russia.65001','russian');
    session_start();//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("<body><div align='center'><br/><br/><br/><h3>Вы ввели не всю информацию, вернитесь назад и заполните все поля!" . "<a href='index.php'> <b>Назад</b> </a></h3></div></body>");
    }
    //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
	
//удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
	
     //Подключаемся к базе данных.
    $dbcon = mysql_connect("mysql-1", "us3513b", "ghtdtlrhfcfdxtu"); 
    mysql_select_db("db3513b", $dbcon);
	if (!$dbcon)
	{
    echo "<p>Произошла ошибка при подсоединении к MySQL!</p>".mysql_error(); exit();
    } else {
    if (!mysql_select_db("db3513b", $dbcon))
    {
    echo("<p>Выбранной базы данных не существует!</p>");
    }
	}
	mysql_query('SET NAMES utf8');
 //извлекаем из базы все данные о пользователе с введенным логином
$result = mysql_query("SELECT * FROM reg_users WHERE login='$login'", $dbcon);
    $myrow = mysql_fetch_array($result);
    if (empty($myrow["password"]))
    {
    //если пользователя с введенным логином не существует
    exit ("<body><div align='center'><br/><br/><br/>
	<h3>Извините, введённый вами login или пароль неверный." . "<a href='index.php'> <b>Назад</b> </a></h3></div></body>");
    }
    else {
    //если существует, то сверяем пароли
    if ($myrow["password"]==$password) {
    //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
    $_SESSION['login']=$myrow["login"]; 
	$name_us=$myrow["name_us"]; 
	$fam_us=$myrow["fam_us"]; 
	$id=$myrow["id"];
    $_SESSION['id']=$myrow["id"];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
	$mess_log = "$name_us $fam_us Вошел в систему";
	ad_log($mess_log);
	header ('Location: ../index.php');
    }
 else {
    //если пароли не сошлись

    exit ("<body><div align='center'><br/><br/><br/>
	<h3>Извините, введённый вами login или пароль неверный." . "<a href='index.php'> <b>Назад</b> </a></h3></div></body>");
    }
    }
function ad_log($mess_log) {
    global $id;
    $date_news = date("Y-m-d H:i");
    mysql_query("insert into `log_baza`(data,name,whot) values('$date_news', '$id', '$mess_log')");
}
    ?>