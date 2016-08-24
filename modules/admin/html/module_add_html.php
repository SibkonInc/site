<h4 align="center">Добавление Модуля</h4>
<form action="<?=$setting['site'];?>admin/module_add" method="POST" name="add">
<br>Адрес вызова модуля:<input type="text" name="url" value="">
<br>Папка модуля<select name="file">
<?if ($handle = opendir('modules/')) {while (false !== ($file = readdir($handle))) {if ($file != "." && $file != "..") {?>
<option value="<?=$file?>"><?=$file; ?></option>
<?}}closedir($handle);}?>
</select>
<br>Включение<select name="on_off">
                    <option value="1">Включен</option>
                    <option value="0">Выключен</option>
                </select>
<br>Набор правил доступа:<select name="access">
<?if($access_data):foreach ($access_data as $access):?>
    <option value="<?=$access['access_id_group']?>"><?=$access['access_name_group']?></option>
<?  endforeach;endif;?>
</select>
<br>Идентификатор:<input type="text" name="identif" value="">
<? foreach ($lang as $langu): ?>
<br>Название для <?=$langu['name_lang']; ?>
                <input type="text" name="add_name<?=$langu['id'];?>" value="">
<? endforeach; ?>
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
