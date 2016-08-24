<h2>Добавление меню</h2>
<form action="<?=$setting['site'] ?>admin/menu_edit/<?=$menu_data['id']?>" method="POST" name="add">
Адрес <?=$setting['site']?><input type="text" name="adress" value="<?=$menu_data['adress']?>" /><br>
Подчиняется:
<select name="id_id">
    <option value="0" <?if($menu_data['id_id']=="0"):?> selected<?endif;?>>Никому</option>
<?if($id_id_data):foreach ($id_id_data as $id_id):?>
    <option value="<?=$id_id['id']?>"<?if($menu_data['id_id']==$id_id['id']):?> selected<?endif;?>><?=$id_id['menu_name']?></option>
<?  endforeach;endif;?>
</select>
<br>Позиция:
<select name="position">
    <option value="top" <?if($menu_data['position']=="top"):?> selected<?endif;?>>Верх</option>
    <option value="left" <?if($menu_data['position']=="left"):?> selected<?endif;?>>Лево</option>
    <option value="right" <?if($menu_data['position']=="right"):?> selected<?endif;?>>Право</option>
</select>
<br>Доступ:
<select name="access">
<?if($access_data):foreach ($access_data as $access):?>
    <option value="<?=$access['access_id_group']?>"<?if($menu_data['access']==$access['access_id_group']):?> selected<?endif;?>><?=$access['access_name_group']?></option>
<?  endforeach;endif;?>
</select>
<br>Номер по порядку:<input type="text" name="nomer" value="<?=$menu_data['adress']?>" />
<?if($lang):foreach ($lang as $lang_data):?>
<br>Название для <?=$lang_data['name_lang']?>:
<?$data_lang=$ycms->sql_query_one("menu_lang","where menu_id_id = '".$menu_data['id']."' and menu_id_lang='".$lang_data['id']."'");?>
<?if ($data_lang['menu_id_lang']==$lang_data['id']){$add="";}else{$add="add_";}?>
<input type="text" name="<?=$add;?>menu_name<?=$lang_data['id']?>" value="<?=$data_lang['menu_name']?>" />
<?  endforeach;endif;?>
<div style="height:50px;margin-top:5px;" align="right">
        <ul class='nNav' style="width:50px;padding:0px;margin:0px;">
            <li style="margin:0px 3px 0px 0px;">
                <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
                <span class="ncc"><a href="javascript:document.add.submit()">Изменить</a></span>
                <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
            </li>
        </ul>
    </div>
</form>
