<h2>Добавление меню</h2>
<form action="<?=$setting['site'] ?>admin/menu_add/" method="POST" name="add">
Адрес <?=$setting['site']?><input type="text" name="adress" value="" /><br>
Подчиняется:
<select name="id_id">
    <option value="0">Никому</option>
<?if($id_id_data):foreach ($id_id_data as $id_id):?>
    <option value="<?=$id_id['id']?>"><?=$id_id['menu_name']?></option>
<?  endforeach;endif;?>
</select>
<br>Позиция:
<select name="position">
    <option value="top">Верх</option>
    <option value="left">Лево</option>
    <option value="right">Право</option>
</select>
<br>Доступ:
<select name="access">
<?if($access_data):foreach ($access_data as $access):?>
    <option value="<?=$access['access_id_group']?>"><?=$access['access_name_group']?></option>
<?  endforeach;endif;?>
</select>
<br>Номер по порядку:<input type="text" name="nomer" value="" />
<?if($lang):foreach ($lang as $lang_data):?>
<br>Название для <?=$lang_data['name_lang']?>:<input type="text" name="add_menu_name<?=$lang_data['id']?>" value="" />
<?  endforeach;endif;?>
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
