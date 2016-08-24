<? global $ycms; ?>
<? $html = $ycms->load("html"); ?>
<?=$html->ahref("", $setting['name']); ?>
<?
if (isset($section_data['section_id'])){?><img src="<?=$setting['site']?>img/ico/str.png"  alt="str"/>
<?
function treee($id) {
    global $ycms, $section_data_name, $setting;
    $html = $ycms->load("html");
    if (!($id == "0")) {
        $id2 = $ycms->sql_query_one("m_section", "where section_id = $id");
        $id3 = $id2['section_id_id'];
        $id4[] = $id3;
        treee($id3);
    }
    if (isset($id3)) {
        if (!($id3 == "0")) {
            $where = "left join m_section_text on  m_section.section_id = m_section_text.id_id where m_section_text.id_lang = '" . $setting['id_lang'] . "' and m_section.section_id = $id3";
            $name_sect = $ycms->sql_query_one("m_section", $where);?>
<?=$html->ahref("sect/view/".$id3, $name_sect['name']); ?><img src="<?=$setting['site']?>img/ico/str.png" alt="str"/>
            <?}}}
treee($section_data['section_id']);?>
<?=$section_data['name'];}?>









