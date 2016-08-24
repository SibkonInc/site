<?if ($message==true):?>
<?    foreach ($message as $key => $value):?>
<script type="text/javascript">
//<![CDATA[
$.jGrowl('<?=$value;?>');
//]]>
</script>
<? endforeach;?>
<?endif;?>
<? if (($access['access_edit'] == "1") or ($access['access_del'] == "1") or ($access['access_add'] == "1")): ?>
    <div style="height: 25px;margin-top:5px;" align="right">
        <? if (isset($access['access_add']) and ($access['access_add'] == "1")): ?>
<a href ="<?=$setting['site']?>sect/add_form/">
    <img src="<?=$setting['site']?>img/ico/add.png" width="16" height="16" alt="add"/>Добавить новый раздел</a>
<? endif; ?>
    </div>
<? endif; ?>
<? include 'section_html.php'; ?>
<div class="example">
<?
//для построения дерева придеться пользоваться функцией
function tree($id) {
    global $setting, $ycms;
    $html = $ycms->load("html");
    $where = "left join m_section_text
on  m_section.section_id = m_section_text.id_id
where m_section_text.id_lang = '" . $setting['id_lang'] . "' and m_section.section_id_id = $id order by section_nomer";
    $section = $ycms->sql_query("m_section", $where);?>
<ul class="tree">
<?if (!(empty($section))) {foreach ($section as $sect) {?>
    <li><?=$html->ahref("sect/view/" . $sect['section_id'], $sect['name']);?>
    <?
    $where2 = "where id_id = '" . $sect['section_id'] . "'";
    $section2 = $ycms->sql_query("m_section_text", $where2);

    foreach ($section2 as $sect2) {

        $news_text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($sect2['text']));
                        if (!($news_text == "")) {
                           echo $sect2['id_lang']." | ";
                        }


        
    }
    ?>



    </li>
<?tree($sect['section_id']);}}?>
</ul>
<?}?>
<h2><?=$section_data['name']; ?></h2>
<?//=$section_data['text'];?>
<?tree(0);?>
</div>

