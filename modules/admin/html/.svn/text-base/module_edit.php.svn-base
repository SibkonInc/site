<h2 align="center"><?=$setting['admin'];?></h2>
<h4 align="center">Редактирование Модуля</h4>
<a href="<?=$setting['site'];?><?=$module_info['url']?>">Перейти на модуль</a> |
<a href="<?=$setting['site'];?><?=$module_info['url']?>/admin">Управление модулем</a>
<h5>Основные данные</h5>
<form action="<?=$setting['site'];?>admin/module_edit_post/<?=$module_info['id']?>" method="POST" name="add">
    <table>
        <tr>
            <td align="right" width="200" >
                Адрес вызова модуля
                <span class="formInfo">
                    <a href="<?=$setting['site']?>help.php?id=module_url&amp;width=375" class="jTip" id="file_block" name="Адрес модуля">
                        <img src="<?=$setting['site']?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="url" value="<?=$module_info['url']?>">
            </td>
        </tr>
        <tr>
            <td align="right" width="200" >
                Папка модуля
                <span class="formInfo">
                    <a href="<?=$setting['site']?>help.php?id=module_mesto&amp;width=375" class="jTip" id="file_block" name="Папка модуля">
                        <img src="<?=$setting['site']?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="file">
                    <?if ($handle = opendir('modules/')) {while (false !== ($file = readdir($handle))) {if ($file != "." && $file != "..") {?>
                        <option value="<?=$file?>" <? if ($file == $module_info['file']): ?> selected<? endif; ?>><?=$file; ?></option>
                            <?}}closedir($handle);}?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right" width="200" >
                Включение
                <span class="formInfo">
                    <a href="<?=$setting['site']?>help.php?id=on_off_module&amp;width=375" class="jTip" id="on_off_block" name="Включение">
                        <img src="<?=$setting['site']?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="on_off">
                    <option value="1" <? if ($module_info['on_off'] == "1"): ?> selected<? endif; ?>>Включен</option>
                    <option value="0" <? if ($module_info['on_off'] == "0"): ?> selected<? endif; ?>>Выключен</option>
                </select>
            </td>
        </tr>
<? foreach ($lang as $langu): ?>
        <tr>
            <td align="right" width="200" >
                Название для <?=$langu['name_lang']; ?>
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=lang_block&amp;width=375" class="jTip" id="lang_block<?=$langu['id']; ?>" name="Название блока">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <?$lang_b = $ycms->sql_query_one("module_lang", "where id_lang ='" . $langu['id'] . "' and id_id='" . $module_info['id'] . "'");
                if ($lang_b['id_lang'] == $langu['id']): ?>
                <input type="text" name="name<?=$lang_b['id_module_lang'];?>" value="<?=$lang_b['name']?>">
                <? else: ?>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery('#none').click(function(){
                            jQuery('#form_new_lang').load('<?=$setting['site'] ?>admin/add_module_lang_name/<?=$langu['id'] ?>/?id=<?=$block_info['id'] ?>');
                                $('#none').hide();
                            })
                        });
                        $("#loading").bind("ajaxSend", function(){
                            $(this).show(); // показываем элемент
                        }).bind("ajaxComplete", function(){
                            $(this).hide();
                            // скрываем элемент
                        });
                    </script>
                    <div id="none">Добавить</div>
                    <div id="form_new_lang"></div>
                    <div  id="loading"><img src="<?=$setting['site'] ?>img/loader.gif" width="62" height="13" alt="loader"/>
                    </div>
            <style type="text/css">#loading {display:none;}</style>
            </div>
            </div>
        <? endif; ?>
    </td>
    </tr>
<? endforeach; ?>
    </table>
    <div style="height:50px;margin-top:5px;" align="right">
        <ul class='nNav' style="width:50px;padding:0px;margin:0px;">
            <li style="margin:0px 3px 0px 0px;">
                <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
                <span class="ncc"><a href="javascript:document.add.submit()">Изменить</a></span>
                <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
            </li>
        </ul>
    </div>
</form>
<h4 align="center">Управление доступом.</h4>
<?if ($module_info['access']=="0"): ?>
Свободный доступ
<?else:?>
<?  include 'modules/admin/html/access_id.php';?>
<?endif;?>