<h2 align="center">Редактирование награды</h2>
<form action="<?=$setting['site']?>awards/edit_post/<?=$awards_data['awards_id'];?>" method="POST" name="add" enctype="multipart/form-data">
    <div id="tabs">
        <ul><li><a href="#tabs-1">Основные данные</a></li></ul>
        <div id="tabs-1">
            Изображение (название файла в папке img/awards):
            <input type="text" name="awards_logo" value="<?=$awards_data['awards_logo'];?>">
             или заменить другим
            <input type="file" name="awards_log"><br>
            Тип <select name="awards_tip">
<?  foreach ($awards_tip_data as $awards_tip):?>
                <option value="<?=$awards_tip['id_awards_tip']?>" <?if ($awards_tip['id_awards_tip']==$awards_data['awards_tip']):?> selected <?endif;?>><?=$awards_tip['awards_tip_name']?></option>
<?  endforeach;?>
            </select>
            <br>
            Номер по порядку:<input type="text" name="awards_nomer" value="<?=$awards_data['awards_nomer'];?>">
        </div>
    </div>
    <script type="text/javascript">
        $(function(){$("#tabs").tabs();});
    </script>
    <p></p>
<? foreach ($lang as $langu): ?>
<?$lang_data = $ycms->sql_query_one("m_awards_text", " where awards_id = '".$awards_data['awards_id']."' and id_lang = '".$langu['id']."'");?>
<? if($lang_data==false){$add="add_";}else{$add="";}?>




    <div id="tabss<?=$langu['id'] ?>">
        <ul><li><a href="#tabs<?=$langu['id'] ?>">Текст для "<?=$langu['name_lang'] ?>"</a></li></ul>
        <div id="tabs<?=$langu['id'] ?>">
            Название
            <input type="text" name="<?=$add;?>awards_name<?=$langu['id'] ?>" value="<?=$lang_data['awards_name'];?>">
            Краткий текст, если нет страницы
            <textarea name="<?=$add;?>anons_awards<?=$langu['id'] ?>" rows="4" cols="20"><?=$lang_data['anons_awards'];?></textarea>
             Текст собственной страницы
            <textarea name="<?=$add;?>text_awards<?=$langu['id'] ?>" rows="4" cols="20" class="ckeditor" id="editor<?=$langu['id'] ?>"><?=$lang_data['text_awards'];?></textarea>
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