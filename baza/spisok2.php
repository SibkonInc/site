<head>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/select2.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/select2.min.js"></script>
        <script type="text/javascript">
		$(".js-example-basic-multiple").select2();

    
        </script>
</head>

<div id="light-pagination" class="pagination">
Поиск среди участников
<input id="txtSearch" name="txtSearchPattern" type="search" />
		<?php
		if (isset($_GET['g']))
		{
			$g = addslashes($_GET['g']);
		}
		else
		{
			$g = "";
		}
		if (!($g == ""))
		{
			$query = "select * From `us` where act_us = '1' and gorod_us = '$g'";
		}
		else
		{
			$query = "select * From `us` where act_us = '1'";
		}
		$result = mysql_query($query) or die("Query failed : " . mysql_error());
		while ($link = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$id_us = "$link[id_us]";
			$name_us = "$link[name_us]";
			$fam_us = "$link[fam_us]";
			$nick_us = "$link[nick_us]";
			$all = $fam_us.' '. $name_us;
			echo "
			 <ul  class=js-example-basic-multiple multiple=multiple>
 <li>$all <b><a title = \"$nick_us\" href = \"profile.php?id=$id_us\">$nick_us</a></b></li>
</ul>
";
		}
// Закрыть соединение с БД
mysql_close();		
		?>
		</div>