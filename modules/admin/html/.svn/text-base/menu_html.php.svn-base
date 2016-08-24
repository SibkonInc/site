<h2 align="center"><?=$setting['admin']?></h2>
<h4 align="center">Управление меню.<span class="formInfo"><a href="<?=$setting['site']?>help.php?id=menu_info&amp;width=375" class="jTip" id="menu_site" name="Настройки меню"><img src="<?=$setting['site']?>img/ico/help.png" border="0" alt="Информация"></a></span></h4>
<table class="text">
    <thead>
        <tr>
            <td>id</td>
            <td>относится</td>
            <td>adress</td>
            <td>position</td>
            <td>access</td>
            <td>nomer</td>
 <? foreach ($lang as $langu): ?>
            <td><?=$langu['name_lang']; ?></td>
<? endforeach; ?>
            <td></td>
            <td></td>
        </tr>
    </thead>

<?if ($menu_data): foreach ($menu_data as $menu):?>
        <tr>
            <td><?=$menu['id']?></td>
             <td><?=$menu['id_id']?></td>
            <td><?=$menu['adress']?></td>
            <td><?=$menu['position']?></td>
            <td><?=$menu['access']?></td>
            <td><?=$menu['nomer']?></td>
<? foreach ($lang as $lan): ?>
                    <? $wer = "where menu_id_id = '" . $menu['id'] . "' and menu_id_lang = '" . $lan['id'] . "'";
        $men_lang = $ycms->sql_query_one("menu_lang", $wer);?>
            <td><?=$men_lang['menu_name']?></td>
<? endforeach; ?>
            <td align="center"><a href ="<?=$setting['site'] ?>admin/menu_edit/<?=$menu['id'] ?>"> <img src="<?=$setting['site'] ?>img/ico/pencil3.png" width="16" height="16" alt="Редактировать" title="Редактировать "></a></td>
        <td align="center"><a href ="<?=$setting['site'] ?>admin/menu_del/<?=$menu['id'] ?>"> <img src="<?=$setting['site'] ?>img/ico/deletered.png" width="16" height="16" alt="Удалить" title="Удалить "></a></td>
        </tr>
<? endforeach; endif;?>
    </thead>
</table>
<?=$html->ahref("admin/menu_add", "добавить"); ?>