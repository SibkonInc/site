<h2 align="center"><?=$setting['admin']
?></h2>
<h4 align="center">Добавление Блока.</h4>
<h5>Основные данные</h5>
<form action="<?=$setting['site']
?>admin/block_add" method="POST" name="add">
    <table>
        <tr>
            <td align="right" width="200" >
                Принадлежит
                <span class="formInfo">
                    <a href="<?=$setting['site']
                    ?>help.php?id=module_block&amp;width=375" class="jTip" id="module_block" name="Принадлежность">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="module">
                    <option value="0">Система</option>
<? foreach ($modules as $module): ?>
                    <option value="<?=$module['id'] ?>"><?=$module['name'] ?></option>
<? endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right" width="200" >
                Файл блока
                <span class="formInfo">
                    <a href="<?=$setting['site']
?>help.php?id=file_block&amp;width=375" class="jTip" id="file_block" name="Файл блока">
                        <img src="<?=$setting['site']
?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="file">
                    <option value="0">Не используется</option>
                    <?
                    foreach ($modules as $module) {
                        if ($handlem = opendir('modules/' . $module['url'] . '/block/')) {
                            while (false !== ($filem = readdir($handlem))) {
                                if ($filem != "." && $filem != "..") {
                    ?>
                                    <option value="<?=$filem ?>"><?=$module['url'] ?>: <?=$filem; ?></option>
                    <?
                }
            }
            closedir($handlem);
        }
    }
                    if ($handle = opendir('block/')) {
                        while (false !== ($file = readdir($handle))) {
                            if ($file != "." && $file != "..") {
                    ?>
                                <option value="<?=$file ?>">Система: <?=$file; ?></option>
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
            <td align="right" width="200" >
                Показать шапку
                <span class="formInfo">
                    <a href="<?=$setting['site']
                    ?>help.php?id=top_block&amp;width=375" class="jTip" id="top_block" name="Внешний вид">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="top">
                    <option value="0">Не показывать</option>

                    <option value="1">Показывать</option>

                </select>
            </td>
        </tr>
        <tr>
            <td align="right" width="200" >
                Включение
                <span class="formInfo">
                    <a href="<?=$setting['site']
                    ?>help.php?id=on_off_block&amp;width=375" class="jTip" id="on_off_block" name="Включение">
                        <img src="<?=$setting['site']
                    ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="on_off">
                    <option value="1">Включен</option>
                    <option value="2">Выключен</option>
                </select>
            </td>
        </tr>

        <tr>
            <td align="right" width="200" >
                Месторасположение
                <span class="formInfo">
                    <a href="<?=$setting['site']
                    ?>help.php?id=module_view&amp;width=375" class="jTip" id="module_view" name="Месторасположение">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="view">
                    <option value="0">Везде</option>
<? foreach ($modules as $module): ?>
                    <option value="<?=$module['id'] ?>"><?=$module['name'] ?></option>
<? endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right" width="200" >
                Позиция
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=block&amp;width=375" class="jTip" id="position_block" name="Позиция">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <select name="position">
                    <option value="left" selected>Левый блок</option>
                    <option value="right">Правый блок</option>
                    <option value="top">Верхний блок</option>
                    <option value="top_left">Верхний левый блок</option>
                    <option value="top_right">Верхний правый блок</option>
                    <option value="down_left">Нижний левый блок</option>
                    <option value="down_right">Нижний правый блок</option>
                    <option value="down">Нижний блок</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right" width="200" >
                Номер по порядку
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=nomer_block&amp;width=375" class="jTip" id="nomer_block" name="Номер по порядку">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="nomer" value="" />
            </td>
        </tr>
        <tr>
            <td align="right" width="200" >
                Набор правил
                <span class="formInfo">
                    <a href="<?=$setting['site'] ?>help.php?id=access_block&amp;width=375" class="jTip" id="access_block" name="Набор правил">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span>
            </td>
            <td>
                <input type="text" name="access" value="1" />
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
                        <input type="text" name="name<?=$langu['id']; ?>" value="" />
                    </td>
                </tr>
                <tr>
                    <td align="right" width="200" >
                       Текст для <?=$langu['name_lang']; ?>
                        <span class="formInfo">
                            <a href="<?=$setting['site'] ?>help.php?id=text_block&amp;width=375" class="jTip" id="text_block<?=$langu['id']; ?>" name="Текст блока">
                                <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                            </a>
                        </span>
                    </td>
                    <td>
                        <textarea name="text<?=$langu['id']; ?>" rows="4" cols="20" class="ckeditor" id="editor<?=$langu['id'];?>">
                        </textarea>

                    </td>
                </tr>
                <script type="text/javascript">
var ckeditor1 = CKEDITOR.replace('editor<?=$langu['id'];?>');
AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor<?=$langu['id'];?>});
</script>
<? endforeach; ?>
    </table>
    <div style="height:50px;margin-top:5px;" align="right">
        <ul class='nNav' style="width:50px;padding:0px;margin:0px;">
            <li style="margin:0px 3px 0px 0px;">
                <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
                <span class="ncc"><a href="javascript:document.add.submit()">Добавить</a></span>
                <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
            </li>
        </ul>
    </div>
</form>



