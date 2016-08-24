<style type="text/css">
div#rotatorp {position:relative; height:50px; }
div#rotatorp ul li {float:left; position:absolute; list-style: none;}
</style>
<script type="text/javascript">
function theRotatorp() {
	//Устанавливаем прозрачность всех картинок в 0
	$('div#rotatorp ul li').css({opacity: 0.0});
	//Берем первую картинку и показываем ее (попути включаем полную видимость)
	$('div#rotatorp ul li:first').css({opacity: 1.0});
	//Вызываем функцию rotator для запуска слайдшоу, 3000 = смена картинок происходит раз в 5 секунд
	setInterval('rotatep()',5000);
}
function rotatep() {
	//Берем первую картинку
	var current = ($('div#rotatorp ul li.show')?  $('div#rotatorp ul li.show') : $('div#rotatorp ul li:first'));
	//Берем следующую картинку, когда дойдем до последней начинаем с начала
	var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('div#rotatorp ul li:first') :current.next()) : $('div#rotatorp ul li:first'));
	//Подключаем эффект растворения/затухания для показа картинок, css-класс show имеет больший z-index
	next.css({opacity: 0.0})
	.addClass('show')
	.animate({opacity: 1.0}, 2000);
	//Прячем текущую картинку
	current.animate({opacity: 0.0}, 2000)
	.removeClass('show');
};
$(document).ready(function() {
	//Запускаем слайдшоу
	theRotatorp();
});
</script>
<?$html = $this->load("html");
$news_last_data = $this->sql_query("m_awards", "ORDER BY RAND() limit 0,10"," awards_id, awards_logo");
$news_lang = $this->sql_query_one("m_awards_lang", "where id_lang='" . $setting['id_lang'] . "'");?>
<?if ($news_last_data==true):?>
<div id="rotatorp" align="center">
  <ul>
<?php
foreach ($news_last_data as $awards_rand):?>
<li><a href="<?=$setting['site']?>awards"><img src="<?=$setting['site']?>img/awards/<?=$awards_rand['awards_logo']?>" width="130"></a></li>
<?  endforeach;?>
  </ul>
</div>
<?endif;?>
<div class="news_last_down">
    <?=$html->ahref("awards/", $news_lang['awards_all']);?>
</div>
