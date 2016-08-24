<h2 align="center"><?=$setting['admin']
?></h2>
<h4 align="center">Управление Блоками.
    <span class="formInfo">
        <a href="<?=$setting['site'];
?>help.php?id=block&amp;width=375" class="jTip" id="name_site" name="Блоки"><img src="<?=$setting['site'];
?>img/ico/help.png" border="0" alt="Информация"></a>
    </span>
</h4>
<table class="text">
    <thead>
        <tr>
            <td>Ид</td>
            <td>Модуль</td>
            <td>Файл</td>
            <td>Включен</td>
            <td>Место</td>
            <td>Позиция</td>
            <td>Номер</td>
            <? foreach ($lang as $langu): ?>
                <td><?=$langu['name_lang']; ?></td>
            <? endforeach; ?>
            <td>Доступ</td>
            <td></td>
            <td></td>
        </tr>
    </thead>
<? foreach ($blocks as $block):
    switch ($block['position']) {
                    case 'left': $mod = "Левый блок";
                        break;
                    case 'right': $mod = "Правый блок";
                        break;
                    case 'top': $mod = "Верхний блок";
                        break;
                    case 'top_left': $mod = "Верхний левый блок";
                        break;
                    case 'top_right': $mod = "Верхний правый блок";
                        break;
                    case 'down_left': $mod = "Нижний левый блок";
                        break;
                    case 'down_right': $mod = "Нижний правый блок";
                        break;
                    case 'down': $mod = "Нижний блок";
                        break;
                }?>
    <tr>
        <td><?=$block['id'];?></td>
        <td><? if ($block['module'] == "0"): ?>Система<? else: ?><?=$ycms->get_name_module_page($block['module']); ?><? endif; ?></td>
        <td><?=$block['file']; ?></td>
        <td align="center"><? if ($block['on_off'] == "1"): ?><img src="<?=$setting['site']; ?>img/ico/power_on.png" border="0" alt="Включен" title="Включен"><? else: ?><img src="<?=$setting['site']; ?>img/ico/power_off.png" border="0" alt="Выключен" title="Выключен"><? endif; ?></td>
        <td><? if ($block['view'] == "0"): ?>На всех страницах<? else: ?><?=$ycms->get_name_module_page($block['view']); ?><? endif; ?></td>
        <td><?=$mod ?></td>
        <td><?=$block['nomer']; ?></td>
<? foreach ($lang as $langu): ?>
        <td><? $wer = "where id_id = '" . $block['id'] . "' and id_lang = '" . $langu['id'] . "'";
        $block_lang = $ycms->sql_query("block_lang", $wer);
        if (!(empty($block_lang))){
            foreach ($block_lang as $block_langu){echo $block_langu['name'];}
        }
        else{?><img src="<?=$setting['site'] ?>img/ico/cancel.png" width="16" height="16" alt="Отсутствует" title="Отсутствует "><? }?></td>
<? endforeach; ?>
        <td><a href="<?=$setting['site'] ?>admin/access"><?=$block['access'] ?></a></td>
        <td align="center"><a href ="<?=$setting['site'] ?>admin/block/<?=$block['id'] ?>"> <img src="<?=$setting['site'] ?>img/ico/pencil3.png" width="16" height="16" alt="Редактировать" title="Редактировать "></a></td>
        <td align="center"><a href ="<?=$setting['site'] ?>admin/block_del/<?=$block['id'] ?>"> <img src="<?=$setting['site'] ?>img/ico/deletered.png" width="16" height="16" alt="Удалить" title="Удалить "></a></td>
    </tr>
<? endforeach; ?>
</table>
<div style="height:50px;margin-top:5px;" >
    <ul class='nNav' style="width:50px;padding:0px;margin:0px;">
        <li style="margin:0px 3px 0px 0px;">
            <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
            <span class="ncc"><a href="<?=$setting['site'] ?>admin/block_add/">Добавить</a></span>
            <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
        </li>
    </ul>
</div>

