<? if ($message == true): ?>
<? foreach ($message as $key => $value): ?>
        <script type="text/javascript">
            //<![CDATA[
            $.jGrowl('<?=$value; ?>');
            //]]>
        </script>
<? endforeach; ?>
<? endif; ?>
<? if (($access['access_edit'] == "1") or ($access['access_del'] == "1") or ($access['access_add'] == "1")): ?>
            <div style="height: 25px;margin-top:5px;" align="right">
    <? if (isset($access['access_add']) and ($access['access_add'] == "1")): ?>
                <a href ="<?=$setting['site'] ?>news/add_form/">
        <img src="<?=$setting['site'] ?>img/ico/add.png" width="16" height="16" alt="add"/>Добавить новость</a>
    <? endif; ?>
    <? if (isset($access['access_admin']) and ($access['access_admin'] == "1")): ?>
         | <a href ="<?=$setting['site'] ?>news/admin">Управление модулем</a>
    <? endif; ?>
</div>
<? endif; ?>
    <div class ="rss">
<?=$html->ahref("news/rss/", $news_lang['news_rss']); ?>
</div>
<h2><?=$news_lang['name_m_news'] ?></h2>
<div class ="block_title">
<?=$news_lang['name_news_last'] ?>
</div>
<!--Блок последних новостей-->
<? if ($news_last_data == true) {
        foreach ($news_last_data as $news_last): ?>
<? include 'list.php'; ?>
<? endforeach;
        } ?>
    <div class="news_last_down">
        <?=$html->ahref("news/all/", $news_lang['news_read_all']); ?>
</div>
<!--Блок популярных новостей-->
<div class ="block_title">
<?=$news_lang['name_news_top'] ?>
    </div>
<? if ($news_top_data == true) {
        foreach ($news_top_data as $news_top): ?>
    <div class="text_block">
        <div class="news_name">
            <?=$html->ahref("news/view/" . $news_top['news_id'], $news_top['news_name']); ?>
    </div>
    <div class="news_text">
        <?=$news_top['news_anons_text']; ?>
    </div>
    <div class="text_comment">
        <?=$html->format_date($news_top['news_date_public'], $news_setting['format_date']); ?> | <?=$news_lang['name_news_count'] ?>:<?=$news_top['news_count'] ?> | <?=$news_lang['name_news_comment'] ?>:<?=$news_top['news_count'] ?>
    </div>
    <div class="read_more">
        <?=$html->ahref("news/view/" . $news_top['news_id'], $news_lang['news_read_more']); ?>
    </div>
    <div class="news_foter"></div>
</div>
<? endforeach;
    } ?>
    <!--Блок поисковых новостей-->
    <!--<div class ="block_title"><?=$news_lang['name_news_search'] ?></div>-->