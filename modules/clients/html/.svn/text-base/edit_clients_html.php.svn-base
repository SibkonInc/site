<h2 align="center">Редактирование парнера</h2>
<form action="<?=$setting['site']?>clients/edit_post/<?=$clients_data['clients_id'];?>" method="POST" name="add" enctype="multipart/form-data">
    <div id="tabs">
        <ul><li><a href="#tabs-1">Основные данные</a></li></ul>
        <div id="tabs-1">
            Логотип парнера (название файла в папке img/clientsners):
            <input type="text" name="clients_logo" value="<?=$clients_data['clients_logo'];?>">
             или заменить другим
            <input type="file" name="clients_log"><br>
            Тип <select name="clients_tip">
<?  foreach ($clients_tip_data as $clients_tip):?>
                <option value="<?=$clients_tip['id_clients_tip']?>" <?if ($clients_tip['id_clients_tip']==$clients_data['clients_tip']):?> selected <?endif;?>><?=$clients_tip['clients_tip_name']?></option>
<?  endforeach;?>
            </select>
            <br>
            Номер по порядку:<input type="text" name="clients_nomer" value="<?=$clients_data['clients_nomer'];?>">
        </div>
    </div>
    <script type="text/javascript">
        $(function(){$("#tabs").tabs();});
    </script>
    <p></p>
<? foreach ($lang as $langu): ?>
<?$lang_data = $ycms->sql_query_one("m_clients_text", " where clients_id = '".$clients_data['clients_id']."' and id_lang = '".$langu['id']."'");?>
<? if($lang_data==false){$add="add_";}else{$add="";}?>




    <div id="tabss<?=$langu['id'] ?>">
        <ul><li><a href="#tabs<?=$langu['id'] ?>">Текст для "<?=$langu['name_lang'] ?>"</a></li></ul>
        <div id="tabs<?=$langu['id'] ?>">
            Название
            <input type="text" name="<?=$add;?>clients_name<?=$langu['id'] ?>" value="<?=$lang_data['clients_name'];?>">
            Краткий текст, если нет страницы
            <textarea name="<?=$add;?>anons_clients<?=$langu['id'] ?>" rows="4" cols="20"><?=$lang_data['anons_clients'];?></textarea>
            Адрес сайта (полностью, с http://)
            <input type="text" name="<?=$add;?>adress_clients<?=$langu['id'] ?>" value="<?=$lang_data['adress_clients'];?>">
           Текст собственной страницы
            <textarea name="<?=$add;?>text_clients<?=$langu['id'] ?>" rows="4" cols="20" class="ckeditor" id="editor<?=$langu['id'] ?>"><?=$lang_data['text_clients'];?></textarea>
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