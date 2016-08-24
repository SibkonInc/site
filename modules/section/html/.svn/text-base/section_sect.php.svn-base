<script type="text/javascript">
	$(function() {

		$("#accord").accordion({
	   collapsible: true,active: false,autoHeight: true
	  });


//setter
$( "#accord" ).accordion( "option", "clearStyle", true );
	});
        
	</script>
<? global $ycms; ?>
<? $html = $ycms->load("html"); ?>
<? $where = "left join m_section_text on  m_section.section_id = m_section_text.id_id where m_section_text.id_lang = '" . $setting['id_lang'] . "' and m_section.section_id_id = '" . $section_data['section_id'] . "' order by section_nomer";
$section = $ycms->sql_query("m_section", $where); ?>
<?if ($section==true):?>
<div id="accord">
  <? foreach ($section as $sect): ?>
   <h3><?=$html->ahref("sect/view/" . $sect['section_id'], $sect['name']);?></h3>
   <div><b><?=$html->ahref("sect/view/" . $sect['section_id'], $sect['name']);?></b>
<br>
   <? $where2 = "left join m_section_text on  m_section.section_id = m_section_text.id_id where m_section_text.id_lang = '" . $setting['id_lang'] . "' and m_section.section_id_id = '" . $sect['section_id'] . "' order by section_nomer";
$section2 = $ycms->sql_query("m_section", $where2); ?>
<?if ($section2==true):?>
<div class ="section_s">
<ul>
   <? foreach ($section2 as $sect2): ?>
<li><?=$html->ahref("sect/view/" . $sect2['section_id'], $sect2['name']);?></li>
   <? endforeach; ?>
</ul>
    </div>
   <?endif;?>
   </div>
<? endforeach; ?>
</div>
<?endif;?>
  









