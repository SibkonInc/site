<? if (($access['access_edit'] == "1") or ($access['access_del'] == "1") or ($access['access_add'] == "1")): ?>
    <div style="height: 25px;margin-top:5px;" align="right">
    <? if (isset($access['access_add']) and ($access['access_add'] == "1")): ?>
        <a href ="<?=$setting['site'] ?>clients/add_form">
        <img src="<?=$setting['site'] ?>img/ico/add.png" width="16" height="16" alt="add"/>Добавить</a>
    <? endif; ?>
    <? if (isset($access['access_edit']) and ($access['access_edit'] == "1")): ?>
        <a href ="<?=$setting['site'] ?>clients/edit/<?=$clients_data['clients_id']; ?>">
        <img src="<?=$setting['site'] ?>img/ico/pencil3.png" width="16" height="16" alt="add"/>Редактировать</a>
    <? endif; ?>
    <? if (isset($access['access_del']) and ($access['access_del'] == "1")): ?>
        <a href ="<?=$setting['site'] ?>clients/del/<?=$clients_data['clients_id']; ?>/?height=125&width=250&modal=true" class="thickbox">
        <img src="<?=$setting['site'] ?>img/ico/deletered.png" width="16" height="16" alt="add"/>Удалить</a>
    <? endif; ?>
       <? if (isset($access['access_admin']) and ($access['access_admin'] == "1")): ?>
         | <a href ="<?=$setting['site'] ?>clients/admin">Управление модулем</a>
    <? endif; ?>
</div>
<? endif; ?>
<? if ($message == true): ?>
<? foreach ($message as $key => $value): ?>
<script type="text/javascript">$.jGrowl('<?=$value; ?>');</script>
<? endforeach; ?>
<? endif; ?>
<?=$clients_data['text_clients']?>
