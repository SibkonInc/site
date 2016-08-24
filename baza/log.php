<?php 
require_once "functions.php";
include_once ('header.php');
 ?>
<div id="center_wrap">
	<div id="one_column">
	<center>
<?php
            $ok_page = mysql_query("select * from log_baza order by data desc");
        echo "<table width=800px>";        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id = $t_page['id'];
                $name = $t_page['name'];
                $date_news = $t_page['data'];
                $date_com = date("Y F d h:i:s", strtotime($date_news));
                
                $date_com = format_date_html($date_com);
                $whot = $t_page['whot'];
                echo "<tr><td>$date_com $time_com</td>";
                echo "<td>$whot</td></tr>";
            }
        }

?>
</table>
</center>
	</div>
	<div id="two_column">
		<?php	include ('spisok.php');?>
	</div>
</div>