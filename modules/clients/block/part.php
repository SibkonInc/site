<style type="text/css">
div#rotator {position:relative; height:50px; }
div#rotator ul li {float:left; position:absolute; list-style: none;}
</style>
<script type="text/javascript">
function theRotator() {
	//Устанавливаем прозрачность всех картинок в 0
	$('div#rotator ul li').css({opacity: 0.0});

	//Берем первую картинку и показываем ее (попути включаем полную видимость)
	$('div#rotator ul li:first').css({opacity: 1.0});

	//Вызываем функцию rotator для запуска слайдшоу, 3000 = смена картинок происходит раз в 5 секунд
	setInterval('rotate()',5000);
}
function rotate() {
	//Берем первую картинку
	var current = ($('div#rotator ul li.show')?  $('div#rotator ul li.show') : $('div#rotator ul li:first'));

	//Берем следующую картинку, когда дойдем до последней начинаем с начала
	var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('div#rotator ul li:first') :current.next()) : $('div#rotator ul li:first'));

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
	theRotator();
});
</script>
<div id="rotator" align="center">
  <ul>
<?php
$html = $this->load("html");
$news_last_data = $this->sql_query("m_partners", "ORDER BY RAND() limit 0,10"," part_id, part_logo");
$news_lang = $this->sql_query_one("m_part_lang", "where id_lang='" . $setting['id_lang'] . "'");
foreach ($news_last_data as $part_rand):?>
<li><a href="<?=$setting['site']?>part/view/<?=$part_rand['part_id']?>"><img src="<?=$setting['site']?>img/partners/<?=$part_rand['part_logo']?>" width="130"></a></li>
<?  endforeach;?>
  </ul>
</div>
<div class="news_last_down">
    <?=$html->ahref("part/", $news_lang['part_all']);?>
</div>