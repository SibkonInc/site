<h2 align="center"><?=$setting['admin']?></h2>
<h4 align="center">Редактирование Блока.</h4>
<form action="<?=$setting['site'];?>admin/block_edit_post/<?=$block_info['id']?>" method="POST" name="add">
<div id="tabs">
        <ul><li><a href="#tabs-1">Основные данные</a></li></ul>
    <br>Принадлежит: <select name="module">
    <option value="0" <? if ($block_info['module'] == "0"): ?> selected<? endif; ?>>Система</option>
<? foreach ($modules as $module): ?>
    <option value="<?=$module['id'] ?>" <? if ($block_info['module'] == $module['id']): ?> selected<? endif; ?>><?=$module['name'] ?></option>
<? endforeach; ?>
</select>
<br>Файл блока: <select name="file">
    <option value="0">Не используется</option>
<?foreach ($modules as $module) {if ($handlem = opendir('modules/' . $module['file'] . '/block/')) {while (false !== ($filem = readdir($handlem))) {if ($filem != "." && $filem != "..") {?>
    <option value="<?=$filem ?>" <? if ($filem == $block_info['file']): ?> selected<? endif; ?>><?=$module['url'] ?>: <?=$filem; ?></option>
<?}}closedir($handlem);}}if ($handle = opendir('block/')) {while (false !== ($file = readdir($handle))) {if ($file != "." && $file != "..") {?>
    <option value="<?=$file ?>" <? if ($file == $block_info['file']): ?> selected<? endif; ?>>Система: <?=$file; ?></option>
<?}}closedir($handle);}?>
</select>
<br>Показать шапку:
<select name="top">
    <option value="0" <?if($block_info['top']=="0"):?> selected<?endif;?>>Не показывать</option>
    <option value="1" <?if($block_info['top']=="1"):?> selected<?endif;?>>Показывать</option>
</select>
<br>Включение
<select name="on_off">
    <option value="1" <? if ($block_info['on_off'] == "1"): ?> selected<? endif; ?>>Включен</option>
    <option value="0" <? if ($block_info['on_off'] == "0"): ?> selected<? endif; ?>>Выключен</option>
</select>
<br>Месторасположение
<select name="view">
    <option value="0" <? if ($block_info['view'] == "0"): ?> selected<? endif; ?>>Всегда</option>
<? foreach ($modules as $module): ?>
    <option value="<?=$module['id'] ?>" <? if ($block_info['view'] == $module['id']): ?> selected<? endif; ?>><?=$module['name'] ?></option>
<? endforeach; ?>
</select>
<br>Позиция
<select name="position">
    <option value="left"  <? if ($block_info['position'] == "left"): ?> selected<? endif; ?>>Левый блок</option>
    <option value="right" <? if ($block_info['position'] == "right"): ?> selected<? endif; ?>>Правый блок</option>
    <option value="top" <? if ($block_info['position'] == "top"): ?> selected<? endif; ?>>Верхний блок</option>
    <option value="top_left" <? if ($block_info['position'] == "top_left"): ?> selected<? endif; ?>>Верхний левый блок</option>
    <option value="top_right" <? if ($block_info['position'] == "top_right"): ?> selected<? endif; ?>>Верхний правый блок</option>
    <option value="down_left" <? if ($block_info['position'] == "down_left"): ?> selected<? endif; ?>>Нижний левый блок</option>
    <option value="down_right" <? if ($block_info['position'] == "down_right"): ?> selected<? endif; ?>>Нижний правый блок</option>
    <option value="down" <? if ($block_info['position'] == "down"): ?> selected<? endif; ?>>Нижний блок</option>
</select>
<br>Номер по порядку<input type="text" name="nomer" value="<?=$block_info['nomer'] ?>">
<br>Набор правил<input type="text" name="access" value="<?=$block_info['access'] ?>">
</div>
<script type="text/javascript">$(function(){$("#tabs").tabs();});</script>

<? foreach ($lang as $langu): ?>
<?
        $lang_b = $ycms->sql_query_one("block_lang", "
            where id_lang ='" . $langu['id'] . "' and
                id_id='" . $block_info['id'] . "'");
   
        if ($lang_b['id_lang'] == $langu['id']) {
           $add = "";
        } else {
             $add = "add_";
        }
?>
<div id="tabss<?=$langu['id'] ?>">
    <ul><li><a href="#tabs<?=$langu['id'] ?>">Настройки для "<?=$langu['name_lang'] ?>"</a></li></ul>
    Название для <?=$langu['name_lang']; ?>
    <input type="text" name="<?=$add;?>name<?=$langu['id']; ?>" value="<?=$lang_b['name'] ?>">
    Текст для <?=$langu['name_lang']; ?>
    <textarea name="<?=$add;?>text<?=$langu['id']; ?>" rows="4" cols="20" class="ckeditor" id="editor<?=$langu['id'];?>"><?=$lang_b['text'] ?></textarea>
        <script type="text/javascript">
            $(function(){$("#tabss<?=$langu['id'] ?>").tabs();});
            var ckeditor1 = CKEDITOR.replace('editor<?=$langu['id'];?>');
            AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor<?=$langu['id'];?>});
        </script>
    </div>
<? endforeach; ?>
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