<html>
    <head>
        
        <link type="text/css" rel="stylesheet" href="<?=$setting['site'];
?>adm/admin.css" media="all">
        <script type="text/javascript" src="<?=$setting['site'];
?>js/jquery.js"></script>
        <script type="text/javascript" src="<?=$setting['site'];
?>js/jquery.cookie.js"></script>
        <link type="text/css" rel="stylesheet" href="<?=$setting['site'];
?>js/jgrowl.css" media="all">
        <script type="text/javascript" src="<?=$setting['site'];
?>js/jgrowl.js"></script>
        <script type="text/javascript" src="<?=$setting['site'];
?>adm/js/jquery-ui.js"></script>
        <link type="text/css" rel="stylesheet" href="<?=$setting['site'];
?>adm/js/jquery-ui.css" media="all">
        <title><?=$setting['name'];
?> | <?=$data['page'];
?></title>
<? if (isset($meta)): ?><?=$meta; ?>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
<? endif; ?>
    </head>
    <body>
        <div class="left">
<?
$html = $this->load("html");
$mod = $this->sql_query("module", "join module_lang on module.id = module_lang.id_id where module_lang.id_lang = '" . $setting['id_lang'] . "' ");
$bl = $this->sql_query("block", "join block_lang on block.id = block_lang.id_id where block_lang.id_lang = '" . $setting['id_lang'] . "' ");
?>
<?=$html->ahref("", "на сайт"); ?>
<br><?=$html->ahref("admin/lang", "Языки"); ?>
<br><?=$html->ahref("admin/lang_add", "Добавить"); ?>
<br><?=$html->ahref("admin/site", "Сайт"); ?>
<br><?=$html->ahref("admin/access", "Доступ"); ?>
<br><?=$html->ahref("admin/menu", "Меню"); ?>
<br><?=$html->ahref("admin/block", "Блоки"); ?>
<? foreach ($bl as $block): ?>
<br><?=$html->ahref("admin/block/" . $block['id'], $block['name']); ?>
<? endforeach; ?>
<br><?=$html->ahref("admin/module", "Модули"); ?>
<? foreach ($mod as $modul): ?>
<br><?=$html->ahref("admin/module/" . $modul['id'], $modul['name']); ?>
<? endforeach; ?>
        </div>
                <div class="right">

               







 
      