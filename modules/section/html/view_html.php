<? if (($access['access_edit'] == "1") or ($access['access_del'] == "1") or ($access['access_add'] == "1")): ?>
    <div style="height: 25px;margin-top:5px;" align="right">
    <? if (isset($access['access_add']) and ($access['access_add'] == "1")): ?>
        <a href ="<?=$setting['site'] ?>sect/add_form/<?=$section_data['section_id']; ?>">
        <img src="<?=$setting['site'] ?>img/ico/add.png" width="16" height="16" alt="add"/>Добавить в этот раздел</a>
    <? endif; ?>
    <? if (isset($access['access_edit']) and ($access['access_edit'] == "1")): ?>
        <a href ="<?=$setting['site'] ?>sect/edd/<?=$section_data['section_id']; ?>">
            <img src="<?=$setting['site'] ?>img/ico/pencil3.png" width="16" height="16" alt="add"/>Редактировать раздел</a>
    <? endif; ?>
    <? if (isset($access['access_del']) and ($access['access_del'] == "1")): ?>
        <a href ="<?=$setting['site'] ?>sect/del/<?=$section_data['section_id']; ?>/?height=125&width=250&modal=true" class="thickbox">
            <img src="<?=$setting['site'] ?>img/ico/deletered.png" width="16" height="16" alt="add"/>Удалить раздел</a>
    <? endif; ?>
    </div>
<? endif; ?>
<? include 'section_html.php'; ?>
<h2><?=$section_data['name']; ?></h2>
<?// include 'section_sect.php'; ?>
<div align="right" class="also">
<?if (isset($text_lang)):?>
<?=$setting['read']?>:
<?  foreach ($text_lang as $men_lang):?>
<a href ="<?=$setting['site'] ?>sistems/language/<?=$men_lang['id'] ?>"><img src="<?=$setting['site'] ?><?=$men_lang['img'] ?>" alt="<?=$men_lang['article'] ?>" title ="<?=$men_lang['name_lang'] ?>"></a>
<?  endforeach;?>
<?endif;?>
</div>
<?if ($message==true):?>
<?    foreach ($message as $key => $value):?>
<script type="text/javascript">
//<![CDATA[
$.jGrowl('<?=$value;?>');
//]]>
</script>
<? endforeach;?>
<?endif;?>
<?=$section_data['text']; ?>   