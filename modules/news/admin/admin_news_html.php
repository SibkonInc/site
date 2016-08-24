<h2 align="center">Управление модулем Новости</h2>
<form action="<?=$setting['site'];?>news/admin_edit" method="POST" name="news_admin">
    <table>
        <tr>
            <td align="right">Сколько выводить последних</td>
            <td><input type="text" name="news_order_last" value="<?=$news_setting['news_order_last']?>" /></td>
        </tr>
        <tr>
            <td align="right">Сколько выводить популярных</td>
            <td><input type="text" name="news_order_top" value="<?=$news_setting['news_order_top']?>" /></td>
        </tr>
        <tr>
            <td align="right">Сколько выводить поисковых</td>
            <td><input type="text" name="news_order_search" value="<?=$news_setting['news_order_search']?>" /></td>
        </tr>
        <tr>
            <td align="right">Сколько выводить новостей на страницев всех</td>
            <td><input type="text" name="news_order_pages" value="<?=$news_setting['news_order_pages']?>" /></td>
        </tr>
        <tr>
            <td align="right">разрешены комментарии</td>
            <td><input type="text" name="on_comment" value="<?=$news_setting['on_comment']?>" /></td>
        </tr>
        <tr>
            <td align="right">сколько выводить комментариев</td>
            <td><input type="text" name="news_order_comment" value="<?=$news_setting['news_order_comment']?>" /></td>
        </tr>
        <tr>
            <td align="right">включен популярные</td>
            <td><input type="text" name="on_top" value="<?=$news_setting['on_top']?>" /></td>
        </tr>
        <tr>
            <td align="right">включен поисковые</td>
            <td><input type="text" name="on_search" value="<?=$news_setting['on_search']?>" /></td>
        </tr>
        <tr>
            <td align="right">формат даты по умолчанию</td>
            <td><input type="text" name="format_date" value="<?=$news_setting['format_date']?>" /></td>
        </tr>
        <tr>
            <td align="right">количество слов для обрезки</td>
            <td><input type="text" name="text_small" value="<?=$news_setting['text_small']?>" /></td>
        </tr>
    </table>
    
<?  foreach ($lang as $langu):?>
<?$news_lang = $this->sql_query_one("m_news_lang","where id_lang = '".$langu['id']."'");?>
<? if ($news_lang['id_lang'] == $langu['id']): ?>
<h2 align="center">Настройки для <?=$langu['name_lang']?></h2>
    <table>
        <tr>
            <td align="right" width="200" >Название <?=$langu['name_lang']?></td>
            <td><input type="text" name="name_m_news<?=$langu['id']?>" value="<?=$news_lang['name_m_news']?>" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >новые <?=$langu['name_lang']?></td>
            <td><input type="text" name="name_news_last<?=$langu['id']?>" value="<?=$news_lang['name_news_last']?>" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >популярные <?=$langu['name_lang']?></td>
            <td><input type="text" name="name_news_top<?=$langu['id']?>" value="<?=$news_lang['name_news_top']?>" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >поисковые <?=$langu['name_lang']?></td>
            <td><input type="text" name="name_news_search<?=$langu['id']?>" value="<?=$news_lang['name_news_search']?>" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >комментарии <?=$langu['name_lang']?></td>
            <td><input type="text" name="name_news_comment<?=$langu['id']?>" value="<?=$news_lang['name_news_comment']?>" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >посещений <?=$langu['name_lang']?></td>
            <td><input type="text" name="name_news_count<?=$langu['id']?>" value="<?=$news_lang['name_news_count']?>" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >читать далее <?=$langu['name_lang']?></td>
            <td><input type="text" name="news_read_more<?=$langu['id']?>" value="<?=$news_lang['news_read_more']?>" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >читать все <?=$langu['name_lang']?></td>
            <td><input type="text" name="news_read_all<?=$langu['id']?>" value="<?=$news_lang['news_read_all']?>" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >rss <?=$langu['name_lang']?></td>
            <td><input type="text" name="news_rss<?=$langu['id']?>" value="<?=$news_lang['news_rss']?>" /></td>
        </tr>
   </table>
<?else:?>
<h2 align="center">Добавьте настройки для <?=$langu['name_lang']?></h2>
    <table>
        <tr>
            <td align="right" width="200" >Название <?=$langu['name_lang']?></td>
            <td><input type="text" name="add_name_m_news<?=$langu['id']?>" value="" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >новые <?=$langu['name_lang']?></td>
            <td><input type="text" name="add_name_news_last<?=$langu['id']?>" value="" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >популярные <?=$langu['name_lang']?></td>
            <td><input type="text" name="add_name_news_top<?=$langu['id']?>" value="" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >поисковые <?=$langu['name_lang']?></td>
            <td><input type="text" name="add_name_news_search<?=$langu['id']?>" value="" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >комментарии <?=$langu['name_lang']?></td>
            <td><input type="text" name="add_name_news_comment<?=$langu['id']?>" value="" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >посещений <?=$langu['name_lang']?></td>
            <td><input type="text" name="add_name_news_count<?=$langu['id']?>" value="" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >читать далее <?=$langu['name_lang']?></td>
            <td><input type="text" name="add_news_read_more<?=$langu['id']?>" value="" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >читать все <?=$langu['name_lang']?></td>
            <td><input type="text" name="add_news_read_all<?=$langu['id']?>" value="" /></td>
        </tr>
        <tr>
            <td align="right" width="200" >rss <?=$langu['name_lang']?></td>
            <td><input type="text" name="news_rss<?=$langu['id']?>" value="" /></td>
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