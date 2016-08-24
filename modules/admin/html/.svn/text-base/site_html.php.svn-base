<h2 align="center"><?=$setting['admin']
?></h2>
<h4 align="center">Управление Сайтом.</h4>
<?if(isset($ok) and $ok==true):?>
<div class="attention">Изменения внесены</div>
<?endif;?>
<h5 align="center">Основные настройки. (Не зависят от языка)</h5>
<form action="<?=$setting['site']?>admin/site_edit" method="POST" name="site_edit">
    <table>
        <tr>
            <td align="right" width="200" >
                Статус
                <span class="formInfo">
                    <a href="<?=$setting['site']?>help.php?id=status&amp;width=375" class="jTip" id="status" name="Статус сайта">
                        <img src="<?=$setting['site']?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="status">
                    <option value="1" <? if ($site['status'] == "1"): ?> selected<? endif; ?>>Включен</option>
                    <option value="0" <? if ($site['status'] == "0"): ?> selected<? endif; ?>>Выключен</option>
                </select>           
            </td>
        </tr>
        <tr>
            <td align="right" width="200" >
                Тема
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=theme&amp;width=375" class="jTip" id="them" name="Тема сайта">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="theme">
                    <?
                                     if ($handle = opendir('theme/')) {
                                         while (false !== ($file = readdir($handle))) {
                                             if ($file != "." && $file != "..") {
                    ?>
                                                 <option value="<?=$file
                    ?>" <? if ($file == $site['theme']): ?> selected<? endif; ?>><?=$file; ?></option>
                            <?
                        }
                    }
                    closedir($handle);
                }
                            ?>
                </select>
            </td>               
        </tr>
        <tr>
            <td align="right">
                E-mail администратора
                <span class="formInfo">
                    <a href="<?=$setting['site']
                            ?>help.php?id=mail_adm&amp;width=375" class="jTip" id="mail_adm" name="E-mail администратора">
                             <img src="<?=$setting['site']
                            ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="mail_adm" value="<?=$site['mail_adm']
                            ?>">
                  </td>
              </tr>
              <tr>
                  <td align="right">
                      Адрес сайта
                      <span class="formInfo">
                          <a href="<?=$setting['site']
                            ?>help.php?id=site&amp;width=375" class="jTip" id="site" name="Адрес сайта">
                        <img src="<?=$setting['site']
                            ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="site" value="<?=$site['site']
                            ?>">
                  </td>
              </tr>
              <tr>
                  <td align="right">
                      Язык по умолчанию
                      <span class="formInfo">
                          <a href="<?=$setting['site']
                            ?>help.php?id=lang&amp;width=375" class="jTip" id="lang" name="Язык сайта  по умолчанию">
                        <img src="<?=$setting['site']
                            ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="lang">
                    <? foreach ($lang as $lang_v): ?>
                           <option value="<?=$lang_v['id'] ?>" <? if ($lang_v['id'] == $site['lang']): ?> selected<? endif; ?>><?=$lang_v['name_lang'] ?></option>
                    <? endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">
                    Модуль по умолчанию
                    <span class="formInfo">
                        <a href="<?=$setting['site'] ?>help.php?id=module&amp;width=375" class="jTip" id="module" name="Модуль сайта  по умолчанию">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td> 
                <select name="module">
                    <? foreach ($module as $mod): ?>
                        <option value="<?=$mod['url'] ?>" <? if ($mod['url'] == $site['module']): ?> selected<? endif; ?>><?=$mod['name'] ?></option>
                    <? endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <tr>
            <td align="right" width="200" >
                Регистрация пользователей на сайте
                <span class="formInfo">
                    <a href="<?=$setting['site']?>help.php?id=status&amp;width=375" class="jTip" id="status" name="Статус сайта">
                        <img src="<?=$setting['site']?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="on_registered">
                    <option value="1" <? if ($site['on_registered'] == "1"): ?> selected<? endif; ?>>Разрешена</option>
                    <option value="0" <? if ($site['on_registered'] == "0"): ?> selected<? endif; ?>>Запрещена</option>
                </select>
            </td>

        </tr>
            <tr>
                <td align="right">
                    Тип пользователей при регистрации
                    <span class="formInfo">
                        <a href="<?=$setting['site'] ?>help.php?id=module&amp;width=375" class="jTip" id="module" name="Модуль сайта  по умолчанию">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="id_tip_user">
                    <? foreach ($tip_user as $tip_users): ?>
                        <option value="<?=$tip_users['id'] ?>" <? if ($tip_users['id'] == $site['id_tip_user']): ?> selected<? endif; ?>><?=$tip_users['name'] ?></option>
                    <? endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>



                <td></td>
                <td>
                    <div style="height:50px;margin-top:5px;" align="right">
                        <ul class='nNav' style="width:200px;padding:0px;margin:0px;">
                            <li style="margin:0px 3px 0px 0px;">
                                <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
                                <span class="ncc"><a href="javascript:document.site_edit.submit()">Изменить Основные настройки</a></span>
                                <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </table>

    </form>

