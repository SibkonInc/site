<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <link type="text/css" rel="stylesheet" href="<?=$setting['site'];?>modules/dashboard/theme/dashboard/theme.css" media="all">
        <script type="text/javascript" src="<?=$setting['site'];?>js/jquery.js"></script>
        <script type="text/javascript" src="<?=$setting['site'];?>js/jquery-ui.js"></script>
        <link type="text/css" rel="stylesheet" href="<?=$setting['site'];?>modules/dashboard/theme/dashboard/charts.css" media="all">
        <link type="text/css" rel="stylesheet" href="<?=$setting['site'];?>modules/dashboard/theme/dashboard/css/redmond/jquery-ui-1.8.4.custom.css" media="all">
        <link type="text/css" rel="stylesheet" href="<?=$setting['site'];?>js/jgrowl.css" media="all">
        <script type="text/javascript" src="<?=$setting['site'];?>js/jgrowl.js"></script>
        <title><?= $setting['name']; ?> | <?= $page; ?></title>
        <? if (isset($meta)): ?><?=$meta; ?>
        <!--[if lt IE 9]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta3)/IE9.js"></script><![endif]-->
        <? endif; ?>
        <script type="text/javascript">
            $(function(){
                $("#accordion").accordion({
                    autoHeight: false,
                    navigation: true
                });
            });
        </script>
    </head>
        <body>
            <div id="wrapper">
                <div id="header">

                </div>
                <!--верхнее меню-->
                <div id ="menu">
                    <!--
                    <div class="bl_left_menu">
                        <div class="main_menu">
                            <ul>
                <? foreach ($menu_top as $men): ?>
                <? $dostup = $ycms->access_dostup($men['access']) ?>
                <? if ($dostup['access_view'] == "1"): ?>
                                         <li>
                                             <a class="link" href ="<?= $setting['site'] ?><?= $men['adress'] ?>"><?= $men['menu_name'] ?>
                                             </a>
                                        </li>
                <? endif; ?>
                <? endforeach; ?>
                                    </ul>        
                                </div>

                            </div>
                        -->
                        <div class="bl_right_menu" align="right">

                    <? foreach ($menu_lang as $men_lang): ?>
                            <a href ="<?= $setting['site'] ?>lang.php?id=<?= $men_lang['id'] ?>"><img src="<?= $setting['site'] ?><?= $men_lang['img'] ?>" alt="<?= $men_lang['article'] ?>" title ="<?= $men_lang['name_lang'] ?>"></a>
                    <? endforeach; ?>
                </div>
            </div>
            <!--конец верхнего меню-->
            <div id="container">
                <div id="left">
    <!--левый блок (меню)-->
    <?  include_once 'modules/dashboard/block/menu_dash.php';?>
</div>
<!--конец левого блока (меню)-->
<!--Основной блок-->
<div id="content">

