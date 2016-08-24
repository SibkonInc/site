/*
 * Плагин jQuery.BBCode
 * Версия 0.1 Бета
 *
 * http://www.kamaikinproject.ru
 */
(function($){
  $.fn.bbcode = function(options){
		// настройки по умолчанию
    var options = $.extend({
      teg_bold: true,
      teg_italic: true,
      teg_underline: true,
      teg_linck: true,
      teg_image: false,
      button_image: true,
      image_url: '/js/bbimage/'
    },options||{});
    //  Формируем панель инструментов
    var text = '<div id="bbcode_bb_bar">'
    if(options.teg_bold){
      text = text + '<a href="#" alt="b" title=""> ';
      if(options.button_image){
        text = text + '<img src="' + options.image_url + 'bold.png" />';
      }else{
        text = text + 'Жирный';
      }
      text = text + '</a>';
    }
    if(options.teg_italic){
      text = text + '<a href="#" alt="i" title=""> ';
      if(options.button_image){
        text = text + '<img src="' + options.image_url + 'italic.png" />';
      }else{
        text = text + 'Курсив';
      }
      text = text + '</a>';
    }
    if(options.teg_underline){
      text = text + '<a href="#" alt="u" title=""> ';
      if(options.button_image){
        text = text + '<img src="' + options.image_url + 'underline.png" />';
      }else{
        text = text + 'Подчеркнутый';
      }
      text = text + '</a>';
    }
    if(options.teg_linck){
      text = text + '<a href="#" alt="url[href=]" title=""> ';
      if(options.button_image){
        text = text + '<img src="' + options.image_url + 'linck.png" />';
      }else{
        text = text + 'Ссылка';
      }
      text = text + '</a>';
    }
    if(options.teg_image){
      text = text + '<a href="#" alt=\'img\' title=""> ';
      if(options.button_image){
        text = text + '<img src="' + options.image_url + 'image.png" />';
      }else{
        text = text + 'Изображение';
      }
      text = text + '</a>';
    }
    text = text + '</div>';
    
    $(this).wrap('<div id="bbcode_container"></div>');
    $("#bbcode_container").prepend(text);
    $("#bbcode_bb_bar a img").css("border", "none");
    var id = '#' + $(this).attr("id");
    var e = $(id).get(0);
    
    $('#bbcode_bb_bar a').click(function() {
      var button_id = attribs = $(this).attr("alt");
      button_id = button_id.replace(/\[.*\]/, '');
      if (/\[.*\]/.test(attribs)) { attribs = attribs.replace(/.*\[(.*)\]/, ' $1'); } else attribs = '';
      var start = '['+button_id+attribs+']';
      var end = '[/'+button_id+']';
      insert(start, end, e);
      return false;
    });
	}
  function insert(start, end, element) {
    if (document.selection) {
       element.focus();
       sel = document.selection.createRange();
       sel.text = start + sel.text + end;
    } else if (element.selectionStart || element.selectionStart == '0') {
       element.focus();
       var startPos = element.selectionStart;
       var endPos = element.selectionEnd;
       element.value = element.value.substring(0, startPos) + start + element.value.substring(startPos, endPos) + end + element.value.substring(endPos, element.value.length);
    } else {
      element.value += start + end;
    }
  }
})(jQuery)

