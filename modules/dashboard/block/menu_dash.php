<?
$dash_tip = $this->sql_query("m_dash_tip", "join m_dash_tip_lang
on m_dash_tip.id_dash_tip = m_dash_tip_lang.id_dash_dash
where m_dash_tip_lang.id_lang = '" . $this->setting['id_lang'] . "' order by nomer_dash_tip");
if ($dash_tip==true):?>
<div id="accordion">
    <? foreach ($dash_tip as $tip): ?>
        <h3><?= $tip['name_tip_dash']; ?></h3>
        <div><ul>
            <?
//получаем меню
            $dash_menu = $this->sql_query("m_dash_menu", "join m_dash_menu_lang
on m_dash_menu.id_menu_dash = m_dash_menu_lang.id_dash_menu
where m_dash_menu_lang.id_lang = '" . $this->setting['id_lang'] . "' and id_tip_dash = '" . $tip['id_dash_tip'] . "'");
            foreach ($dash_menu as $menu): ?>
                <li><a href="<?= $setting['site'] ?><?= $menu['address_menu_dash'] ?>"><?= $menu['name_dash_menu'] ?></a></li>
            <? endforeach; ?>
            </ul>
        </div>
    <? endforeach; ?>
</div>
<?endif;?>