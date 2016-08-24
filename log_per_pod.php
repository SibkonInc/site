<?
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";

if (isset($_GET['id'])) {
            $id  = addslashes($_GET['id']);
        } else {
            $id = 0;
        }
        if (!is_numeric($id)) {
            die("Такой записи нет!");
        }
        if($tip_user ==1)
        {
		 $query = "select * From `us` where id_us = '$id'" ;	
		}
		else
		{
    $query = "select * From `us` where id_us = '$id' and master = '$id_user'" ;
    }
    $result = mysql_query($query) or die("");
    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $act_us_p = "$link[act_us]";
        $id_us_p = "$link[id_us]";
        $nick_us_p = "$link[nick_us]";
        $tip_us_p = "$link[tip_us]";
        $k_p = "$link[k]";
        $master_p = "$link[master]";
    }

    if ($act_us_p == 0) {
        echo "Аккаунт еще не активирован. Обратитесь попозже или к администратору";
    } else {
        $user_m = user_info($id_user);
        $user_pod = user_info($id);
        	$mess_log = "$user_m Перехватил управление подопечным $user_pod";
			ad_log($mess_log);
        
            SetCookie('id_us', $id_us_p, time() + 60 * 60 * 24 * 30);
            SetCookie('tip_us', $tip_us_p, time() + 60 * 60 * 24 * 30);
            SetCookie('ktip_us', $k_p, time() + 60 * 60 * 24 * 30);
            SetCookie('id_us_m', $id_user, time() + 60 * 60 * 24 * 30);
            SetCookie('ktip_m', $ktip_user, time() + 60 * 60 * 24 * 30);
            
        
      
            header("Location: index.php");
        
            
    }

  

    
?>