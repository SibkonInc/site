<? if ($message == true): ?>
<? foreach ($message as $key => $value): ?>
        <script type="text/javascript">
            //<![CDATA[
            $.jGrowl('<?=$value; ?>');
            //]]>
        </script>
<? endforeach; ?>
<? endif; ?>
<? if (($access['access_edit'] == "1") or ($access['access_del'] == "1") or ($access['access_add'] == "1") or ($access['access_admin'] == "1")): ?>
    <div style="height: 25px;margin-top:5px;" align="right">
    <? if (isset($access['access_add']) and ($access['access_add'] == "1")): ?>
        <a href ="<?=$setting['site'] ?>awards/add_form/">
        <img src="<?=$setting['site'] ?>img/ico/add.png" width="16" height="16" alt="add"/>Добавить</a>
    <? endif; ?>
        <? if (isset($access['access_admin']) and ($access['access_admin'] == "1")): ?>
         | <a href ="<?=$setting['site'] ?>awards/admin">Управление модулем</a>
    <? endif; ?>
</div>
<? endif; ?>
<h2 align="center"><?=$awards_lang['awards_name']?></h2>
<?=$awards_lang['awards_info']?>
<div class="news_foter"></div><br>
<?  if($awards_data==true):?>
<? foreach ($awards_data as $awards): ?>
<? if ($awards['adress_awards'] == ""): ?>
<img src="<?=$setting['site']?>img/awards/<?=$awards['awards_logo']?>" align="left" witdh="130" >
<? else: ?>
    <a href="<?=$awards['adress_awards']; ?>" target="blank"><img src="<?=$setting['site']?>img/awards/<?=$awards['awards_logo']?>" align="left" witdh="130"></a>
<? endif; ?>
<?=$awards['anons_awards']; ?>
<? if (!($awards['text_awards'] == "")): ?>
    <div class="read_more">
                <?=$html->ahref("awards/view/" . $awards['awards_id'], "Далее"); ?>
</div>
<? endif; ?>
<div class="news_foter"></div><br>
<? endforeach; ?>
<?endif;?>
