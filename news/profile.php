<?php

/**
 * @author Yerick
 * @copyright 2009
 * @name YCMS 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
//////////////////////////////////////////////////////////
// ����� �� ������� ������
//////////////////////////////////////////////////////////
function opros21()
{
   global $id_user, $site, $name_site, $god_site;

   $ok_page = mysql_query("select * from room_opros where id = $id_user");	
   $id_user = $t_opros["id"];

?>
<table cellspacing=0 cellpadding=0 align=center>
<tr class=top><th>&nbsp;</th><th>��</th><th colspan=3>��</th><th colspan=3>��</th><th>��</th></tr>
<tr class=bottom><th>&nbsp;</th><th>����</th><th>�������</th><th>����</th><th>����</th><th>�������</th><th>����</th><th>����</th><th>�������</th></tr>
<?php

$cnt = 0;
while ($t_opros = mysql_fetch_array($ok_page))
{
		  $opros = @json_decode($t_opros["data"]);
         $id_user = $t_opros["id"];
$class = ($cnt %2 == 0)?'even':'odd';
         echo "<tr class='$class'><td>$user</td>";
?>
		<td><?php if($opros->pitanie == "2" && in_array("1", $opros->pitanie_choice)) { ?>+<?php } ?></td>

		<td class='breakfast'><?php if($opros->pitanie == "2" && in_array("2", $opros->pitanie_choice)) { ?>+<?php } ?></td>
		<td><?php if($opros->pitanie == "2" && in_array("3", $opros->pitanie_choice)) { ?>+<?php } ?></td>
		<td><?php if($opros->pitanie == "2" && in_array("4", $opros->pitanie_choice)) { ?>+<?php } ?></td>

		<td class='breakfast'><?php if($opros->pitanie == "2" && in_array("5", $opros->pitanie_choice)) { ?>+<?php } ?></td>
		<td><?php if($opros->pitanie == "2" && in_array("6", $opros->pitanie_choice)) { ?>+<?php } ?></td>
		<td><?php if($opros->pitanie == "2" && in_array("7", $opros->pitanie_choice)) { ?>+<?php } ?></td>

		<td class='breakfast'><?php if($opros->pitanie == "2" && in_array("8", $opros->pitanie_choice)) { ?>+<?php } ?></td>
</tr>
<?php 
}
echo "</table>";
}


function opros2() 
{ 
   global $id_user, $site, $name_site, $god_site;
   $ok_page = mysql_query("select * from room_opros where id = $id_user");
	
$t_opros = mysql_fetch_array($ok_page);
$res = 1;

   if (!empty($t_opros))
   {
$res = 1;
	if (1) {
if (!empty($t_opros["data"])) {
	$opros = @json_decode($t_opros["data"]);
	if (!empty($opros)) {

	?>
	<div id="choice_view"><fieldset style="margin-top:10px;">�� �������: 
<?php if ($opros->pitanie == "1") { echo "<Strong>�� ���� �������� � ��������</Strong>"; } ?>
<?php if ($opros->pitanie == "2") { echo "<Strong>���� �������� � ��������</Strong>";  ?>


	<div style='margin-left: 10px; margin-top: 10px;'>
<div style='float:left; width: 100px'>
		<strong>�������</strong><br />
		<?php if(in_array("1", $opros->pitanie_choice)) { ?>����<?php } ?><br />
</div>
<div style='float:left; width: 100px'>
		<strong>�������</strong><br />
		<?php if(in_array("2", $opros->pitanie_choice)) { ?>�������<?php } ?><br />
		<?php if(in_array("3", $opros->pitanie_choice)) { ?>����<?php } ?><br />
		<?php if(in_array("4", $opros->pitanie_choice)) { ?>����<?php } ?><br />
</div>
<div style='float:left; width: 100px'>
		<strong>�������</strong><br />
		<?php if(in_array("5", $opros->pitanie_choice)) { ?>�������<?php } ?><br />
		<?php if(in_array("6", $opros->pitanie_choice)) { ?>����<?php } ?><br />
		<?php if(in_array("7", $opros->pitanie_choice)) { ?>����<?php } ?><br />
</div>
<div style='float:left; width: 100px'>
		<strong>�����������</strong><br />
		<?php if(in_array("8", $opros->pitanie_choice)) { ?>�������<?php } ?><br />
</div>
	</div> 
<?php } ?>
<Br style="clear:both;"/>
<a id='edit_pitanie_choice' href='#'>��������</a>
</fieldset>
</div>
<?php
	}

}

	}
}  else {
$res = 2;
}
?>
<?php if (1) { ?>
<br/><br/>
<div class='form' id="form_choice" style="display: <?php echo ($res == 2)?"block":"none" ?>;">
<form action="room_opros_save.php" id='opros_form' method='post' >
   <!-- fieldset><legend>����������</legend>

   <input type="radio" name='prozhivanie' id='prozhivanie_1' value='1' checked/><label for="prozhivanie_1">�������</label><br/>
   <input type="radio" name='prozhivanie' id='prozhivanie_2' value='2' /><label for="prozhivanie_2">��������</label><br/>
   <input type="radio" name='prozhivanie' id='prozhivanie_3' value='3' /><label for="prozhivanie_3">����</label><br/>
   <input type="radio" name='prozhivanie' id='prozhivanie_4' value='4' /><label for="prozhivanie_4">�������</label><br/>
</fieldset -->
   <fieldset><legend>�������</legend>
   <input type="radio" name='pitanie' id='pitanie_1' value='1' <?php if(($res == 2) ||  ($opros->pitanie == "1")) { ?>checked<?php } ?>/><label for="pitanie_1" checked>�� ���� �������� � �������� </label><br/>
   <input type="radio" name='pitanie' id='pitanie_2' value='2' <?php if($opros->pitanie == "2") { ?>checked<?php } ?>/><label for="pitanie_2">���� �������� � ��������</label><br/>
	<div id='pitanie_choice' style='margin-left: 10px; margin-top: 10px;display: none;'>
<div style='float:left; width: 100px'>
		<strong>�������</strong><br />
		<input type='checkbox' name='pitanie_choice[]' value='1' id='pitanie_choice_1' <?php if(($res == 2) || in_array("1", $opros->pitanie_choice)) { ?>checked<?php } ?>/><label for='pitanie_choice_1'> ����</label><br />
</div>
<div style='float:left; width: 100px'>
		<strong>�������</strong><br />
		<input type='checkbox' name='pitanie_choice[]' value='2' id='pitanie_choice_2' <?php if(($res == 2) || in_array("2", $opros->pitanie_choice)) { ?>checked<?php } ?>/><label for='pitanie_choice_2'> �������</label><br />
		<input type='checkbox' name='pitanie_choice[]' value='3' id='pitanie_choice_3' <?php if(($res == 2) || in_array("3", $opros->pitanie_choice)) { ?>checked<?php } ?>/><label for='pitanie_choice_3'> ����</label><br />
		<input type='checkbox' name='pitanie_choice[]' value='4' id='pitanie_choice_4' <?php if(($res == 2) || in_array("4", $opros->pitanie_choice)) { ?>checked<?php } ?>/><label for='pitanie_choice_4'> ����</label><br />
</div>
<div style='float:left; width: 100px'>
		<strong>�������</strong><br />
		<input type='checkbox' name='pitanie_choice[]' value='5' id='pitanie_choice_5' <?php if(($res == 2) || in_array("5", $opros->pitanie_choice)) { ?>checked<?php } ?>/><label for='pitanie_choice_5'> �������</label><br />
		<input type='checkbox' name='pitanie_choice[]' value='6' id='pitanie_choice_6' <?php if(($res == 2) || in_array("6", $opros->pitanie_choice)) { ?>checked<?php } ?>/><label for='pitanie_choice_6'> ����</label><br />
		<input type='checkbox' name='pitanie_choice[]' value='7' id='pitanie_choice_7' <?php if(($res == 2) || in_array("7", $opros->pitanie_choice)) { ?>checked<?php } ?>/><label for='pitanie_choice_7'> ����</label><br />
</div>
<div style='float:left; width: 100px'>
		<strong>�����������</strong><br />
		<input type='checkbox' name='pitanie_choice[]' value='8' id='pitanie_choice_8' <?php if(($res == 2) || in_array("8", $opros->pitanie_choice)) { ?>checked<?php } ?>/><label for='pitanie_choice_8'> �������</label><br />
</div>
	</div> 
</fieldset>

<script>
var check_pitanie = function () {
var b = $('#pitanie_2').attr('checked' );

	if (b) {
		$('#pitanie_choice').slideDown();
	} else {
		$('#pitanie_choice').hide();
}
};
$('#pitanie_2, #pitanie_1').click(function () {
check_pitanie();
});
check_pitanie();

$('#opros_form').submit(function () {

});

$('#edit_pitanie_choice').click(function () {
	$('#choice_view').hide();
	$('#form_choice').slideDown();
});
</script>
<input type=submit value="<?php if ($res == "2") { echo "����������";} else {echo "���������";} ?> "/> 
</form>
</div>
<?php
}

return $res;
}
//////////////////////////////////////////////////////////
// ����� �� ������� �����
//////////////////////////////////////////////////////////
function action() {
    global $id_user, $site, $god_site;
    if ($id_user == "") {
        error(6);
    } else {
        $adm = dostup_adm();
        if (isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
        } else {
            $id = $id_user;
        }
        $query = "select * From `us` where `id_us` = '" . $id . "'";
        $result = mysql_query($query); {
            while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $act_us = "$link[act_us]";
                $id_u = "$link[id_us]";
                $name_us = "$link[name_us]";
                $fam_us = "$link[fam_us]";
                $tip_us = "$link[tip_us]";
                $nick_us = "$link[nick_us]";
                if ($tip_us == "9") {
                    $nick_us = "<strike>$nick_us</strike>";
                }
                $gorod_us = "$link[gorod_us]";
                $login_us = "$link[login_us]";
                $pass_us = "$link[pass_us]";
                $act_us = "$link[act_us]";
                $mail_us = "$link[mail_us]";
                $telefon_us = "$link[telefon_us]";
                $passport_us = "$link[passport_us]";
                $foto_us = "$link[foto_us]";
                $osebe = nl2br($link[osebe]);
                $god_us = "$link[god_us]";
                $contact = "$link[contact]";
                $contact = nl2br($link[contact]);
                $master = "$link[master]";
                $interest = "$link[interest]";
                $interest = nl2br($link[interest]);
            }
        }
        $site_info = mysql_query("select * from setting_site");
        while ($site_i = mysql_fetch_array($site_info)) {
            $oth_on = $site_i['oth_on'];
            $god_on = $site_i['god_on'];
            $pass_on = $site_i['pass_on'];
            $telefon_on = $site_i['telefon_on'];
            $osebe_on = $site_i['osebe_on'];
            $contact_on = $site_i['contact_on'];
            $interest_on = $site_i['interest_on'];
        }
        echo "
<div class = bl>
";
        $pict = "user/photo/$id_u.jpg";
        if (file_exists($pict)) {
            list($width, $height, $type, $attr) = getimagesize($pict);
            if ($height > $width) {
                $vis1 = height;
            } else {
                $vis1 = width;
            }
            echo "
<img src= \"$pict\" $vis1=\"180\"  border=\"0\" alt = \"$nick_us: $name_us $fam_us\">";
        } else {
            echo "
<img src= \"img/no.jpg\" border=\"0\" alt = \"$nick_us: $name_us $fam_us\">";
        }
        if ($adm == 1  or $id_user=="539") {
            echo "<p>����� - $login_us<br> <a href = \"$site/admin.php?id=5&us=$id_u\">��� ������������</a>";
        }
        $adm = dostup_adm();
        $org = dostup_org_god($god_site);
        if ($adm == "1" or $org == "1") {
            echo "<br><a href = \"$site/org/ad.php?us=$id_u\">��������� �����</a>";
        }
		//������ ���������
        $status = status($id_u);
        if ($status == "2") {
            $poselen = poselen($id_u); {
                if (!($poselen == "")) {
                    $ok_page = mysql_query("select room_us.*, room.tip from room_us JOIN room ON room_us.id_command = room.id where id_us = $id_u and god = $god_site");
                    while ($t_page = mysql_fetch_array($ok_page)) {
                        $id_room = $t_page['id_command'];
						$tip_opl = $t_page['tip_opl'];
						$tip_room = $t_page['tip'];
						$summa_opl = $t_page['summa_opl'];
						$name_room = name_room($id_room);
							$ok_page = mysql_query("select * from sibkon where god = $god_site");
								while ($t_page = mysql_fetch_array($ok_page)) 
								{
									$st_lux = $t_page['st_lux'];
									$st_spa = $t_page['st_spa'];
									$st_kro = $t_page['st_kro'];
									$orgvznos = $t_page['orgvzos'];
									$summ_k = $t_page['st_kro']+$t_page['orgvzos'];
									$summ_l = $t_page['st_lux']+$t_page['orgvzos'];
									$summ_s = $t_page['st_spa']+$t_page['orgvzos'];
								}
					if ($tip_room != 4) 
                    echo "<p>����������: $name_room ";
						else 
							echo "<p>������� ����������";
							
					} 
					//��� �������
					if ($id_u == $id_user or $adm == 1 or $master == $id_user or $id_user=="539") {
					if ($tip_room == 1){			
                    echo "<p>��� ���������: �������<br>";
						if ($tip_opl == 0){
							echo "�����: $orgvznos.�<br>";
							echo "����������: $st_kro.�<br>";
							echo "������ ������, �������� ������: "; $poln=$summ_k - $summa_opl; echo "$poln.�";
							} else {if ($tip_opl == 1) {
								echo "����������: $st_kro.�<br>";
								echo "������ ��� ������, �������� ������: "; $poln=$st_kro - $summa_opl; echo"$poln.�";
									}else if ($tip_opl == 2) {
									echo "�����: $orgvznos.�<br>";
									echo "������ ��� ����������, �������� ������: "; $poln=$orgvznos - $summa_opl; echo"$poln.�";
											}else if ($tip_opl == 3) {
												echo "<br>";
												}
									}											
					} else {
							if ($tip_room == 3) {
							echo "<p>��� ���������: ����<br>";
							
						if ($tip_opl == 0){
							echo "������ ������, �������� ������: "; $poln=$summ_l - $summa_opl; echo "$poln.�";
							echo "�����: $orgvznos.�<br>";
							echo "����������: $st_lux.�<br>";
							} else {if ($tip_opl == 1) {
								echo "����������: $st_lux.�<br>";
								echo "������ ��� ������, �������� ������: "; $poln=$st_lux - $summa_opl; echo"$poln.�";
									}else if ($tip_opl == 2) {
										echo "�����: $orgvznos.�<br>";
										echo "������ ��� ����������, �������� ������: "; $poln=$orgvznos - $summa_opl; echo"$poln.�";
											}else if ($tip_opl == 3) {
												echo "<br>";
												}
									}
							} else 
								{
								if ($tip_room == 2) {
									echo "<p>��� ���������: ��������<br>";
									
						if ($tip_opl == 0){
							echo "�����: $orgvznos.�<br>";
							echo "����������: $st_spa.�<br>";
							echo "������ ������, �������� ������: "; $poln=$summ_s - $summa_opl; echo "$poln.�";
							} else {if ($tip_opl == 1) {
							echo "����������: $st_spa.�<br>";
							echo "������ ��� ������, �������� ������: "; $poln=$st_spa - $summa_opl; echo"$poln.�";
									}else if ($tip_opl == 2) {
									echo "�����: $orgvznos.�<br>";
									echo "������ ��� ����������, �������� ������: "; $poln=$orgvznos - $summa_opl; echo"$poln.�";
											}else if ($tip_opl == 3) {
												echo "<br>";
												}
									}
									}
								}
							}					
                		//����� ������
							if ($tip_opl == 3)
							echo "��� ����� ������ � ���������";
							 else 
							echo "<br>�������: $summa_opl";
							}
					//����� ����� ������
					//�������� ����� ������
							if ($id_user=="539") {
							echo "<div style=\"border:1px solid black; padding:5px;\">
							�������� ��������� �����:
							<form method=post action=opl.php?id=$id>
							<input style=\"width:60px;\" type=text name=summa_opl value = $summa_opl>";
							
							$ok_page = mysql_query("select * from room_us where  id_us=$id_u and god = $god_site");
								while ($t_page = mysql_fetch_array($ok_page))
							   {
								  $tip_opl = $t_page['tip_opl'];
							  echo "
							<SELECT NAME=\"tip_opl\" SIZE=\"1\">
								<OPTION VALUE=\"0\" ";
							if ($tip_opl == 0) {
								echo "selected";
							}
							echo " >������ ������</OPTION>
							   <OPTION VALUE=\"1\" ";
							if ($tip_opl == 1) {
								echo "selected";
							}
							echo " >��� ����� ������</OPTION>
							   <OPTION VALUE=\"2\" ";
							if ($tip_opl == 2) {
								echo "selected";
							}
							echo " >��� ����� ����������</OPTION>
							   <OPTION VALUE=\"3\" ";
							if ($tip_opl == 3) {
								echo "selected";
							}
							echo " >���������</OPTION>
						   </SELECT>";
						   }
						   echo "
							<input type=submit value=�������� name=submit>
							</form>
							</div>";							
							}
					//����� �������� ����� ������
				}
            }
        }
		//����� ������� ���������


        echo "<p><a href = \"$site/message.php?id=$id_u\">�������� ���������</a><br>";
        echo "<a href = \"$site/query.php?id_user=$id_u\">����������</a></p>";
        echo "</div>";
		echo "<div class = br>
<div id=\"accordio\">		
<h3><a href=\"#\">������:</a></h3>
<div>		
<table>
<tr><td>���</td><td>$nick_us</td></tr>";
        if (!($master == "0")) {
            echo "<b>���������� </b>";
            user_information($master);
        }
        echo "
<tr><td>�������</td><td>$fam_us</td></tr>
<tr><td>���</td><td>$name_us</td></tr>
<tr><td>�����: </td><td><a href = \"$site/users.php?g=$gorod_us\">$gorod_us</a></td></tr>";
        if ($god_on == "1") {
            echo "<tr><td>��� ��������: </td><td>$god_us</td></tr>";
        }
        echo "</table></div>";
        if ($osebe_on == "1") {
            echo "<h3><a href=\"#\">O ����:</a></h3><div>$osebe</div>";
        }
        if ($interest_on == "1") {
            echo "<h3><a href=\"#\">��������:</a></h3><div>$interest</div>";
        }
        if ($contact_on == "1") {
            echo "<h3><a href=\"#\">��������:</a></h3><div>$contact</div>";
        }
		if ($id_u == $id_user or $adm == 1 or $id_user=="539") {
		
			echo "<h3><a href=\"#\">�������:</a></h3><div>"; opros21(); echo"</div>";				
		}
        echo "</div></div>
";
        if ($id_u == $id_user or $adm == 1 or $master == $id_user or $id_user=="539") {
            echo "
<p>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/profile/del.php?id=$id\">������� ������������</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"profile/edit.php?id=$id_u\">�������������</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>";

        }
    }
}

function title() {
    global $name_site; {
        if (isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
        } else {
            $id = $id_user;
        }
        $query = "select * From `us` where `id_us` = '" . $id . "'";
        $result = mysql_query($query);
        while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $nick_us = "$link[nick_us]";
        }
    }
    echo "
<title>$nick_us | $name_site</title>
";
}

function right() {
    global $id_user, $name_site, $site; {
        if (!($id_user == "")) {
            if (isset($_GET['id'])) {
                $id = addslashes($_GET['id']);
            } else {
                $id = $id_user;
            }
            $ok_reg = mysql_query("select * From `us` where `master` = '" . $id . "'");
            $itog_reg1 = mysql_num_rows($ok_reg);
            if ($itog_reg1 > "0") {
                echo "<h4>���������x ($itog_reg1)</h4>";
                echo "<table>";
                $query = "select * From `us` where `master` = '" . $id . "' order by nick_us";
                $result = mysql_query($query);
                while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    $id_master = "$link[id_us]";
                    $id_m = "$link[master]";
                    $podop = user_info($id_master);
                    echo "<tr><td>$podop</td>";
                    if ($id_m == $id_user) {
                        echo "<td><a href=\"$site/profile/del_podop.php?id=$id_master\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
            if ($id == $id_user) {
                echo "<p><a href = \"$site/reg.php?id=2\">�������������� ������ �����������</a></p>";
            }
        }
    }
}

require ("theme/$theme/$theme.htm");
?>