<h2 align="center">Добавление новости</h2>
<form action="<?=$setting['site']?>news/add_post/" method="POST" name="add">
    <table>
        <tr>
            <td>Дата публикации:</td>
            <td><input type="text" name="news_date_public" value="" id="datepicker"></td>
        </tr>
        <tr>
            <td>Относится к разделу:</td>
            <td>
                <select name="news_section" id="s1" multiple="multiple">
                    <option value ="0" selected>Не относится</option>
<? foreach ($section as $section_name):?>
                    <option value="<?=$section_name['id_id']?>"><?=$section_name['name']?></option>
<?  endforeach;?>
                </select>
            </td>
        </tr>
 <tr>
            <td>Опубликовано:</td>
            <td>
                <select name="news_on">
                    <option value="0">Нет</option>
                    <option value="1" selected>Да</option>
                </select>
            </td>
        </tr>
<?  foreach ($lang as $langu):?>
        <tr>
            <td>Название для <?=$langu['name_lang']?></td>
            <td><input type="text" name="name<?=$langu['id']?>" value=""></td>
        </tr>
        <tr>
            <td>Анонс для <?=$langu['name_lang']?></td>
            <td><textarea name="anons<?=$langu['id']?>" rows="4" cols="20"></textarea></td>
        </tr>
        <tr>
            <td>Текст для <?=$langu['name_lang']?></td>
            <td><textarea name="text<?=$langu['id']?>" rows="4" cols="20" class="ckeditor" id="editor<?=$langu['id']; ?>"></textarea>
            <script type="text/javascript">
var ckeditor1 = CKEDITOR.replace('editor<?=$langu['id'];?>');
AjexFileManager.init({returnTo: 'ckeditor', editor: ckeditor<?=$langu['id'];?>});
</script>
            </td>
        </tr>

        <? endforeach;?>
    </table>
    <div style="height:50px;margin-top:5px;" align="right">
        <ul class='nNav' style="width:150px;padding:0px;margin:0px;">
            <li style="margin:0px 3px 0px 0px;">
                <b class="nc"><b class="nc1"><b></b></b><b class="nc2"><b></b></b></b>
                <span class="ncc"><a href="javascript:document.add.submit()">Добавить</a></span>
                <b class="nc"><b class="nc2"><b></b></b><b class="nc1"><b></b></b></b>
            </li>
        </ul>
    </div>
</form>
<script type="text/javascript">
	$(function(){
	  $.datepicker.setDefaults(
	        $.extend($.datepicker.regional["<?if ($setting['article']=="en"){$setting['article'] = "en-GB";}echo $setting['article']?>"])
	  );
	  $("#datepicker").datepicker({
	    beforeShow: function(input) {
	      $(input).css("background-color","#ff9");
	    },
	    onClose: function(dateText, inst) {
	      $(this).css("background-color","");
	    }
	  });
	});
</script>
<script type="text/javascript">
        $(document).ready(function() {
            $("#s1").dropdownchecklist();
        });
</script>