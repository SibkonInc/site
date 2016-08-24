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
        <a href ="<?=$setting['site'] ?>clients/add_form/">
        <img src="<?=$setting['site'] ?>img/ico/add.png" width="16" height="16" alt="add"/>Добавить</a>
    <? endif; ?>
        <? if (isset($access['access_admin']) and ($access['access_admin'] == "1")): ?>
         | <a href ="<?=$setting['site'] ?>clients/admin">Управление модулем</a>
    <? endif; ?>
</div>
<? endif; ?>
<h2 align="center"><?=$clients_lang['clients_name']?></h2>
<?=$clients_lang['clients_info']?>
<div class="news_foter"></div><br>
<?  if($clients_data==true):?>
<? foreach ($clients_data as $clients): ?>
<? if ($clients['adress_clients'] == ""): ?>
<img src="<?=$setting['site']?>img/clients/<?=$clients['clients_logo']?>" align="left" witdh="130" >
<? else: ?>
    <a href="<?=$clients['adress_clients']; ?>" target="blank"><img src="<?=$setting['site']?>img/clients/<?=$clients['clients_logo']?>" align="left" witdh="130"></a>
<? endif; ?>
<?=$clients['anons_clients']; ?>
<? if (!($clients['text_clients'] == "")): ?>
    <div class="read_more">
                <?=$html->ahref("clients/view/" . $clients['clients_id'], "Далее"); ?>
</div>
<? endif; ?>
<div class="news_foter"></div><br>
<? endforeach; ?>
<?endif;?>
