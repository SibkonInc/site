<h2 align="center">Добавление награды</h2>
<form action="<?=$setting['site']?>awards/add_post" method="POST" name="add" enctype="multipart/form-data">
    <div id="tabs">
        <ul><li><a href="#tabs-1">Основные данные</a></li></ul>
        <div id="tabs-1">
            Фотография награды (название файла в папке img/awards):
            <input type="file" name="awards_logo" value="" />
            Тип <select name="awards_tip">
<?  foreach ($awards_tip_data as $awards_tip):?>
                <option value="<?=$awards_tip['id_awards_tip']?>"><?=$awards_tip['awards_tip_name']?></option>
<?  endforeach;?>
            </select>
            <br>
            Номер по порядку:<input type="text" name="awards_nomer" value="">
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
            <input type="text" name="awards_name<?=$langu['id'] ?>" value="">
            Краткий текст, если нет страницы
            <textarea name="anons_awards<?=$langu['id'] ?>" rows="4" cols="20"></textarea>
           Текст собственной страницы
            <textarea name="text_awards<?=$langu['id'] ?>" rows="4" cols="20" class="ckeditor" id="editor<?=$langu['id'] ?>"></textarea>
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