<?php
/**
 * @author Yerick
 * @copyright 2009
 * @name YCMS 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function glav()
{
    global $id_user;
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == "1" or $org == "1") {
        echo "Вы находитесь в административной зоне сайта. В данную зону имеют доступ администраторы сайта, организаторы любого из прошедших проектов, организаторы текущего проекта. 
        <p><i>Примечание. О движке, его задачах и общих способах работы читайте <a href = \"about.php\">здесь</a>.</i></p>
       	<ul>
		<li>Управление Проектами. Проект - основное событие (игра, конвент, конференция, и т.п, далее - просто Проект), объединяющее в себе все остальное. Текущий проект – проект, подготовка которого идет, или, наоборот, закончившийся  - до момента заявления даты нового проекта. Доступ  - только администраторам сайта, а также оргам проводимых проектов. Редактирование разрешено только у проекта, на котором человек выступал (выступает) в качестве орга.</li>
<li> Управление Материалами. Материалы к проектам - основные страницы, имеющие отношение к конкретному проекту. Это могут быть правила проведения, схемы проезда, общая информация, любая  другая информация. Доступ  - только администраторам и оргам конкретного проекта.</li>
<li>Группы - составляющие проекта. Это либо проходящие в рамках проекта мероприятия, либо разные стороны, группы игры или другого проекта. Подразумевается отдельная работа над каждым мероприятием, не затрагивающая другие мероприятия. К группам возможно прикрепление дополнительных материалов, ведение форумов. Разрешена\запрещена\ только по приглашениям регистрация пользователей, открытый\закрытый доступ к материалам и обсуждениям. У группы назначается куратор, отвечающий за работу данного мероприятия, либо группы. Доступ  - только у администраторов и оргов конкретного проекта.</li>
<li>Управление типами. Типы групп и их подтипы.  Группы разбиваются на типы, названия типов показывается в меню во время работы проекта. Группы могут иметь подтипы, объединяющие их уже более конкретно. Подтипы - необязательное условие и не указывается нигде позже, служит только для аналитики. Доступ  - только у администраторов и оргов вне зависимости от проекта. </li>
<li>Управление локациями. Локации - место размещение участников. Подразумевается, что у каждой локации назначается куратор, отвечающий за свою локацию и ведущий учет участников при поселении.  Доступ  - только у администраторов и оргов конкретного проекта.</li>
<li>Орги проектов - список оргов проектов. Доступ – только администраторам и оргам текущего проекта. </li>
<li>Управление сайтом - выставление основных параметров (название, статус, год нынешнего проекта, тема оформления, состояние регистрации на событие и т.д). Доступ - только администраторам сайта</li>
<li>Управление страницами – редактирование содержания страниц, не имеющих отношения к конкретным проектам, автоматически не отображаемых в меню. Содержат временную информацию, либо информацию, не относящуюся к текущему проекту. Доступ  - только администраторам сайта и оргам текущего проекта.</li>
<li>Управление новостями. Доступ  - только администраторам и организаторам текущего проекта.</li>
<li>Управление Модулями. Могут подключаться различные модули, не входящие в общее ядро, но связанные с ним.</li>
<li>Требования к текущему проекту. Подразумевается, что каждая группа, или мероприятия прежде чем быть внесенными в реестр к исполнению, если они предлагаются самими участниками, пишут определенный список требований, необходимых для данной группы. Список может быть как предоставлен заранее, заполняется на странице управления определенным проектом, либо заполняется самим организатором или куратором группы.</li>
<li>Управление Поселением. Подразумевается, что каждый участник будет находиться в определенной локации, буть то лагерь или комната. Таким образом можно будет знать месторасположение того или иного участника.</li>
<li>Логи - Просмотр действий пользователя на сайте, связанные с изменением любого содержимого сайта. Не отслеживает форумы и комментарии. Доступ  - только у администраторов и оргов текущего события</li>
</ul>
";
    }
}
//управление сайтом
function site()
{
    global $id_user;
    $adm = dostup_adm();
    if ($adm == 1) {
        if (isset($_GET['ok'])) {
            $ok = addslashes($_GET['ok']);
        }
        $ok = intval($ok);
        echo "<div align=\"center\"><h3>Управление Сайтом</h3></div>";
        if ($ok == "1") {
            echo "<div align=\"center\"><font color = red><h4>Данные были изменены</h4></div>";
        }
        $site_info = mysql_query("select * from setting_site");
        if (!mysql_num_rows($site_info))
            die("Данные о сайте не получены.");
        else {
            while ($site_i = mysql_fetch_array($site_info)) {
                $id_site = $site_i['id'];
                $name_site = $site_i['name_site'];
                $status_site = $site_i['status_site'];
                $god = $site_i['god'];
                $status_text = $site_i['status_text'];
                $theme = $site_i['theme'];
                $reg = $site_i['reg'];
                $reg_text = $site_i['reg_text'];
                $st_glav = $site_i['st_glav'];
                $menu = $site_i['menu'];
                $arhiv = $site_i['arhiv'];
                $forum = $site_i['forum'];
                $module = $site_i['module'];
                $name_group = $site_i['name_group'];
                $pp = $site_i['pp'];
                $mail_adm = $site_i['mail_adm'];
                $oth_on = $site_i['oth_on'];
                $oth_ob = $site_i['oth_ob'];
                $god_on = $site_i['god_on'];
                $god_ob = $site_i['god_ob'];
                $pass_on = $site_i['pass_on'];
                $pass_ob = $site_i['pass_ob'];
                $telefon_on = $site_i['telefon_on'];
                $telefon_ob = $site_i['telefon_ob'];
                $osebe_on = $site_i['osebe_on'];
                $osebe_ob = $site_i['osebe_ob'];
                $contact_on = $site_i['contact_on'];
                $contact_ob = $site_i['contact_ob'];
                $interest_on = $site_i['interest_on'];
                $interest_ob = $site_i['interest_ob'];
                $otv_pos = $site_i['otv_pos'];
                $shema = $site_i['shema'];
            }
        }
        echo "
<form name=\"form\" method=\"post\" action=\"/admin/edit_site.php?id=$id_site\">
<table>
<tr><td><LABEL for=\"name\">Название сайта:</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=name_site&amp;width=375\" class=\"jTip\" id=\"one\" name=\"Название сайта\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td><input type=\"text\"  name='name_site' id = \"name\" size=\"60\" value= \"$name_site\" ></td></tr>
<tr><td><LABEL for=\"name\">Название групп:</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=name_group&amp;width=375\" class=\"jTip\" id=\"onegr\" name=\"Название групп\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td><input type=\"text\"  name='name_group' id = \"name_group\" size=\"60\" value= \"$name_group\" ></td></tr>
<tr><td><LABEL for=\"status_site\">Статус сайта:</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=status&amp;width=375\" class=\"jTip\" id=\"two\" name=\"Статус сайта\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td>
	<SELECT NAME=\"status_site\" SIZE=\"1\" id = \"status_site\">
	<OPTION VALUE=\"0\"";
        if ($status_site == "0")
            echo "SELECTED";
        echo ">Сайт Закрыт</OPTION>
	<OPTION VALUE=\"1\"";
        if ($status_site == "1")
            echo "SELECTED";
        echo ">Между проектами</OPTION>
        	<OPTION VALUE=\"2\"";
        if ($status_site == "2")
            echo "SELECTED";
        echo ">Работа проекта</OPTION>
	</select></td></tr>
<tr><td><LABEL for=\"reg\">Главная Страница</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=st&amp;width=375\" class=\"jTip\" id=\"s\" name=\"Главная страница\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td>
	<SELECT NAME=\"st_glav\" SIZE=\"1\" id = \"menu\">";
        $ok_page = mysql_query("select * from page ");        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $page = $t_page['id_page'];
                $text = $t_page['text'];
                $nazvanie = $t_page['nazvanie'];
                echo "
	<OPTION VALUE=\"$page\"";
                if ($st_glav == "$page")
                    echo "SELECTED";
                echo ">$nazvanie</OPTION>";
            }
            echo "
	<OPTION VALUE=\"news\"";
            if ($st_glav == "news")
                echo "SELECTED";
            echo ">Новостная лента</OPTION>";
            echo "
	<OPTION VALUE=\"anons\"";
            if ($st_glav == "anons")
                echo "SELECTED";
            echo ">Анонс Проекта</OPTION>";
        }
        echo "
	</select></td></tr>
<tr><td><LABEL for=\"god\">Год проведения</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=god&amp;width=375\" class=\"jTip\" id=\"tri\" name=\"Год проведения\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td>

<SELECT NAME=\"god\" SIZE=\"1\" id = \"menu\">";
        $ok_page = mysql_query("select * from sibkon order by god desc");        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $god_p = $t_page['god'];
                $name_p = $t_page['tema'];
                echo "
	<OPTION VALUE=\"$god_p\"";
                if ($god == "$god_p")
                    echo "SELECTED";
                echo ">$god_p: $name_p</OPTION>";
            }
        }
        echo "
	</select></td></tr>
<tr><td><LABEL for=\"status_text\">Сообщение</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=status_text&amp;width=375\" class=\"jTip\" id=\"ch\" name=\"Сообщение при закрытии сайта.\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td><input type=\"text\"  name='status_text' id = \"status_text\"  size=\"60\" value= \"$status_text\"></td></tr>
<tr><td><LABEL for=\"theme\">Графическая тема</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=theme&amp;width=375\" class=\"jTip\" id=\"p\" name=\"Графическая тема сайта\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td><input type=\"text\"  name='theme' id = \"theme\"  size=\"86\" value= \"$theme\"></td></tr>
<tr><td><LABEL for=\"reg\">Регистрация</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=reg&amp;width=375\" class=\"jTip\" id=\"q\" name=\"Регистрация пользователей на сайте\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td>
	<SELECT NAME=\"reg\" SIZE=\"1\" id = \"reg\">
	<OPTION VALUE=\"1\"";
        if ($reg == "1")
            echo "SELECTED";
        echo ">Да</OPTION>
	<OPTION VALUE=\"0\"";
        if ($reg == "0")
            echo "SELECTED";
        echo ">Нет</OPTION>
	</select></td></tr>
	
<tr><td><LABEL for=\"reg\">Правила пользователей на сайте</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=pp&amp;width=375\" class=\"jTip\" id=\"pr\" name=\"Правила пользователей\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td>
	<SELECT NAME=\"pp\" SIZE=\"1\" id = \"menu\">";
        $ok_page = mysql_query("select * from page ");        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $page = $t_page['id_page'];
                $text = $t_page['text'];
                $nazvanie = $t_page['nazvanie'];
                echo "
	<OPTION VALUE=\"$page\"";
                if ($pp == "$page")
                    echo "SELECTED";
                echo ">$nazvanie</OPTION>";
            }
        }
        echo "
	</select></td></tr>	
	
<tr><td><LABEL for=\"reg_text\">Текст</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=reg_text&amp;width=375\" class=\"jTip\" id=\"w\" name=\"Текст регистрации\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td><input type=\"text\"  name='reg_text' id = \"reg_text\"  size=\"86\" value= \"$reg_text\"></td></tr>
<tr><td><LABEL for=\"reg\">Меню на сайте</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=menu&amp;width=375\" class=\"jTip\" id=\"me\" name=\"Меню\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td>
	<SELECT NAME=\"menu\" SIZE=\"1\" id = \"men\">
	<OPTION VALUE=\"0\"";
        if ($menu == "0")
            echo "SELECTED";
        echo ">Классическое</OPTION>
	<OPTION VALUE=\"1\"";
        if ($menu == "1")
            echo "SELECTED";
        echo ">Выпадающее</OPTION>
	</select></td></tr>
	<tr><td><LABEL for=\"reg\">Архив</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=arh&amp;width=375\" class=\"jTip\" id=\"ar\" name=\"Включение архива\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td>
	<SELECT NAME=\"arhiv\" SIZE=\"1\" id = \"arhi\">
	<OPTION VALUE=\"1\"";
        if ($arhiv == "1")
            echo "SELECTED";
        echo ">Да</OPTION>
	<OPTION VALUE=\"0\"";
        if ($arhiv == "0")
            echo "SELECTED";
        echo ">Нет</OPTION>
	</select></td></tr>
	<tr><td><LABEL for=\"reg\">Форум</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=forum&amp;width=375\" class=\"jTip\" id=\"fo\" name=\"Включение форума\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td>
	<SELECT NAME=\"forum\" SIZE=\"1\" id = \"foru\">
	<OPTION VALUE=\"1\"";
        if ($forum == "1")
            echo "SELECTED";
        echo ">Да</OPTION>
	<OPTION VALUE=\"0\"";
        if ($forum == "0")
            echo "SELECTED";
        echo ">Нет</OPTION>
	</select></td></tr>
    <tr><td><LABEL for=\"reg\">Модули</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=module&amp;width=375\" class=\"jTip\" id=\"fo\" name=\"Включение модулей\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td>
	<SELECT NAME=\"module\" SIZE=\"1\" id = \"modu\">
	<OPTION VALUE=\"1\"";
        if ($module == "1")
            echo "SELECTED";
        echo ">Да</OPTION>
	<OPTION VALUE=\"0\"";
        if ($module == "0")
            echo "SELECTED";
        echo ">Нет</OPTION>
	</select></td></tr>
<tr><td><LABEL for=\"reg_text\">E mail администратора</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=mailadm&amp;width=375\" class=\"jTip\" id=\"ea\" name=\"E mail администратора\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td><input type=\"text\"  name='mail_adm' id = \"mail_adm\"  size=\"86\" value= \"$mail_adm\"></td></tr>
<tr><td><LABEL for=\"reg_text\">Ответственный по локациям</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=otv_pos&amp;width=375\" class=\"jTip\" id=\"op\" name=\"Ответвенный по локациям\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td><input type=\"text\"  name='otv_pos' id = \"ot_po\"  size=\"86\" value= \"$otv_pos\"></td></tr>
<tr><td><LABEL for=\"reg\">Схемы расположения</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=sh&amp;width=375\" class=\"jTip\" id=\"pr\" name=\"Схемы раположения\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"Информация\"></a></span></td><td>
	<SELECT NAME=\"shema\" SIZE=\"1\" id = \"shem\">";
        
		
	 $ok_page_s = mysql_query("select * from sibkon where god = $god");
          while ($t_page_s = mysql_fetch_array($ok_page_s))
          {
            $id_s = $t_page_s['id'];
          }	
		
		$ok_page_s = mysql_query("select * from page_sibkon where id_con = $id_s and id_id = 0 order by name");
            {
              while ($t_page_s = mysql_fetch_array($ok_page_s))
              {
                $pages = $t_page_s['id'];
                $nazvanies = $t_page_s['name'];
                echo "
	<OPTION VALUE=\"$pages\"";
                if ($shema == "$pages")
                    echo "SELECTED";
                echo ">$nazvanies</OPTION>";
            }
        }
        echo "
	</select></td></tr>	
</table>
<h4>Поля для регистрации пользователей. Если поле не указано, то в профайле оно отображаться тоже не будет.</h4>
Обязательные поля - Ник, Логин, Пароль, Имя, Фамилия, Город заложенны автоматически и нужны для работы движка.
<table>
<thead>
<tr><th><b>Поле</b></th><th><b>Показывать</b></th><th><b>Обязательное</b></th><th></th></tr>
</thead>
<tbody>
<tr><td>Отчество</td><td><input type=\"checkbox\" name = \"oth_on\"";
        if ($oth_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"oth_ob\" ";
        if ($oth_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo " ></td></tr>
<tr><td>Год Рождения</td><td><input type=\"checkbox\" name = \"god_on\" ";
        if ($god_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"god_ob\" ";
        if ($god_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td></tr>
<tr><td>Данные паспорта</td><td><input type=\"checkbox\" name = \"pass_on\" ";
        if ($pass_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"pass_ob\" ";
        if ($pass_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td></tr>
<tr><td>Телефон</td><td><input type=\"checkbox\" name = \"telefon_on\" ";
        if ($telefon_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"telefon_ob\" ";
        if ($telefon_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td></tr>
<tr><td>О себе</td><td><input type=\"checkbox\" name = \"osebe_on\" ";
        if ($osebe_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"osebe_ob\" ";
        if ($osebe_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td></tr>
<tr><td>Контакная информация</td><td><input type=\"checkbox\" name = \"contact_on\" ";
        if ($contact_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"contact_ob\" ";
        if ($contact_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td></tr>
<tr><td>Интересы</td><td><input type=\"checkbox\" name = \"interest_on\" ";
        if ($interest_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"interest_ob\" ";
        if ($interest_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td></tr>
</tbody>        
</table>
	<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form.submit()\">Изменить Данные</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\">                           
</form>

";
    } else {
        error(7);
    }
}
//управление страницами
function pages()
{
    global $id_user, $god_site;
    $adm = dostup_adm();
    $god_org = dostup_org_god($god_site);
    if ($adm == 1 or $god_org == 1) {
        echo "<div align=\"center\"><h3>Управление Страницами</h3></div>
		<a href = \"$site/page/ad.php\">Добавить страницу</a>
		<table>";
        $ok_page = mysql_query("select * from page ");        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $page = $t_page['id_page'];
                $text = $t_page['text'];
                $nazvanie = $t_page['nazvanie'];
                echo "<tr><td><a href = \"$site/?id=$page\">$nazvanie</a></td><td><a href = \"$site/page/edit.php?id=$page\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a></td><td> <a href=\"$site/page/del.php?id=$page\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td></tr>";
            }
        }
        echo "</table>";
    } else {
        error(7);
    }
}
//управление новостями
function news()
{
    global $id_user, $god_site;
    $adm = dostup_adm();
    $god_org = dostup_org_god($god_site);
    if ($adm == 1 or $god_org == 1) {
        echo "<div align=\"center\"><h3>Управление Новостями</h3></div><a href = \"$site/news/ad.php\">Добавить новость</a><table>";
        $ok_page = mysql_query("select * from news order by id_news desc");        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id_news = $t_page['id_news'];
                $name_news = $t_page['small_news'];
                $date_news = $t_page['date_news'];
                $date_news = date("d.m.y", strtotime($date_news));
                echo "<tr><td>$date_news</td><td><a href = \"$site/news.php?id=$id_news\">$name_news</a></td><td><a href = \"$site/news/edit.php?id=$id_news\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a></td><td> <a href=\"$site/news/del.php?id=$id_news\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td></tr>";
            }
        }
        echo "</table>";
    } else {
        error(7);
    }
}
//управление логами
function logi()
{
    global $id_user, $god_site;
    $adm = dostup_adm();
    $god_org = dostup_org_god($god_site);
    if ($adm == 1 or $god_org == 1) {
        if (isset($_GET['us'])) {
            $us = addslashes($_GET['us']);
        } else {
            $us = 0;
        }
        if (!is_numeric($us)) {
            die("Такой записи нет!");
        }
        $us = intval($us);
        if (isset($_GET['str'])) {
            $str = ($_GET['str']);
        } else {
            $str = "0";
        }
        $str = intval($str);
        if ($us == "0") {
            $q = "SELECT count(*) FROM `log`";
            $ok_page = mysql_query("select * from log order by data desc LIMIT $start,$per_page");
            echo "<div align=\"center\"><h3>Просмотр логов пользователя</h3></div>";
        } else {
            $q = "SELECT count(*) FROM `log` where name = $us";
            $ok_page = mysql_query("select * from log where name = $us order by data desc LIMIT $start,$per_page");
            echo "<div align=\"center\"><h3>Просмотр логов пользователя ";
            user_information($us);
            echo "</h3></div>";
        }
        echo "<div class = \"str\">";
        $res = mysql_query($q);
        $row = mysql_fetch_row($res);
        $total_rows = $row[0];
        $per_page = 40;
        $num_pages = ceil($total_rows / $per_page);
        for ($i = 1; $i <= $num_pages; $i++) {
            if ($str == $i) {
                echo "<b>$i</b>";
            } else {
                if ($us == "0") {
                    echo "<a href=\"$site/admin.php?id=5&str=$i\">$i</a>";
                } else {
                    echo "<a href=\"$site/admin.php?id=5&us=$us&str=$i\">$i</a>";
                }
            }
        }
        echo "</div>";
        if (isset($_GET['st'])) {
            $st = addslashes($_GET['st']);
        } else {
            $st = "";
        }
        if (isset($_GET['str']))
            $str = ($_GET['str'] - 1);
        else
            $str = 0;
        $str = intval($str);
        $start = abs($str * $per_page);
        if ($us == "0") {
            $ok_page = mysql_query("select * from log order by data desc LIMIT $start,$per_page");
        } else {
            $ok_page = mysql_query("select * from log where name = $us order by data desc LIMIT $start,$per_page");
        }
        echo "<table>";        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id = $t_page['id'];
                $name = $t_page['name'];
                $date_news = $t_page['data'];
                $date_com = date("d.m.y", strtotime($date_news));
                $time_com = time_zone($date_news);
                $date_com = date("Y-m-d", strtotime($date_news));
                $date_com = format_date_html($date_com);
                $whot = $t_page['whot'];
                echo "<tr><td>$date_com $time_com</td><td>";
                user_information($name);
                echo "</td><td>$whot</td></tr>";
            }
        }
        echo "</table>";
    } else {
        error(7);
    }
}
function tender_mer()
{
    global $id_user, $god_site;
    $adm = dostup_adm();
    $god_org = dostup_org_god($god_site);
    if ($adm == 1 or $god_org == 1) {
        echo "<div align=\"center\"><h3>Требования.</h3></div>";
        $ok_page = mysql_query("select * from sibkon where god = $god_site");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_con = $t_page['id'];
        }
        $ok_page_m = mysql_query("select * from meropriatia where id_con = $id_con");
        while ($t_page_m = mysql_fetch_array($ok_page_m)) {
            $id_m = $t_page_m['id'];
            $id_con_m = $t_page_m['id_con'];
            $tip_con_m = $t_page_m['tip'];
            $name_mer = name_mer($id_m);
            $tender = nl2br($t_page_m['tender']);
            echo "$name_mer<p>$tender</p>";
        }
    } else {
        error(7);
    }
}
//управление проектами
function konvent()
{
    echo "<div align=\"center\"><h3>Управление Проектами</h3></div><table>";
    global $id_user, $god_site;
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == 1) {
        echo "<a href = \"$site/sibkon/ad.php\">Добавить Проект</a>";
    }
    if ($adm == "1" or $org == "1") {
        $ok_page = mysql_query("select * from sibkon order by god desc");        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id_con = $t_page['id'];
                $god = $t_page['god'];
                $tema = $t_page['tema'];
                echo "<tr><td>$god</td><td><a href = \"$site/sibkon.php?id=$god\">$tema</a></td>";
                $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
                while ($t_tip = mysql_fetch_array($ok_tip)) {
                    $id_o = $t_tip['id'];
                    $id_org = $t_tip['id_org'];
                    $god = $t_tip['god'];
                }
                if ($id_org == $id_user or $adm == 1) {
                    echo "<td><a href = \"$site/sibkon/edit.php?id=$id_con\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a></td><td> <a href=\"$site/sibkon/del.php?id=$id_con\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
                } else {
                    echo "<td></td><td></td>";
                }
                echo "</tr>";
                $id_org = "0";
            }
        }
        echo "</table><p>";
    } else {
        error(7);
    }
}
//управление материалами
function mat()
{
    if (isset($_GET['god'])) {
        $g = addslashes($_GET['god']);
    } else {
        $g = 0;
    }
    if (!is_numeric($g)) {
        die("Такой записи нет!");
    }
    $g = intval($g);
    echo "<div align=\"center\"><h3>Управление Материалами</h3></div>";
	echo "<div align=\"center\"><h4>Ежегодные материалы</h4></div>";
    global $id_user, $god_site;
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == 1 or $org == 1) {
        echo "<div align=\"center\">";
		
		// список ежегодных материалов
		echo "<table>";
                $ok_page = mysql_query("select * from page_sibkon where allyears = '1'");
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $name = $t_page['name'];
                    $id_post = $t_page['id'];
                    echo "<tr><td align=left><a href = \"$site/page_sibkon.php?id=$id_post\">$name</a></td>";
                    $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
                    while ($t_tip = mysql_fetch_array($ok_tip)) {
                        $id_o = $t_tip['id'];
                        $id_org = $t_tip['id_org'];
                        $god = $t_tip['god'];
                    }
                    if ($id_org == $id_user or $adm == 1) {
                        echo "<td><a href = \"$site/page_sibkon/edit.php?id=$id_post\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a></td><td> <a href=\"$site/page_sibkon/del.php?id=$id_post\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td></tr>";
                    } else {
                    }
                    $id_org = "0";
                }
		echo "</table><br>";            
        echo "<div align=\"center\"><h4>Проектные материалы</h4></div>";
		// конец списка ежегодных материалов
        $ok_god = mysql_query("select * from sibkon order by god desc");
        while ($t_god = mysql_fetch_array($ok_god)) {
            $god = $t_god['god'];
            echo "<a href=\"$site/admin.php?id=7&amp;god=$god\">$god</a> | ";
        }
        if ($g == "") {
            $ok_page1 = mysql_query("select * from sibkon order by god desc");
        } else {
            $ok_page1 = mysql_query("select * from sibkon where god = $g");
        }
        echo "</div>";
        echo "<table>";
        while ($t_page1 = mysql_fetch_array($ok_page1)) {
            $god = $t_page1['god'];
            $id1 = $t_page1['id'];            {
                $ok_page = mysql_query("select * from page_sibkon where id_con = $id1 and allyears = 0");
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $name = $t_page['name'];
                    $id_post = $t_page['id'];
                    echo "<tr><td>$god</td><td><a href = \"$site/page_sibkon.php?id=$id_post\">$name</a></td>";
                    $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
                    while ($t_tip = mysql_fetch_array($ok_tip)) {
                        $id_o = $t_tip['id'];
                        $id_org = $t_tip['id_org'];
                        $god = $t_tip['god'];
                    }
                    if ($id_org == $id_user or $adm == 1) {
                        echo "<td><a href = \"$site/page_sibkon/edit.php?id=$id_post\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a></td><td> <a href=\"$site/page_sibkon/del.php?id=$id_post\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td></tr>";
                    } else {
                        echo "<td></td><td></td>";
                    }
                    echo "</tr>";
                    $id_org = "0";
                }
            }
        }
        if ($g == "") {
            echo "</table><p>Материал добавляется только на странице определенного Проекта. Выберите проект из списка вверху страницы.";
        } else {
            echo "</table>";
            $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
            while ($t_tip = mysql_fetch_array($ok_tip)) {
                $id_o = $t_tip['id'];
                $ras = $t_tip['id_org'];
                $god = $t_tip['god'];
            }
            if ($ras == $id_user or $adm == 1) {
                echo "<p><a href = \"$site/page_sibkon/ad.php?id=$id1\">Добавить материал</a>";
            }
        }
    } else {
        error(7);
    }
}
//управление группами
function mer()
{
    global $name_group;
    if (isset($_GET['god'])) {
        $g = addslashes($_GET['god']);
    } else {
        $g = 0;
    }
    if (!is_numeric($g)) {
        die("Такой записи нет!");
    }
    $g = intval($g);
    echo "<div align=\"center\"><h3>Управление Группами ($name_group)</h3></div>Группы - составляющие проекта. Это либо проходящие в рамках проекта мероприятия, либо разные стороны, группы игры или другого проекта. ";
    global $id_user, $god_site;
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == 1 or $org == 1) {
        echo "<div align=\"center\">";
        $ok_god = mysql_query("select * from sibkon order by god desc");
        while ($t_god = mysql_fetch_array($ok_god)) {
            $god = $t_god['god'];
            echo "<a href=\"$site/admin.php?id=8&amp;god=$god\">$god</a> | ";
        }
        if ($g == "") {
            $ok_page1 = mysql_query("select * from sibkon order by god desc");
        } else {
            $ok_page1 = mysql_query("select * from sibkon where god = $g");
        }
        echo "</div><table>";
        while ($t_page1 = mysql_fetch_array($ok_page1)) {
            $god = $t_page1['god'];
            $id1 = $t_page1['id'];            {
                $ok_page = mysql_query("select * from meropriatia where id_con = $id1 order by tip desc");
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $name = $t_page['name'];
                    $id_post = $t_page['id'];
                    $tip = $t_page['tip'];
                    $query = "select * From `tip_mer` where `id` = $tip";
                    $result = mysql_query($query);
                    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
                        $id_tip = "$link[id]";
                        $name_tip = "$link[name]";
                    }
                    echo "<tr><td><a href = \"$site/admin.php?id=9&amp;tip=$id_tip\">$name_tip</a></td><td><a href = \"$site/mer.php?id=$id_post\">$name</a></td>";
                    $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
                    while ($t_tip = mysql_fetch_array($ok_tip)) {
                        $id_o = $t_tip['id'];
                        $id_org = $t_tip['id_org'];
                        $god = $t_tip['god'];
                    }
                    if ($id_org == $id_user or $adm == 1) {
                        echo "<td><a href = \"$site/mer/edit.php?id=$id_post\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a></td><td> <a href=\"$site/mer/del.php?id=$id_post\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td></tr>";
                    } else {
                        echo "<td></td><td></td>";
                    }
                    echo "</tr>";
                    $id_org = "0";
                }
            }
        }
        if ($g == "") {
            echo "</table><p>Группа добавляется только на странице определенного Проекта. Выберите необходимый проект вверху страницы.";
        } else {
            echo "</table>";
            $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
            while ($t_tip = mysql_fetch_array($ok_tip)) {
                $id_o = $t_tip['id'];
                $ras = $t_tip['id_org'];
                $god = $t_tip['god'];
            }
            if ($ras == $id_user or $adm == 1) {
                echo "<p><a href = \"$site/mer/ad.php?id=$id1\">Добавить Группу</a>";
            }
        }
    } else {
        error(7);
    }
}
//управление типами мероприятиями
function tipmer()
{
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == 1 or $org == 1) {
        if (isset($_GET['god'])) {
            $g = addslashes($_GET['god']);
        } else {
            $g = 0;
        }
        if (!is_numeric($g)) {
            die("Такой записи нет!");
        }
        $g = intval($g);
        echo "<div align=\"center\"><h3>Управление Типами</h3></div>";
        echo "<table>";
        $ok_tip = mysql_query("SELECT * FROM tip_mer");
        while ($t_tip = mysql_fetch_array($ok_tip)) {
            $id_tip = $t_tip['id'];
            $name_tip = $t_tip['name'];
            echo "<tr><td align = center><b >$name_tip</b></td><td><a href = \"$site/tip/tip_edit.php?id=$id_tip\" ><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a></td><td> <a href=\"$site/tip/tip_del.php?id=$id_tip\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td></tr>";
            $ok_pod = mysql_query("SELECT * FROM podtip_mer where id_tip = $id_tip order by name");
            while ($t_pod = mysql_fetch_array($ok_pod)) {
                $id_pod = $t_pod['id'];
                $pod_tip = $t_pod['id_tip'];
                $name_pod_tip = $t_pod['name'];
                echo "<tr><td>$name_pod_tip</td><td><a href = \"$site/tip/podtip_edit.php?id=$id_pod\" ><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a></td><td> <a href=\"$site/tip/podtip_del.php?id=$id_pod\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td></tr>";
            }
        }
        echo "<tr><td><a href = \"$site/tip/ad.php?id=1\">Добавить новый тип</a></td><td></td><td></td></tr>";
        echo "<tr><td><a href = \"$site/tip/ad.php?id=2\">Добавить новый подтип</a></td><td></td><td></td></tr>";
        echo "</table>";
    } else {
        error(7);
    }
}
//управление оргами
function org()
{
    global $id_user, $god_site;
    $adm = dostup_adm();
    $org = dostup_org_god($god_site);
    if ($adm == 1 or $org == "1") {
        if (isset($_GET['god'])) {
            $g = addslashes($_GET['god']);
        } else {
            $g = 0;
        }
        if (!is_numeric($g)) {
            die("Такой записи нет!");
        }
        $g = intval($g);
        echo "<div align=\"center\"><h3>Управление Организаторами</h3></div>";
        echo "<table>";
        if ($g == 0) {
            $ok_page = mysql_query("select * from sibkon order by god desc");
        } else {
            $ok_page = mysql_query("select * from sibkon where god = $g");
        }
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_con = $t_page['id'];
            $god = $t_page['god'];
            $tema = $t_page['tema'];
            echo "<tr><td><b>$god</b></td><td><a href = \"$site/sibkon.php?id=$god\"><b>$tema</b></a></td><td><a href = \"$site/sibkon/edit.php?id=$id_con\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a></td><td> <a href=\"$site/sibkon/del.php?id=$id_con\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td></tr>";
            $ok_tip = mysql_query("SELECT * FROM org where god = $god");
            while ($t_tip = mysql_fetch_array($ok_tip)) {
                $id_o = $t_tip['id'];
                $id_org = $t_tip['id_org'];
                $user = user_info($id_org);
                echo "<tr><td></td><td>$user</td><td></td><td> <a href=\"$site/org/del.php?id=$id_o\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td></tr>";
            }
        }
        echo "</table>";
        echo "<p><a href = \"$site/org/ad.php\">Добавить нового орга.</a>";
    } else {
        error(7);
    }
}
//управление пользователями
function module_site()
{
    global $id_user;
    $adm = dostup_adm();
    if ($adm == 1) {
        if (isset($_GET['ok'])) {
            $ok = addslashes($_GET['ok']);
        }
        $ok = intval($ok);
        echo "<div align=\"center\"><h3>Управление Модулями</h3></div>";
        echo "<table><thead><th>Имя Модуля</th><th>Файл</th><th>Включен</th><th></th><th></th></thead>";
        $ok_page = mysql_query("select * from module");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_modul = $t_page['id'];
            $name_modul = $t_page['name'];
            $on_modul = $t_page['on'];
            if ($on_modul == "0") {
                $on_modul = "Нет";
            } else {
                $on_modul = "Да";
            }
            $file_modul = $t_page['file'];
            echo "<tr><td>$name_modul</td><td>$file_modul</td><td>$on_modul</td><td><a href = \"$site/module/edit.php?id=$id_modul\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a></td><td><a href=\"$site/module/del.php?id=$id_modul\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td></tr>";
        }
        echo "</table>";
        echo "<h5>Добавить новый модуль.</h5>";
        echo "<form name=\"form1\" method=\"post\" action=\"/module/ad.php\">
        <table>
<tr><td>Название:</td><td><input type=\"text\"  name='name' size=\"86\"></td></tr>
<tr><td>Файл:</td><td><input type=\"text\"  name='file' size=\"86\"></td></tr>        
<tr><td>Включен:</td><td><select name=\"on\" size=\"1\"><option value=\"0\">Нет</option><option value=\"1\">Да</option></select><tr>
       </table>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Добавить</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\"/>                           
</form>
       ";
    } else {
        error(7);
    }
}

function ban()
{
global $id_user, $god_site, $name_site, $site;
    $adm = dostup_adm();
    $god_org = dostup_org_god($god_site);
    if ($adm == 1 or $god_org == 1) {
	 echo "<div align=\"center\"><h3>Управление черным списком</h3></div>";
        echo "";
		echo "
 <table id=\"example\" class=\"display\">
<thead>
<tr><th>Ник</th><th>Имя</th><th>Фамилия</th><th>Город</th><th></th></tr>
</thead>
<tbody>
";
		if (isset($_GET['g']))
		{
			$g = addslashes($_GET['g']);
		}
		else
		{
			$g = "";
		}
		if (!($g == ""))
		{
			$query = "select * From `us` where ban = '1' and gorod_us = '$g'";
		}
		else
		{
			$query = "select * From `us` where ban = '1'";
		}
		$result = mysql_query($query) or die("Query failed : " . mysql_error());
		while ($link = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$id_us = "$link[id_us]";
			$name_us = "$link[name_us]";
			$fam_us = "$link[fam_us]";
			$nick_us = "$link[nick_us]";
			$gorod_us = "$link[gorod_us]";
			echo "
<tr><td><a title = \"$nick_us\" href = \"$site/profile.php?id=$id_us\">$nick_us</a></td><td>$name_us</td><td>$fam_us</td><td>$gorod_us</td><td>";
if ($id_user=="1854" or $id_user=="539") {
 echo"
<a href=\"profile/unban.php?id=$id_us\"  onclick=\"return confirm('Разблокировать? Точно?')\">Разблокировать</a>";
}
echo"
</td></tr>";
		}
		echo "
</tbody>
<tfoot>
<tr><th>Ник</th><th>Имя</th><th>Фамилия</th><th>Город</th><th></th></tr>

</tfoot>
</table>";
}
}
function room()
{
    global $id_user, $god_site, $name_site, $site;
    $adm = dostup_adm();
    $god_org = dostup_org_god($god_site);
    if ($adm == 1 or $god_org == 1) {
        echo "<div align=\"center\"><h3>Управление поселением на $name_site $god_site</h3></div>";
        echo "";
        echo "<table><tr><th>Название</th><th>Тип</th><th>Кол-Во</th><th>Отвественный</th></tr>";
        $ok_page = mysql_query("select * from room where id_con = $god_site");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_room = $t_page['id'];
            $name_room = $t_page['name'];
            $glav = $t_page['glav'];
            $tip = $t_page['tip'];
            $kolvo = $t_page['kolvo'];
            $glav = user_info($glav);
            if ($tip == 0) {
                $tip = "Не определено";
            } else
                if ($tip == 1) {
                    $tip = "Кровати";
                    $color = "#AAD4FF";
                } else
                    if ($tip == 2) {
                        $tip = "Спальники";
                         $color = "#7FFF7F";
                    } else
                        if ($tip == 3) {
                            $tip = "Люкс";
                             $color = "#FFAAFF";
                        } else
							if ($tip == 4) {
								$tip = "Дневное";
								 $color = "#FFAAAA";
							} else
							if ($tip == 5) {
								$tip = "Безлимитное посещение";
								 $color = "#FFAAAA";
							}
 
            
            
            
            echo "<tr bgcolor=\"$color\" ><td><a href = \"$site/room/edit.php?id=$id_room\">$name_room</a></td><td>$tip</td><td>$kolvo</td><td>$glav</td></tr>
			";
        }
        echo "</table>";

        $ok_news1 = mysql_query("select sum(kolvo) from room where id_con=$god_site");
        while ($t_news1 = mysql_fetch_array($ok_news1)) {
            $count1 = $t_news1['sum(kolvo)'];
            echo "всего мест: $count1";
        }
        echo "<br>Из них:<br>";
        $name = ($_GET['name']);
        $tip = ($_GET['tip']);
        $kolvo = ($_GET['kolvo']);
        $otv = ($_GET['otv']);

        if ($otv == "") {

            $site_info = mysql_query("select * from setting_site");
            if (!mysql_num_rows($site_info))
                die("Данные о сайте не получены.");
            else {
                while ($site_i = mysql_fetch_array($site_info)) {

                    $otv = $site_i['otv_pos'];
                }

            }
        }


        $ok_news1 = mysql_query("select tip,sum(kolvo) from room  where id_con=$god_site group by tip");
        while ($t_news1 = mysql_fetch_array($ok_news1)) {
            $count1 = $t_news1['sum(kolvo)'];
            $count1tip = $t_news1['tip'];

            if ($count1tip == 0) {
                $count1tip_print = "Не определено";
            } else
                if ($count1tip == 1) {
                    $count1tip_print = "Кровати";
                } else
                    if ($count1tip == 2) {
                        $count1tip_print = "Спальники";
                    } else
                        if ($count1tip == 3) {
                            $count1tip_print = "Люкс";
                        } else
							if ($count1tip == 4) {
                            $count1tip_print = "Дневное";
							} else
							if ($count1tip == 5) {
                            $count1tip_print = "Безлимитное посещение";
							}
            echo "$count1tip_print: $count1<br>";
        }
        echo "
			<form method=\"post\" action=\"$site/room/adroom.php\">
			<table>
			<tr><td>Название комнаты (номер)</td><td><input type=\"text\" name = \"name\" value = \"$name\"></td></tr>
<tr><td>Тип комнаты</td><td><SELECT NAME=\"tip\" SIZE=\"1\">
	        <OPTION VALUE=\"0\" ";
        if ($tip == 0) {
            echo "selected";
        }
        echo " >Не определено</OPTION>
	       <OPTION VALUE=\"1\" ";
        if ($tip == 1) {
            echo "selected";
        }
        echo " >Кровати</OPTION>
	       <OPTION VALUE=\"2\" ";
        if ($tip == 2) {
            echo "selected";
        }
        echo " >Спальники</OPTION>
	       <OPTION VALUE=\"3\" ";
        if ($tip == 3) {
            echo "selected";
        }
        echo " >Люкс</OPTION>
		<OPTION VALUE=\"4\" ";
        if ($tip == 4) {
            echo "selected";
        }
        echo " >Дневное</OPTION>
		<OPTION VALUE=\"5\" ";
        if ($tip == 5) {
            echo "selected";
        }
        echo " >Безлимитное посещение</OPTION>
		
       </SELECT></td></tr>
       <tr><td>Кол-во мест</td><td><input type=\"text\" name = \"kolvo\"  value = $kolvo></td></tr>
           <tr><td>Ответственный (ИД пользователя)</td><td><input type=\"text\" name = \"otv\"  value = $otv></td></tr>
</table><input type=\"submit\" value=\"Добавить\" name=\"submit\">
</form>
	";


    } else {
        error(7);
    }
}


function action()
{
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == "1" or $org == "1") {
        if (isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
        } else {
            $id = 1;
        }
        if (!is_numeric($id)) {
            die("Такой записи нет!");
        }
        $id = intval($id);
        //1 - главная страница
        if ($id == "1") {
            glav();
        }
        //2 - управление сайтом
        else
            if ($id == "2") {
                site();
            }
        //3 - управление страницами
            else
                if ($id == "3") {
                    pages();
                }
        //4 - управление новостями
                else
                    if ($id == "4") {
                        news();
                    }
        //5 - логи пользователей
                    else
                        if ($id == "5") {
                            logi();
                        }
        //6 - управление конвентами
                        else
                            if ($id == "6") {
                                konvent();
                            }
        //7 - управлением материалами
                            else
                                if ($id == "7") {
                                    mat();
                                }
        //8 - управление мероприятиями
                                else
                                    if ($id == "8") {
                                        mer();
                                    }
        //9 - управление типами и подтипами
                                    else
                                        if ($id == "9") {
                                            tipmer();
                                        }
        //10 - управление оргами конвентов
                                        else
                                            if ($id == "10") {
                                                org();
                                            } else //11 - управление модулями

                                                if ($id == "11") {
                                                    module_site();
                                                } else //12 - список требований

                                                    if ($id == "12") {
                                                        tender_mer();
                                                    } else //12 - список требований

                                                        if ($id == "13") {
                                                            room();
                                                        } else //14 - Черный список

                                                        if ($id == "14") {
                                                            ban();
                                                        }
    } else {
        error(7);
    }
}
function title()
{
    global $id_us, $name_site;
    if (isset($_GET['id'])) {
        $id = addslashes($_GET['id']);
    } else {
        $id = 1;
    }
    if (!is_numeric($id)) {
        die("Такой записи нет!");
    }
    $id = intval($id);
    //1 - главная страница
    if ($id == "1") {
        $name_title = "Администрирование";
    }
    //2 - управление сайтом
    else
        if ($id == "2") {
            $name_title = "Управление сайтом";
        }
    //3 - управление страницами
        else
            if ($id == "3") {
                $name_title = "Управление страницами";
            }
    //4 - управление новостями
            else
                if ($id == "4") {
                    $name_title = "Управление новостями";
                }
    //5 - логи пользователей
                else
                    if ($id == "5") {
                        $name_title = "Логи пользователей";
                    }
    //6 - управление конвентами
                    else
                        if ($id == "6") {
                            $name_title = "Управление проектами";
                        }
    //7 - управлением материалами
                        else
                            if ($id == "7") {
                                $name_title = "Управлением материалами";
                            }
    //8 - управление мероприятиями
                            else
                                if ($id == "8") {
                                    $name_title = "Управление мероприятиями";
                                }
    //9 - управление типами и подтипами
                                else
                                    if ($id == "9") {
                                        $name_title = "Управление типами и подтипами";
                                    }
    //10 - управление оргами конвентов
                                    else
                                        if ($id == "10") {
                                            $name_title = "Управление оргами";
                                        } else
                                            if ($id == "12") {
                                                $name_title = "Требования";
                                            } else
                                                if ($id == "13") {
                                                    $name_title = "Управление поселением";
                                                } else
                                                if ($id == "14") {
                                                    $name_title = "Черный список";
                                                }
    echo "
<link type=\"text/css\" rel=\"stylesheet\" href=\"$site/js/jtip.css\" media=\"all\">
<script src=\"$site/js/jtip.js\" type=\"text/javascript\"></script>
";
    echo "
<title>$name_title | $name_site</title>";
}
function right()
{
    global $name_group;
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == "1" or $org == "1") {
        global $site;
        echo "<ul>";
        echo "<li><a href = \"$site/admin.php?id=6\">Управление Проектами</a></li>";
        echo "<li><a href = \"$site/admin.php?id=7\">Управление Материалами</a></li>";
       // echo "<li><a href = \"$site/admin.php?id=8\">Управление ($name_group)</a></li>";
        echo "<li><a href = \"$site/admin.php?id=9\">Управление Типами</a></li>";
        echo "<li><a href = \"$site/admin.php?id=10\">Орги проектов</a></li>";
        echo "<li><a href = \"$site/admin.php?id=2\">Управление Сайтом</a></li>";
        echo "<li><a href = \"$site/admin.php?id=3\">Управление Страницами</a></li>";
        echo "<li><a href = \"$site/admin.php?id=4\">Управление Новостями</a></li>";
        echo "<li><a href = \"$site/admin.php?id=11\">Просмотр Модулями</a></li>";
        echo "<li><a href = \"$site/admin.php?id=12\">Требования к текущему проекту</a></li>";
        echo "<li><a href = \"$site/admin.php?id=13\">Управление Поселением</a></li>";
        echo "<li><a href = \"$site/admin.php?id=5\">Просмотр логов</a></li>";
	    echo "<li><a href = \"$site/admin.php?id=14\">Черный список</a></li>";
        echo "</ul>";
    }
}
require ("theme/$theme/$theme.htm");
?>