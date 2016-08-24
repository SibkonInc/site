<?php
$html = $this->load("html");
$news_last_data = $this->sql_query("m_news", "left join m_news_text on  m_news.news_id = m_news_text.news_id where news_on='1' and m_news_text.id_lang = '" . $setting['id_lang'] . "' order by m_news.news_id DESC limit 0,5");
$news_lang = $this->sql_query_one("m_news_lang", "where id_lang='" . $setting['id_lang'] . "'");
if ($news_last_data){
foreach ($news_last_data as $news_last):?>
<div class="block_news">
<div class="block_news_date">
<?=$html->format_date($news_last['news_date'],"2");?>:
</div>
<div class="block_news_text">
    <?=$html->ahref("news/view/" . $news_last['news_id'], $html->word_limiter($news_last['news_name'],"5"));?>
</div>
    </div>
 <?  endforeach;}?>
<div class="news_last_down">
    <?=$html->ahref("news/all/", $news_lang['news_read_all']);?>
</div>
