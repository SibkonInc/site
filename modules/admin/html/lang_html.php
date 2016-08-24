<h2 align="center"><?=$setting['admin']
?></h2>
<h4 align="center">Управление языками.<span class="formInfo">
                            <a href="<?=$setting['site'] ?>help.php?id=lang_info&amp;width=375" class="jTip" id="name_site" name="Настройки языков">
                        <img src="<?=$setting['site'] ?>img/ico/help.png" border="0" alt="Информация">
                    </a>
                </span></h4>
<table class="text">
    <thead>
        <tr>
            <td>
                ИД
            </td>
            <td>
                Имя
            </td>
            <td>
                Артикл
            </td>
            <td>
                Картинка
            </td>
            <td>
                Редактировать
            </td>
            <td>
                Удалить
            </td>
        </tr>
    </thead>
    <? foreach ($lang as $langu): ?>
        <tr>
            <td>
                <?=$langu['id'] ?>
        </td>
        <td>
            <?=$langu['name_lang'] ?>
        </td>
        <td>
            <?=$langu['article'] ?>
        </td>
        <td align="center">
            <img src="<?=$setting['site'] ?><?=$langu['img'] ?>" alt="<?=$langu['article'] ?>">
        </td>
        <td align="center">
            <a href ="<?=$setting['site'] ?>admin/lang_edit/<?=$langu['id'] ?>"> <img src="<?=$setting['site'] ?>img/ico/pencil3.png" width="16" height="16" alt="Редактировать" title="Редактировать <?=$langu['name_lang'] ?>"></a>
        </td>
        <td align="center">
            <a href ="<?=$setting['site'] ?>admin/lang_del/<?=$langu['id'] ?>"> <img src="<?=$setting['site'] ?>img/ico/deletered.png" width="16" height="16" alt="Удалить" title="Удалить <?=$langu['name_lang'] ?>"></a>
        </td>
    </tr>
    <? endforeach; ?>
        </table>
        <div style="height:50px;margin-top:5px;" >
            <ul class='nNav' style="width:50px;padding:0px;margin:0px;"><li style="margin:0px 3px 0px 0px;">
                    <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
                    <span class="ncc"><a href="<?=$setting['site'] ?>admin/lang_add/">Добавить</a></span>
            <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
        </li></ul>
</div>