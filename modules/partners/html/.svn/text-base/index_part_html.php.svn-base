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
        <a href ="<?=$setting['site'] ?>part/add_form/">
        <img src="<?=$setting['site'] ?>img/ico/add.png" width="16" height="16" alt="add"/>Добавить</a>
    <? endif; ?>
        <? if (isset($access['access_admin']) and ($access['access_admin'] == "1")): ?>
         | <a href ="<?=$setting['site'] ?>part/admin">Управление модулем</a>
    <? endif; ?>
</div>
<? endif; ?>
<h2 align="center"><?=$part_lang['part_name']?></h2>
<?=$part_lang['part_info']?>
<div class="news_foter"></div><br>
<?  if($part_data==true):?>
<? foreach ($part_data as $part): ?>
<? if ($part['adress_part'] == ""): ?>
<img src="<?=$setting['site']?>img/partners/<?=$part['part_logo']?>" align="left" witdh="130" >
<? else: ?>
    <a href="<?=$part['adress_part']; ?>" target="blank"><img src="<?=$setting['site']?>img/partners/<?=$part['part_logo']?>" align="left" witdh="130"></a>
<? endif; ?>
<?=$part['anons_part']; ?>
<? if (!($part['text_part'] == "")): ?>
    <div class="read_more">
                <?=$html->ahref("part/view/" . $part['part_id'], "Далее"); ?>
</div>
<? endif; ?>
<div class="news_foter"></div><br>
<? endforeach; ?>
<?endif;?>
