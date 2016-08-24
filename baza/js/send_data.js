function send()
{
//Получаем параметры
var del_posel = $('#del_posel').val();
  // Отсылаем паметры
       $.ajax({
                type: "POST",
                url: "admin/del_user.php?id=$id_zap_us",
                del_posel: "del_posel="+del_posel+",
                // Выводим то что вернул PHP
                success: function(html) {
 //предварительно очищаем нужный элемент страницы
                        $("#result").empty();
//и выводим ответ php скрипта
                        $("#result").append(html);
                }
        });

}

