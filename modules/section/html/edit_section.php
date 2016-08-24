<h4 align="center">Редактирование секции</h4>
<form action="<?=$setting['site']?>sect/edd/<?=$data_section['section_id'];?>" method="POST" name="add">
         Принадлежность к разделу
            <select name="section_id_id">
                <option value="0">Нет принадлежности</option>
                <?  foreach ($section_name as $section):?>
                <option value="<?=$section['id_id'];?>" <?if ($data_section['section_id_id']==$section['id_id']):?> selected<?endif;?>><?=$section['name'];?></option>
                <?  endforeach;?>
            </select>
<br>Порядковый номер в списке:<input type="text" name="section_nomer" value="<?=$data_section['section_nomer']?>" />
<? foreach ($lang as $langu): ?>
<?$lang_data = $ycms->sql_query_one("m_section_text", "where id_id = '".$data_section['section_id']."' and id_lang = '".$langu['id']."'");?>
 <? if ($lang_data['id_lang'] == $langu['id']): ?>
         <br>Название на <?=$langu['name_lang']; ?>
<input type="text" name="name<?=$langu['id']; ?>" value="<?=$lang_data['name']?>">
Текст на <?=$langu['name_lang']; ?>
<textarea name="text<?=$langu['id']; ?>" rows="4" cols="20" class="ckeditor" id="editor<?=$langu['id']; ?>"><?=$lang_data['text']?></textarea>
<?else:?>
<br>введите Название на <?=$langu['name_lang']; ?>
<input type="text" name="addname<?=$langu['id']; ?>" value="<?=$lang_data['name']?>">
Текст на <?=$langu['name_lang']; ?>
<textarea name="addtext<?=$langu['id']; ?>" rows="4" cols="20" class="ckeditor" id="editor<?=$langu['id']; ?>"><?=$lang_data['text']?></textarea>
<?endif;?>
<script type="text/javascript">
var ckeditor<?=$langu['id'];?> = CKEDITOR.replace('editor<?=$langu['id'];?>');
AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor<?=$langu['id'];?>});
</script>
<? endforeach; ?>
<br>Опубликовано:<select name="online">
    <option value="0">Нет</option>
    <option value="1">Да</option>
</select>
<br>Место расположения в меню (относится только к главным в уровне)
<br>Позиция:
<br>набор правил доступа
<br>номер по порядку
<div style="height:50px;margin-top:5px;" align="right">
        <ul class='nNav' style="width:150px;padding:0px;margin:0px;">
            <li style="margin:0px 3px 0px 0px;">
                <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
                <span class="ncc"><a href="javascript:document.add.submit()">Изменить</a></span>
                <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
            </li>
        </ul>
    </div>
</form>
