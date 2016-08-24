<h2 align="center">Редактирование типов</h2>
<table class="text">
    <thead>
        <tr>
            <td>Ид</td>
            <? foreach ($lang as $langu): ?>
                <td><?=$langu['name_lang']; ?></td>
            <? endforeach; ?>
                <td></td>
                <td></td>
        </tr>
    </thead>
    <?if ($part_tip_data==true): foreach ($part_tip_data as $part_tip): ?>
                <tr>
                    <td><?=$part_tip['id_part_tip']; ?></td>
        <? foreach ($lang as $langu): ?>
            <td><?
            $wer = "where id_part_tip = '" . $part_tip['id_part_tip'] . "' and id_lang = '" . $langu['id'] . "'";
            $block_lang = $ycms->sql_query("m_part_tip_lang", $wer);
            if (!(empty($block_lang))) {
                foreach ($block_lang as $block_langu) {
                    echo $block_langu['part_tip_name'];
                }
            } else {
 ?>
                    <img src="<?=$setting['site']
        ?>img/ico/cancel.png" width="16" height="16" alt="Отсутствует" title="Отсутствует "><? } ?></td>
<? endforeach; ?>
        <td align="center"><a href ="<?=$setting['site'] ?>part/edit_tip/<?=$part_tip['id_part_tip'] ?>"> <img src="<?=$setting['site'] ?>img/ico/pencil3.png" width="16" height="16" alt="Редактировать" title="Редактировать "></a></td>
        <td align="center"><a href ="<?=$setting['site'] ?>part/del_tip/<?=$part_tip['id_part_tip'] ?>"> <img src="<?=$setting['site'] ?>img/ico/deletered.png" width="16" height="16" alt="Удалить" title="Удалить "></a></td>
    </tr>
<? endforeach; endif;?>
</table>
<div style="height:50px;margin-top:5px;" >
    <ul class='nNav' style="width:50px;padding:0px;margin:0px;">
        <li style="margin:0px 3px 0px 0px;">
            <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
            <span class="ncc"><a href="<?=$setting['site'] ?>part/add_tip/">Добавить</a></span>
            <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
        </li>
    </ul>
</div>








