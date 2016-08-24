<? if (($access['access_edit'] == "1") or ($access['access_del'] == "1") or ($access['access_add'] == "1")): ?>
    <div style="height: 25px;margin-top:5px;" align="right">
    <? if (isset($access['access_add']) and ($access['access_add'] == "1")): ?>
        <a href ="<?=$setting['site'] ?>news/add_form">
        <img src="<?=$setting['site'] ?>img/ico/add.png" width="16" height="16" alt="add"/>Добавить</a>
    <? endif; ?>
    <? if (isset($access['access_edit']) and ($access['access_edit'] == "1")): ?>
        <a href ="<?=$setting['site'] ?>news/edit/<?=$news_data['news_id']; ?>">
        <img src="<?=$setting['site'] ?>img/ico/pencil3.png" width="16" height="16" alt="add"/>Редактировать</a>
    <? endif; ?>
    <? if (isset($access['access_del']) and ($access['access_del'] == "1")): ?>
        <a href ="<?=$setting['site'] ?>news/del/<?=$news_data['news_id']; ?>/?height=125&width=250&modal=true" class="thickbox">
        <img src="<?=$setting['site'] ?>img/ico/deletered.png" width="16" height="16" alt="add"/>Удалить</a>
    <? endif; ?>
       <? if (isset($access['access_edit']) and ($access['access_edit'] == "1")): ?>
         | <a href ="<?=$setting['site'] ?>news/admin">Управление модулем</a>
    <? endif; ?>
</div>
<? endif; ?>
<? if ($message == true): ?>
<? foreach ($message as $key => $value): ?>
            <script type="text/javascript">
                //<![CDATA[
                $.jGrowl('<?=$value; ?>');
    //]]>
</script>
<? endforeach; ?>
<? endif; ?>
<? if ($news_data == true):?>
    <div class="text_block">
        <div class="news_name">
            <?=$news_data['news_name']; ?>
        </div>
        <div class="news_foter"></div>
        <div class="text_comment">
<?=$html->format_date($news_data['news_date_public'], "1"); ?> |
        <? if (isset($text_lang)): ?>
<?=$setting['read'] ?>:
    <? foreach ($text_lang as $men_lang): ?>
        <a href ="<?=$setting['site'] ?>sistems/language/<?=$men_lang['id'] ?>"><img src="<?=$setting['site'] ?><?=$men_lang['img'] ?>" alt="<?=$men_lang['article'] ?>" title ="<?=$men_lang['name_lang'] ?>"></a>
    <? endforeach; ?>
    <? endif; ?>
        </div>
        <div class="news_text">
        <b><?=$news_data['news_anons_text']; ?></b>
        <?=$news_data['news_text']; ?>
        </div>
    </div>
<? endif;?>