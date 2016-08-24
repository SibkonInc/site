<?php
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.
include "2connect.php";
//проверка пользователя
include "connect.php";
//подключение функций
include "funycms.php";
 if (isset($_GET['id'])) {
        $id = ($_GET['id']);
    } else {
        $id = "0";
    }
    
$mat = "mat/$id/$id_us_r/";
 if (!(file_exists($mat))) 
{	mkdir("mat/$id/$id_us_r", 0770);}    
    
    
$uploaddir = "mat/$id/$id_us_r/";







$uploadfile = $uploaddir . basename($_FILES['file']['name']);
 
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.n";
} else {
    echo "Possible file upload attack!n";
}
?>