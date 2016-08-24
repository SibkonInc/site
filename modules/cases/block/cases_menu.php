<div class ="block_title"></div>
<div class ="l_menu">
    <ul>
<?
global $ycms;
$url = $ycms->get_url();
$html = $this->load("html");
$cases_tip_data = $this->sql_query("m_cases_tip_lang", "where id_lang='".$setting['id_lang']."'");
if ($cases_tip_data==true){
    foreach ($cases_tip_data as $cases_tip) {
if (($url['id'] == $cases_tip['id_cases_tip'])): ?>
<li><b><?=$html->ahref("cases/tip/".$cases_tip['id_cases_tip'], $cases_tip['cases_tip_name']);?></b></li>
            <? else: ?>
<li><?=$html->ahref("cases/tip/".$cases_tip['id_cases_tip'], $cases_tip['cases_tip_name']);?></li>
            <? endif;
    }
}


?> </ul>
</div>
<div class ="block_title"></div>