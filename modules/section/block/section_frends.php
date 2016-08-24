<?php
global $ycms, $setting;
$url = $ycms->get_url();
if (!($url['id']=="0")){
$where2 = "left join m_section_text on  m_section.section_id = m_section_text.id_id
    where m_section_text.id_lang = '" . $setting['id_lang'] . "' and m_section.section_id_id = '" . $url['id'] . "' order by section_nomer";
$menu_le2 = $ycms->sql_query("m_section", $where2 );
?>
<?if ($menu_le2==true):?>
<div class ="block_title"></div>
<div class ="l_menu">
    <ul>
        <? foreach ($menu_le2 as $men): ?>
        <? if (($url['id'] == $men['section_id'])): ?>
<li><a class="link" href ="<?=$setting['site'] ?>sect/view/<?=$men['section_id'] ?>"><b><?=$men['name'] ?></b></a></li>
            <? else: ?>
<li><a class="link" href ="<?=$setting['site'] ?>sect/view/<?=$men['section_id'] ?>"><?=$men['name'] ?></a></li>
            <? endif; ?>
        <? endforeach; ?>
        
    </ul>
</div>
<div class ="block_title"></div>
<?else:?><?

$where = "left join m_section_text on  m_section.section_id = m_section_text.id_id
    where m_section_text.id_lang = '" . $setting['id_lang'] . "' and m_section.section_id = '" . $url['id'] . "' order by section_nomer";
$menu_le = $ycms->sql_query_one("m_section", $where );

if (!($menu_le['section_id_id']=="0")){

$where2 = "left join m_section_text on  m_section.section_id = m_section_text.id_id
    where m_section_text.id_lang = '" . $setting['id_lang'] . "'
        and m_section.section_id_id = '" . $menu_le['section_id_id'] . "' order by section_nomer";
$menu_le2 = $ycms->sql_query("m_section", $where2 );
?>
<div class ="block_title"></div>
<div class ="l_menu">
    <ul>
        <? foreach ($menu_le2 as $men): ?>
        <? if (($url['id'] == $men['section_id'])): ?>
<li><a class="link" href ="<?=$setting['site'] ?>sect/view/<?=$men['section_id'] ?>"><b><?=$men['name'] ?></b></a></li>
            <? else: ?>
<li><a class="link" href ="<?=$setting['site'] ?>sect/view/<?=$men['section_id'] ?>"><?=$men['name'] ?></a></li>
            <? endif; ?>
        <? endforeach; ?>

    </ul>
</div>
<div class ="block_title"></div>


<?}?>
        <? endif; ?>
<?}?>