<table class="text">
    <thead>
        <tr>
            <td>Тип пользователя</td>
            <td>Ид пользователя</td>
            <td>Просмотр</td>
            <td>Редактирование</td>
            <td>Удаление</td>
             <td>Добавление</td>
        </tr>
    </thead>
<? if ($access_data==true):?>
<?  foreach ($access_data as $access):?>
    <tr>
       <td><input type="text" name="access_id_tip_user" value="<?=$access['access_id_tip_user']?>"></td>
       <td><input type="text" name="access_id_id_user" value="<?=$access['access_id_id_user']?>"></td>
       <td><input type="text" name="access_view" value="<?=$access['access_view']?>"></td>
       <td><input type="text" name="access_view" value="<?=$access['access_edit']?>"></td>
       <td><input type="text" name="access_view" value="<?=$access['access_del']?>"></td>
       <td><input type="text" name="access_view" value="<?=$access['access_add']?>"></td>
    </tr>
<?  endforeach;?>
<?endif;?>
</table>
