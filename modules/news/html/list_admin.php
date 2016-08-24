<div class="text_block_admin">

    
        <div class="attention" align="right">Не опубликовано</div>
    <div class="news_name">
        <?=$html->ahref("news/view/" . $news_last['news_id'], $news_last['news_name']);?>
    </div>
    <div class="news_text">
        <?=$news_last['news_anons_text'];?>
    </div>
    <div class="text_comment">
        <?=$html->format_date($news_last['news_date_public'],$news_setting['format_date']);?> | <?=$news_lang['name_news_count']?>:<?=$news_last['news_count']?> | <?=$news_lang['name_news_comment']?>:<?=$news_last['news_count']?>
    </div>
    <div class="read_more">
        <?=$html->ahref("news/view/" . $news_last['news_id'], $news_lang['news_read_more']);?>
    </div>
    <div class="news_foter"></div>
    <? if (isset($access['access_edit']) and ($access['access_edit'] == "1")): ?>
        <a href ="<?=$setting['site'] ?>news/edit/<?=$news_last['news_id']; ?>">
        Редактировать</a>
    <? endif; ?>
    <? if (isset($access['access_del']) and ($access['access_del'] == "1")): ?>
         | <a href ="<?=$setting['site'] ?>news/del/<?=$news_last['news_id']; ?>/?height=125&width=250&modal=true" class="thickbox">
        Удалить</a>
    <? endif; ?>
</div>
