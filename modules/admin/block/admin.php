<?
$html = $this->load("html");
$mod = $this->sql_query("module", "join module_lang on module.id = module_lang.id_id where module_lang.id_lang = '" . $setting['id_lang'] . "' ");
$bl = $this->sql_query("block", "join block_lang on block.id = block_lang.id_id where block_lang.id_lang = '" . $setting['id_lang'] . "' ");
?>
<div id="accordion">
    <h4><?=$html->ahref("admin/lang", "Языки");?></h4>
    <div class="one"><?=$html->ahref("admin/lang", "Языки");?></div>
    <h3><?=$html->ahref("admin/site", "Сайт");
?></h3>
    <div><?=$html->ahref("admin/site", "Сайт"); ?></div>
    <h3><?=$html->ahref("admin/module", "Модули"); ?></h3>
    <div><?=$html->ahref("admin/module", "Модули"); ?><br>
        <? if (!(empty($mod))): ?>
        <ul>
        <? foreach ($mod as $modul): ?>
            <li><?=$html->ahref("admin/module/" . $modul['id'], $modul['name']); ?></li>
        <? endforeach; ?>
        </ul>
        <? endif; ?>
    </div>
    <h3><?=$html->ahref("admin/block", "Блоки"); ?></h3>
    <div><?=$html->ahref("admin/block", "Блоки"); ?><br>
            <? if (!(empty($bl))): ?>
        <ul>
            <? foreach ($bl as $block): ?>
            <li><?=$html->ahref("admin/block/" . $block['id'], $block['name']); ?></li>
            <? endforeach; ?>
        </ul>
            <? endif; ?>
    </div>
    <h3><?=$html->ahref("admin/access", "Доступ"); ?></h3>
    <div><?=$html->ahref("admin/access", "Доступ"); ?></div>
    <h3><?=$html->ahref("admin/menu", "Меню"); ?></h3>
    <div><?=$html->ahref("admin/menu", "Меню"); ?></div>
</div>
