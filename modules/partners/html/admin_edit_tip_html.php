<form action="<?=$setting['site']?>part/edit_tip/<?=$part_tip_data['id_part_tip'];?>" method="POST" name="add" >
    <? foreach ($lang as $langu): ?>
    <?$lang_data = $ycms->sql_query_one("m_part_tip_lang", " where id_part_tip = '".$part_tip_data['id_part_tip']."' and id_lang = '".$langu['id']."'");?>
<? if($lang_data==false){$add="add_";}else{$add="";}?>
    <div id="tabss<?=$langu['id'] ?>">
        <ul><li><a href="#tabs<?=$langu['id'] ?>">Текст для "<?=$langu['name_lang'] ?>"</a></li></ul>
        <div id="tabs<?=$langu['id'] ?>">
            Название типа
            <input type="text" name="<?=$add?>part_tip_name<?=$langu['id'] ?>" value="<?=$lang_data['part_tip_name']?>">
           Текст
           <textarea name="<?=$add?>part_tip_text<?=$langu['id'] ?>" rows="4" cols="20" class="ckeditor" id="editor<?=$langu['id'] ?>"><?=$lang_data['part_tip_text']?></textarea>
            <script type="text/javascript">
                var ckeditor<?=$langu['id'] ?> = CKEDITOR.replace('editor<?=$langu['id'] ?>');
                AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor<?=$langu['id'] ?>});
            </script>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){$("#tabss<?=$langu['id'] ?>").tabs();});
    </script>
    <p></p>
<? endforeach; ?>
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