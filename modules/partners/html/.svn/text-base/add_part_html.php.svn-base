<h2 align="center">Добавление парнера</h2>
<form action="<?=$setting['site']?>part/add_post" method="POST" name="add" enctype="multipart/form-data">
    <div id="tabs">
        <ul><li><a href="#tabs-1">Основные данные</a></li></ul>
        <div id="tabs-1">
            Логотип парнера (название файла в папке img/partners):
            <input type="file" name="part_logo" value="" />
            Тип <select name="part_tip">
<?  foreach ($part_tip_data as $part_tip):?>
                <option value="<?=$part_tip['id_part_tip']?>"><?=$part_tip['part_tip_name']?></option>
<?  endforeach;?>
            </select>
            <br>
            Номер по порядку:<input type="text" name="part_nomer" value="">
        </div>
    </div>
    <script type="text/javascript">
        $(function(){$("#tabs").tabs();});
    </script>
    <p></p>
<? foreach ($lang as $langu): ?>
    <div id="tabss<?=$langu['id'] ?>">
        <ul><li><a href="#tabs<?=$langu['id'] ?>">Текст для "<?=$langu['name_lang'] ?>"</a></li></ul>
        <div id="tabs<?=$langu['id'] ?>">
            Название
            <input type="text" name="part_name<?=$langu['id'] ?>" value="">
            Краткий текст, если нет страницы
            <textarea name="anons_part<?=$langu['id'] ?>" rows="4" cols="20"></textarea>
            Адрес сайта (полностью, с http://)
            <input type="text" name="adress_part<?=$langu['id'] ?>" value="">
           Текст собственной страницы
            <textarea name="text_part<?=$langu['id'] ?>" rows="4" cols="20" class="ckeditor" id="editor<?=$langu['id'] ?>"></textarea>
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
                <span class="ncc"><a href="javascript:document.add.submit()">Добавить</a></span>
                <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
            </li>
        </ul>
    </div>
</form>