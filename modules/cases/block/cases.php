<script type="text/javascript">
function theRotator() {
	$('div#rotator ul li').css({opacity: 0.0});
	$('div#rotator ul li:first').css({opacity: 1.0});
	setInterval('rotate()',5000);
}
function rotate() {
	var current = ($('div#rotator ul li.show')?  $('div#rotator ul li.show') : $('div#rotator ul li:first'));
	var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('div#rotator ul li:first') :current.next()) : $('div#rotator ul li:first'));
	next.css({opacity: 0.0})
	.addClass('show')
	.animate({opacity: 1.0}, 2000);
	current.animate({opacity: 0.0}, 2000)
	.removeClass('show');
};
$(document).ready(function() {
	theRotator();
});
</script>
<div id="rotator" align="center">
  <ul>
<?php
$html = $this->load("html");
$news_last_data = $this->sql_query("m_casesners", "ORDER BY RAND() limit 0,10"," cases_id, cases_logo");
$news_lang = $this->sql_query_one("m_cases_lang", "where id_lang='" . $setting['id_lang'] . "'");
if ($news_last_data==true){
foreach ($news_last_data as $cases_rand):?>
<li><a href="<?=$setting['site']?>cases"><img src="<?=$setting['site']?>img/casesners/<?=$cases_rand['cases_logo']?>" width="130" alt="<?=$cases_rand['cases_logo']?>"></a></li>
<?
endforeach;}?>
  </ul>
</div>
<div class="news_last_down">
    <?=$html->ahref("cases/", $news_lang['cases_all']);?>
</div>