<form action="<?=$setting['site']?>sect/add/" method="POST" name="add">
<h4 align="center">Форма добавления новой секции <?if (!($id_sect_post=="0")):?>в раздел<?endif;?>
         <select name="section_id_id">
                <option value="0">Нет принадлежности</option>
                <?  foreach ($section_name as $section):?>
                <option value="<?=$section['id_id'];?>" <?if ($id_sect_post==$section['id_id']):?> selected<?endif;?>><?=$section['name'];?></option>
                <?  endforeach;?>
            </select></h4>
<br>Порядковый номер в списке:<input type="text" name="section_nomer" value="" />
<? foreach ($lang as $langu): ?>
<br>Название на <?=$langu['name_lang']; ?>
<input type="text" name="name<?=$langu['id']; ?>" value="">
Текст на <?=$langu['name_lang']; ?>
<textarea name="text<?=$langu['id']; ?>" rows="4" cols="20" class="ckeditor" id="editor<?=$langu['id']; ?>"></textarea>
<script type="text/javascript">
var ckeditor1 = CKEDITOR.replace('editor<?=$langu['id'];?>');
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
                <span class="ncc"><a href="javascript:document.add.submit()">Добавить</a></span>
                <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
            </li>
        </ul>
    </div>
</form>
