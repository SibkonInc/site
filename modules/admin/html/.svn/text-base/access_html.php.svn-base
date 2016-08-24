<h2 align="center"><?=$setting['admin']?></h2>
<h4 align="center">Управление Доступом.<span class="formInfo">
        <a href="<?=$setting['site']
?>help.php?id=lang_info&amp;width=375" class="jTip" id="name_site" name="Настройки языков">
            <img src="<?=$setting['site']
?>img/ico/help.png" border="0" alt="Информация">
        </a>
    </span></h4>
<table class="text">
    <thead>
        <tr>
            <td>id</td>
            <td>name</td>
            <td>tip_user</td>
            <td>id_user</td>
            <td>view</td>
            <td>edit</td>
            <td>del</td>
            <td>add</td>
        </tr>
    </thead>
    <? foreach ($acesss as $access): ?>
    <?
 if ($access['access_id_tip_user'] == "0") {
                   $access_id_tip_user = "Все";
               } else {
                   $access_id_tip_user = $ycms->get_name_tip_user($access['access_id_tip_user']);
               }
               if ($access['access_id_id_user'] == "0") {
                   $access_id_id_user = "Все";
               } else {
                   $access_id_id_user = $ycms->get_name_user($access['access_id_id_user']);
               }
    ?>
    <tr>
        <td><?=$access['access_id'];?></td>
         <td><?=$access['access_name'];?></td>
        <td><?=$access_id_tip_user;?></td>
        <td><?=$access_id_id_user;?></td>
        <td>
            <? if ($access['access_view'] == "1"): ?>
                <img src="<?=$setting['site']; ?>img/ico/yes.png" width="16" height="16" alt="yes"/>
            <? else: ?>
                <img src="<?=$setting['site']; ?>img/ico/no.png" width="16" height="16" alt="yes"/>
            <? endif; ?>
        </td>
        <td>
            <? if ($access['access_edit'] == "1"): ?>
                <img src="<?=$setting['site']; ?>img/ico/yes.png" width="16" height="16" alt="yes"/>
            <? else: ?>
                    <img src="<?=$setting['site']; ?>img/ico/no.png" width="16" height="16" alt="yes"/>
            <? endif; ?>
        </td>
        <td>
            <? if ($access['access_del'] == "1"): ?>
                <img src="<?=$setting['site']; ?>img/ico/yes.png" width="16" height="16" alt="yes"/>
            <? else: ?>
                    <img src="<?=$setting['site']; ?>img/ico/no.png" width="16" height="16" alt="yes"/>
            <? endif; ?>
        </td>
        <td>
            <? if ($access['access_add'] == "1"): ?>
                <img src="<?=$setting['site']; ?>img/ico/yes.png" width="16" height="16" alt="yes"/>
            <? else: ?>
                    <img src="<?=$setting['site']; ?>img/ico/no.png" width="16" height="16" alt="yes"/>
            <? endif; ?>
        </td>
    </tr>
    <? endforeach; ?>
</table>