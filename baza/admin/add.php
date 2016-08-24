<?php 
	include_once ('header.php');
	
	?>
		<div id="center_wrap">
			<div id="one_column">
<?php
	if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} }
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
	if (empty($login) or empty($password) or empty($name_us) or empty($fam_us)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
	$password = stripslashes($password);
    $password = htmlspecialchars($password);
	$name_us = stripslashes($name_us);
    $name_us = htmlspecialchars($name_us);
	$fam_us = stripslashes($fam_us);
    $fam_us = htmlspecialchars($fam_us);
 //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
	$name_us = trim($name_us);
	$fam_us = trim($fam_us);
	$db = mysql_connect("mysql-1", "us3513b", "ghtdtlrhfcfdxtu"); 
    mysql_select_db("db3513b", $db);
	mysql_query('SET NAMES utf8');
    $result2 = mysql_query ("INSERT INTO reg_users (login,password,name_us,fam_us) VALUES('$login','$password','$name_us','$fam_us')");
    // Проверяем, есть ли ошибки
    if ($result2=='TRUE')
    {
		$mess_log = "Добавлен новый админ - $name_us $fam_us";
	ad_log($mess_log);
	
	
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='../index.php'>Главная страница</a>";
    }
 else {
    echo "Ошибка! Вы не зарегистрированы.";
    }
	function ad_log($mess_log) {
    global $id;
    $date_news = date("Y-m-d H:i");
    mysql_query("insert into `log_baza`(data,name,whot) values('$date_news', '$id', '$mess_log')");
}
    ?>
			</div>
			<div id="two_column">
				<?php
					include ('spisok.php');
				?></div>
		</div>
		<?php 
	include_once ('footer.php');
	?>