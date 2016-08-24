<h2 align="center"><?=$setting['admin']
?></h2>
<h4 align="center">Изменение языка "<?=$lang['name_lang']?>".</h4>
<?if(isset($ok) and $ok==true):?>
<div class="attention">Изменения внесены</div>
<?endif;?>
<form name="lang" action="<?=$setting['site']?>admin/lang_edit/<?=$lang['id']?>" method="POST">
    <table>
        <tr>
            <td>Имя для отображения. Лучше писать на языке оригинала</td>
            <td><input type="text" name="name_lang" value="<?=$lang['name_lang']?>" /></td>
        </tr>
        <tr>
            <td>Aртикл. Принятое краткое обозначение страны.</td>
            <td><input type="text" name="article" value="<?=$lang['article']?>" /></td>
        </tr>
        <tr>
            <td>Место расположения рисунка с флагом. Если нет флага на экран будет выведен артикл</td>
            <td><input type="text" name="img" value="<?=$lang['img']?>" /></td>
        </tr>
    </table>
    <div style="height:50px;margin-top:5px;">
        <ul class='nNav' style="width:50px;padding:0px;margin:0px;"><li style="margin:0px 3px 0px 0px;">
                <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
                <span class="ncc"><a href="javascript:document.lang.submit()">Изменить</a></span>
                <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
            </li></ul>
    </div>
</form>
