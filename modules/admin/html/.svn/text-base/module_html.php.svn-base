<h2 align="center"><?=$setting['admin']
?></h2>
<h4 align="center">Управление Модулями.
    <span class="formInfo">
        <a href="<?=$setting['site'];
?>help.php?id=module_info&amp;width=375" class="jTip" id="name_site" name="Модули"><img src="<?=$setting['site'];
?>img/ico/help.png" border="0" alt="Информация"></a>
    </span>
</h4>
<table class="text">
    <thead>
        <tr>
            <td>Ид</td>
            <td>Адрес</td>
            <td>Папка</td>
            <td>Включен</td>
            <? foreach ($lang as $langu): ?>
                <td><?=$langu['name_lang']; ?></td>
            <? endforeach; ?>
            <td>Доступ</td>
            <td></td>
            <td></td>
        </tr>
    </thead>
    <? foreach ($modules as $module): ?>
                <tr>
                    <td><?=$module['id'] ?></td>
        <td><?=$module['url'] ?></td>
        <td><?=$module['file'] ?></td>
         <td align="center"><? if ($module['on_off'] == "1"): ?><img src="<?=$setting['site']; ?>img/ico/power_on.png" border="0" alt="Включен" title="Включен"><? else: ?><img src="<?=$setting['site']; ?>img/ico/power_off.png" border="0" alt="Выключен" title="Выключен"><? endif; ?></td>
<? foreach ($lang as $langu): ?>
            <td>
            <? $wer = "where id_id = '" . $module['id'] . "' and id_lang = '" . $langu['id'] . "'";
            $module_lang = $ycms->sql_query("module_lang", $wer); ?>
            <? if (!(empty($module_lang))): ?>
            <? foreach ($module_lang as $module_langu): ?>
                                                         <?=$module_langu['name']; ?>
            <? endforeach; ?>
            <? else: ?>
                <img src="<?=$setting['site'] ?>img/ico/cancel.png" width="16" height="16" alt="Отсутствует" title="Отсутствует ">
            <? endif; ?>
        </td>
        <? endforeach; ?>
            <td><a href="<?=$setting['site'] ?>admin/access"><?=$module['access'] ?></a></td>
        <td align="center"><a href ="<?=$setting['site'] ?>admin/module/<?=$module['id'] ?>"> <img src="<?=$setting['site'] ?>img/ico/pencil3.png" width="16" height="16" alt="Редактировать" title="Редактировать "></a></td>
        <td align="center"><a href ="<?=$setting['site'] ?>admin/module_del/<?=$module['id'] ?>"> <img src="<?=$setting['site'] ?>img/ico/deletered.png" width="16" height="16" alt="Удалить" title="Удалить "></a></td>
    </tr>






    <? endforeach; ?>





</table>
<?=$html->ahref("admin/module_add", "добавить"); ?>