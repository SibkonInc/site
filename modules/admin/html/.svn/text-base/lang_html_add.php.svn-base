<h2 align="center"><?=$setting['admin']
?></h2>
<h4 align="center">Добавление нового языка.</h4>
<?if(isset($ok) and $ok==true):?>
<div class="attention">Новый язык был добавлен</div>
<?else:?>
<form name="lang" action="<?=$setting['site']?>admin/lang_add" method="POST">
    <table>
        <tr>
            <td>Имя для отображения. Лучше писать на языке оригинала</td>
            <td><input type="text" name="name_lang" value="" /></td>
        </tr>
        <tr>
            <td>Aртикл. Принятое краткое обозначение страны.</td>
            <td><input type="text" name="article" value="" /></td>
        </tr>
        <tr>
            <td>Место расположения рисунка с флагом. Если нет флага на экран будет выведен артикл</td>
            <td><input type="text" name="img" value="" /></td>
        </tr>
    </table>
    <div style="height:50px;margin-top:5px;">
        <ul class='nNav' style="width:50px;padding:0px;margin:0px;"><li style="margin:0px 3px 0px 0px;">
                <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
                <span class="ncc"><a href="javascript:document.lang.submit()">Добавить</a></span>
                <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
            </li></ul>
    </div>
</form>
<?endif;?>