<? foreach ($lang as $langu): ?>
                            <h5 align="center">Настройки для языка <?=$langu['name_lang']; ?></h5>
<? $set_lang = $this->sql_query_one("setting_lang", "where id_lang = '" . $langu['id'] . "' and id_set = '" . $site['id'] . "'"); ?>
<? if ($set_lang == false): ?>
    <div class="attention" align="center">Для этого языка не введены настройки!</div>
<? $knopka = "Добавить"; ?>
<? $act = "add";?>
<? else:$knopka = "Изменить"; ?>
<? $act = "edit";?>
<? endif; ?>
        <form action="<?=$setting['site']?>admin/site_<?=$act;?>/<?=$set_lang['id'] ?>" method="POST" name="edit_site<?=$set_lang['id'] ?>">
            
            <table>
                <tr>
                    <td align="right" width="200" ></td>
                    <td><input type="hidden" name="id_lang" value="<?=$langu['id'] ?>" ></td>
                </tr>  
                <tr>
                    <td align="right" width="200" ></td>
                    <td><input type="hidden" name="id_set" value="<?=$site['id'] ?>" ></td>
                </tr>  
                <tr>
                    <td align="right" width="200" >
                        Имя сайта
                        <span class="formInfo">
                            <a href="<?=$setting['site'] ?>help.php?id=name_site&amp;width=375" class="jTip" id="name_site<?=$set_lang['id'] ?>" name="Имя сайта">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="name" value="<?=$set_lang['name'] ?>">
            </td>
        </tr>
        <tr>
            <td align="right">
                Текст статуса
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=status_text&amp;width=375" class="jTip" id="status_text<?=$set_lang['id'] ?>" name="Текст Статуса">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="status_text" value="<?=$set_lang['status_text'] ?>">
            </td>
        </tr>
        <tr>
            <td align="right">
                Поле логина
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=login&amp;width=375" class="jTip" id="login<?=$set_lang['id'] ?>" name="Поле логина">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="login" value="<?=$set_lang['login'] ?>">
            </td>
        </tr>
        <tr>
            <td align="right">
                Поле пароля
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=password&amp;width=375" class="jTip" id="password<?=$set_lang['id'] ?>" name="Поле пароля">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="password" value="<?=$set_lang['password'] ?>">
            </td>
        </tr>
        <tr>
            <td align="right">
                Кнопка входа
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=login_button&amp;width=375" class="jTip" id="login_button<?=$set_lang['id'] ?>" name="Кнопка входа">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="login_button" value="<?=$set_lang['login_button'] ?>">
            </td>
        </tr>
        <tr>
            <td align="right">
                Кнопка выхода
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=logout&amp;width=375" class="jTip" id="logut<?=$set_lang['id'] ?>" name="Кнопка выхода">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="logout" value="<?=$set_lang['logout'] ?>">
            </td>
        </tr>
        <tr>
            <td align="right">
                Профиль
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=profile&amp;width=375" class="jTip" id="profile<?=$set_lang['id'] ?>" name="Профиль">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="profile" value="<?=$set_lang['profile'] ?>">
            </td>
        </tr>
        <tr>
            <td align="right">
                Панель администрирования
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=admin&amp;width=375" class="jTip" id="admin<?=$set_lang['id'] ?>" name="Панель Администрирования">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="admin" value="<?=$set_lang['admin'] ?>">
            </td>
        </tr>
        <tr>
            <tr>
            <td align="right">
                Так же можно прочитать
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=admin&amp;width=375" class="jTip" id="admin<?=$set_lang['id'] ?>" name="Панель Администрирования">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="read" value="<?=$set_lang['read'] ?>">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <div style="height:50px;margin-top:5px;" align="right">
                    <ul class='nNav' style="width:200px;padding:0px;margin:0px;">
                        <li style="margin:0px 3px 0px 0px;">
                            <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
                            <span class="ncc"><a href="javascript:document.edit_site<?=$set_lang['id'] ?>.submit()"><?=$knopka; ?> настройки для <?=$langu['name_lang']; ?></a></span>
                            <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    </table>
</form>
<? endforeach; ?>
                        