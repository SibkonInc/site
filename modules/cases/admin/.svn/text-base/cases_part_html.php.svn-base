<h2 align="center">Управление модулем Партнеры</h2>
<form action="<?=$setting['site'];?>cases/admin_tip" method="POST" name="tips_admin">
<a href="<?=$setting['site'];?>cases/admin_tip">Управление типами</a>



</form>
<form action="<?=$setting['site'];?>cases/admin_post" method="POST" name="news_admin">
 <?  foreach ($lang as $langu):?>
<?$news_lang = $this->sql_query_one("m_cases_lang","where id_lang = '".$langu['id']."'");?>
<? if ($news_lang['id_lang'] == $langu['id']): ?>
<h2 align="center">Настройки для <?=$langu['name_lang']?></h2>
    <table>
        <tr>
            <td align="right" width="200" >Название <?=$langu['name_lang']?></td>
            <td><input type="text" name="cases_name<?=$langu['id']?>" value="<?=$news_lang['cases_name']?>" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >Текст <?=$langu['name_lang']?></td>
            <td><textarea name="cases_info<?=$langu['id']?>" rows="4" cols="20"><?=$news_lang['cases_info']?></textarea></td>
        </tr>
        <tr>
            <td align="right" width="200" >смотреть всех <?=$langu['name_lang']?></td>
            <td><input type="text" name="cases_all<?=$langu['id']?>" value="<?=$news_lang['cases_all']?>" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >читать далее <?=$langu['name_lang']?></td>
            <td><input type="text" name="cases_more<?=$langu['id']?>" value="<?=$news_lang['cases_more']?>" /></td>
        </tr>
   </table>
<?else:?>
<h2 align="center">Добавьте настройки для <?=$langu['name_lang']?></h2>
    <table>
        <tr>
            <td align="right" width="200" >Название <?=$langu['name_lang']?></td>
            <td><input type="text" name="add_cases_name<?=$langu['id']?>" value="" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >Текст <?=$langu['name_lang']?></td>
            <td><textarea name="add_cases_info<?=$langu['id']?>" rows="4" cols="20"></textarea></td>
        </tr>
        <tr>
            <td align="right" width="200" >смотреть всех <?=$langu['name_lang']?></td>
            <td><input type="text" name="add_cases_all<?=$langu['id']?>" value="" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >читать далее <?=$langu['name_lang']?></td>
            <td><input type="text" name="add_cases_more<?=$langu['id']?>" value="" /></td>
        </tr>
   </table>
<?endif;?>
<? endforeach;?>
    <div style="height:50px;margin-top:5px;" align="right">
        <ul class='nNav' style="width:50px;padding:0px;margin:0px;">
            <li style="margin:0px 3px 0px 0px;">
                <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
                <span class="ncc"><a href="javascript:document.news_admin.submit()">Изменить</a></span>
                <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
            </li>
        </ul>
    </div>
</form>
<?if ($message==true):?>
<?    foreach ($message as $key => $value):?>
<script type="text/javascript">
//<![CDATA[
$.jGrowl('<?=$value;?>');
//]]>
</script>
<? endforeach;?>
<?endif;?>