<title>Авторизация</title>

<?php
//Стартуем сессии
 session_start();
// Проверяем, пусты ли переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
?>
 <!--Если пусты, то выводим форму входа.--> 
 <div id=login_form>		
<form action="login/proverca.php" method="post">
    <label>Логин:</label>
  <input name="login" type="text" class=login_form size="15" maxlength="15">
    <label>Пароль:</label>
  <input name="password" type="password" class=pass_form size="15" maxlength="15">
  <input type="submit" class=login_btn value="Войти">
</form>
</div>
<?php
    }
    else  //Иначе. 
    {
		 $login=$_SESSION['login'];
		 
     //Подключаемся к базе данных.
    $db = mysql_connect("mysql-1", "us3513b", "ghtdtlrhfcfdxtu"); 
    mysql_select_db("db3513b", $db);
	if (!$db)
	{
    echo "<p>Произошла ошибка при подсоединении к MySQL!</p>".mysql_error(); exit();
    } else {
    if (!mysql_select_db("db3513b", $dbcon))
    {
    echo("<p>Выбранной базы данных не существует!</p>");
    }
	}
//Формирование оператора SQL SELECT 
$sqlCart = mysql_query("SELECT login FROM reg_users WHERE login = '$login'", $db);
//Цикл по множеству записей и вывод необходимых записей 
 while($row = mysql_fetch_array($sqlCart)) 
 {
//Присваивание записей 
$name = $row["name_us"];
  }
  	mysql_close($db);
    // Если не пусты, то мы выводим ссылку
    echo "
<div align='center'
style='border: 0px solid blue; position:relative; top:100px; left:350px; height:100px; width:300px;'>

	<font color='green'>Здравствуйте: "."<font color='red'>".$name."</font>!</font>
	<br/>
	Вы можете перейти по ссылке: <a href='http://www.xxx.ru'>http://www.xxx.ru</a>
	<br/>
      <a href='login/exit.php'>выйти</a> 
   <br/>

</div>";
    }
    ?> 