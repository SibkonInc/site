<title>Авторизация</title>

<?php
require_once "functions.php";
    //Стартуем сессии
 session_start();
 
?>

<?php
// Проверяем, пусты ли переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
    {
?>
 <!--Если пусты, то выводим форму входа.--> 
 <div style="border: 0px solid blue; 
 position:relative; top:100px; left:400px; height:200px; width:300px;">
		
<form action="proverca.php" method="post">
    <label>логин:</label><br/>
  <input name="login" type="text" size="15" maxlength="15"><br/>
    <label>пароль:</label><br/>
  <input name="password" type="password" size="15" maxlength="15"><br/><br/>
  <input type="submit" value="войти"><br/><br/>
</form>
Здравствуйте <font color="red">гость</font>! <br/>
Авторизуйтесь и пройдите по ссылке! 
</div>
<?php
    }
    else  //Иначе. 
    {
		 $login=$_SESSION['login'];
		 
     //Подключаемся к базе данных.
    $dbcon = mysql_connect("localhost", "имя администратора базы", "пароль администратора базы"); 
    mysql_select_db("имя базы данных", $dbcon);
	if (!$dbcon)
	{
    echo "<p>Произошла ошибка при подсоединении к MySQL!</p>".mysql_error(); exit();
    } else {
    if (!mysql_select_db("имя базы данных", $dbcon))
    {
    echo("<p>Выбранной базы данных не существует!</p>");
    }
	}
//Формирование оператора SQL SELECT 
$sqlCart = mysql_query("SELECT Поле с именами посетителей из таблицы FROM имя таблицы WHERE login = '$login'", $dbcon);
//Цикл по множеству записей и вывод необходимых записей 
 while($row = mysql_fetch_array($sqlCart)) 
 {
//Присваивание записей 
$name = $row["name"];
  }
  	mysql_close($dbcon);
    // Если не пусты, то мы выводим ссылку
    echo "
<div align='center'
style='border: 0px solid blue; position:relative; top:100px; left:350px; height:100px; width:300px;'>

	<font color='green'>Здравствуйте: "."<font color='red'>".$name."</font>!</font>
	<br/>
	Вы можете перейти по ссылке: <a href='http://www.xxx.ru'>http://www.xxx.ru</a>
	<br/>
      <a href='viiti.php'>выйти</a> 
   <br/>

</div>";
    }
    ?> 