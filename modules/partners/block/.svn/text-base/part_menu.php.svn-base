<div class ="block_title"></div>
<div class ="l_menu">
    <ul>
<?
global $ycms;
$url = $ycms->get_url();
$html = $this->load("html");
$part_tip_data = $this->sql_query("m_part_tip_lang", "where id_lang='".$setting['id_lang']."'");
if ($part_tip_data==true){
    foreach ($part_tip_data as $part_tip) {
if (($url['id'] == $part_tip['id_part_tip'])): ?>
<li><b><?=$html->ahref("part/tip/".$part_tip['id_part_tip'], $part_tip['part_tip_name']);?></b></li>
            <? else: ?>
<li><?=$html->ahref("part/tip/".$part_tip['id_part_tip'], $part_tip['part_tip_name']);?></li>
            <? endif;
    }
}


?> </ul>
</div>
<div class ="block_title"></div>