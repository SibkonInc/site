<?php

class admin_index extends ycms {

    var $admin;
    var $module_info;
    var $identifcator = "admin";
    var $setting;

    function start() {
        global $setting, $user;
        $this->module_info = $this->sql_query_one("module", "join module_lang on module.id = module_lang.id_id where module.identif = '" . $this->identifcator . "' and module_lang.id_lang = '" . $setting['id_lang'] . "'");
        $setting['module_id'] = $this->module_info['id'];
        $this->access = $this->access_admin();
        $this->setting = $setting;

        if ($this->access == true) {
            $url = "";
            $url = $this->get_url();
            switch ($url['action']) {
                case 'lang': $this->lang();
                    break;
                case 'lang_add': $this->lang_add();
                    break;
                case 'lang_edit': $this->lang_edit($url['id']);
                    break;
                case 'lang_del': $this->lang_del($url['id']);
                    break;
                case 'lang_del_post': $this->lang_del_post($url['id']);
                    break;
                case 'site': $this->site();
                    break;
                case 'site_edit': $this->site_edit($url['id']);
                    break;
                case 'site_add': $this->site_add();
                    break;
                case 'block': $this->block(($url['id']));
                    break;
                case 'block_add': $this->block_add();
                    break;
                case 'block_edit': $this->block_edit($url['id']);
                    break;
                case 'add_block_lang_name': $this->add_block_lang_name($url['id']);
                    break;
                case 'block_edit_post': $this->block_edit_post($url['id']);
                    break;
                case 'block_del': $this->block_del($url['id']);
                    break;
                case 'access': $this->access($url['id']);
                    break;
                case 'module': $this->module($url['id']);
                    break;
                case 'module_add': $this->module_add($url['id']);
                    break;
                case 'module_edit': $this->module_edit($url['id']);
                    break;
                case 'module_edit_post': $this->module_edit_post($url['id']);
                    break;
                case 'menu': $this->menu_admin($url['id']);
                    break;
                case 'menu_add': $this->menu_admin_add($url['id']);
                    break;
                case 'menu_edit': $this->menu_admin_edit($url['id']);
                    break;
                case 'menu_del': $this->menu_admin_del($url['id']);
                    break;
                default: $this->index();
                    break;
            }
        }
    }

    function load_admin($data, $tip="1") {
        global $ycms, $start, $setting, $lang;
        $menu_top = $this->menu("top", $setting['id_lang']);
        $html = $this->load("html");
        $menu_lang = $lang;
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        require_once ("modules/admin/html/admin_html_head.php");
        if (isset($data['file'])) {
            require_once ($data['file']); //код основной для модуля
        }
        require_once ("modules/admin/html/admin_html_footer.php");
    }

    function menu_admin() {
        $data['page'] = $this->module_info['name'] . " | Управление меню";
        $data['meta'] = "";
        $data['menu_data'] = $this->sql_query("menu");
        $data['file'] = "modules/admin/html/menu_html.php";
        $this->load_admin($data);
    }

    function menu_admin_add($id) {
        global $lang;
        $data = array();
        $message = array();
        $post = array();
        if (empty($_POST)) {
            $data['page'] = $this->module_info['name'] . " | Добавление меню";
            $data['meta'] = "";
            $where = "join menu_lang
on menu.id = menu_lang.menu_id_id
where menu_lang.menu_id_lang = '" . $this->setting['id_lang'] . "'";
            $data['id_id_data'] = $this->sql_query("menu", $where);
            $data['access_data'] = $this->sql_query("access_group");
            $data['file'] = "modules/admin/html/menu_add_html.php";
            $this->load_admin($data);
        } else {

            isset($_POST['adress']) ? $post['adress'] = $_POST['adress'] : false;
            isset($_POST['id_id']) ? $post['id_id'] = $_POST['id_id'] : false;
            isset($_POST['position']) ? $post['position'] = $_POST['position'] : false;
            isset($_POST['access']) ? $post['access'] = $_POST['access'] : false;
            isset($_POST['nomer']) ? $post['nomer'] = $_POST['nomer'] : false;
            $id_post = $this->insert("menu", $post);
            if ($id_post == false) {
                $message[] = "Данные занесены не было";
            } else {
                $message[] = "Парнер добавлен";

                foreach ($lang as $langu) {
                    $post_lang = array();
                    isset($_POST['add_menu_name' . $langu['id']]) ? $post_lang['menu_name'] = $_POST['add_menu_name' . $langu['id']] : false;
                    if ($post_lang == true) {
                        $post_lang['menu_id_id'] = "$id_post";
                        $post_lang['menu_id_lang'] = $langu['id'];
                        $id_lang = $this->insert("menu_lang", $post_lang);
                        if ($id_lang == true) {
                            $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                        }
                    }
                }
            } $this->menu_admin();
        }
    }

    function menu_admin_edit($id) {
        global $lang;
        $data = array();
        $message = array();
        $post = array();
        if (empty($_POST)) {
            $data['page'] = $this->module_info['name'] . " | Добавление меню";
            $data['meta'] = "";
            $where = "join menu_lang
on menu.id = menu_lang.menu_id_id
where menu_lang.menu_id_lang = '" . $this->setting['id_lang'] . "'";
            $data['id_id_data'] = $this->sql_query("menu", $where);
            $data['access_data'] = $this->sql_query("access_group");
            $data['menu_data'] = $this->sql_query_one("menu", "where id = '" . $id . "'");
            $data['file'] = "modules/admin/html/menu_edit_html.php";
            $this->load_admin($data);
        } else {

            isset($_POST['adress']) ? $post['adress'] = $_POST['adress'] : false;
            isset($_POST['id_id']) ? $post['id_id'] = $_POST['id_id'] : false;
            isset($_POST['position']) ? $post['position'] = $_POST['position'] : false;
            isset($_POST['access']) ? $post['access'] = $_POST['access'] : false;
            isset($_POST['nomer']) ? $post['nomer'] = $_POST['nomer'] : false;
            $id_post = $this->sql_edit("menu", $post, "
                            where id = '" . $id . "'");
            if ($id_post == false) {
                $message[] = "Данные занесены не было";
            } else {
                $message[] = "Парнер добавлен";
            }
            foreach ($lang as $langu) {
                $post_lang = array();

                isset($_POST['menu_name' . $langu['id']]) ? $post_lang['menu_name'] = $_POST['menu_name' . $langu['id']] : false;
                if ($post_lang == true) {
                    $this->sql_edit("menu_lang", $post_lang, "
                            where menu_id_id = '" . $id . "' and menu_id_lang='" . $langu['id'] . "'");
                }
                $post_lang_add = array();
                isset($_POST['add_menu_name' . $langu['id']]) ? $post_lang_add['menu_name'] = $_POST['add_menu_name' . $langu['id']] : false;

                if ($post_lang_add == true) {
                    $post_lang_add['menu_id_id'] = "$id";
                    $post_lang_add['menu_id_lang'] = $langu['id'];
                    $id_lang_add = $this->insert("menu_lang", $post_lang_add);
                    if ($id_lang_add == true) {
                        $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                    }
                }
            }

            $this->menu_admin();
        }
    }
   function menu_admin_del($id) {

        $data['ok'] = $this->sql_del("menu", "where id = '" . $id . "'");
        $this->menu_admin();
    }
    function access_page($id) {
        $data['page'] = $this->admin['page'] . " | Уровни доступа";
        $data['meta'] = "";
        if (empty($id)) {
            $data['acesss'] = $this->sql_query("access_group", "join access
on access_group.access_id_group = access.access_id");
            $data['file'] = "modules/admin/html/access_html.php";
        }
        $this->load_admin($data);
    }

    function lang() {
        $data['page'] = $this->admin['page'] . " | Просмотр языков";
        $data['meta'] = '
            <link type="text/css" rel="stylesheet" href="/js/jtip.css" media="all">
            <script src="/js/jtip.js" type="text/javascript"></script>
            ';
        $data['file'] = "modules/admin/html/lang_html.php";
        $data['lang'] = $this->sql_query("lang");
        $this->load_admin($data);
    }

    function lang_add() {
        $data['page'] = $this->admin['page'] . " | Добавление нового языка";
        $data['meta'] = "";
        if (empty($_POST)) {
            $data['file'] = "modules/admin/html/lang_html_add.php";
            $data['lang'] = $this->sql_query("lang");
            $this->load_admin($data);
        } else {
            $data['ok'] = $this->insert("lang", $_POST);
            $data['file'] = "modules/admin/html/lang_html_add.php";
            $data['lang'] = $this->sql_query("lang");
            $this->load_admin($data);
        }
    }

    function lang_edit($id) {
        $data['page'] = $this->admin['page'] . " | Изменение языка";
        $data['meta'] = "";

        if (empty($_POST)) {

            $data['lang'] = $this->sql_query_one("lang", "where id = $id");
            $data['file'] = "modules/admin/html/lang_html_edit.php";
            $this->load_admin($data);
        } else {
            $data['ok'] = $this->sql_edit("lang", "where id = $id", $_POST);
            $data['lang'] = $this->sql_query_one("lang", "where id = $id");
            $data['file'] = "modules/admin/html/lang_html_edit.php";
            $this->load_admin($data);
        }
    }

    function lang_del($id) {

        $data['page'] = $this->admin['page'] . " | Удаление языка";
        $data['meta'] = "";
        $data['lang'] = $this->sql_query_one("lang", "where id = $id");
        $data['file'] = "modules/admin/html/lang_html_del.php";
        $this->load_admin($data);
    }

    function lang_del_post($id) {

        $data['page'] = $this->admin['page'] . " | Удаление языка";
        $data['meta'] = "";
        $data['ok'] = $this->sql_del("lang", "where id = '" . $id . "'");
        $data['file'] = "modules/admin/html/lang_html_del.php";
        $this->load_admin($data);
    }

    function site() {
        global $setting;
        $data['page'] = $this->admin['page'] . " | Настройки сайта";
        $data['meta'] = '
            <link type="text/css" rel="stylesheet" href="/js/jtip.css" media="all">
            <script src="/js/jtip.js" type="text/javascript"></script>
            ';
        $data['file'] = "modules/admin/html/site_html.php";
        $where = "";
        $data['lang'] = $this->sql_query("lang");
        $data['tip_user'] = $this->sql_query("tip_user");
        $data['site'] = $this->sql_query_one("setting");
        $wer_mod = "join module_lang on module.id = module_lang.id_id where module_lang.id_lang = '" . $setting['id_lang'] . "' ";
        $data['module'] = $this->sql_query("module", $wer_mod);
        $this->load_admin($data);
    }

    function site_edit($id) {
        global $setting;
        if ($id == false) {
            $data['ok'] = $this->sql_edit("setting", $_POST);
        } else {
            $data['ok'] = $this->sql_edit("setting_lang", $_POST, "where id = '" . $id . "'");
        }

        $data['page'] = $this->admin['page'] . " | Настройки языков сайта";
        $data['meta'] = '
            <link type="text/css" rel="stylesheet" href="/js/jtip.css" media="all">
            <script src="/js/jtip.js" type="text/javascript"></script>
            ';
        $data['file'] = "modules/admin/html/site_html.php";
        $where = "";
        $data['lang'] = $this->sql_query("lang");
        $data['tip_user'] = $this->sql_query("tip_user");
        $data['site'] = $this->sql_query_one("setting");
        $wer_mod = "join module_lang on module.id = module_lang.id_id where module_lang.id_lang = '" . $setting['id_lang'] . "' ";
        $data['module'] = $this->sql_query("module", $wer_mod);
        $this->load_admin($data);
    }

    function site_add() {
        global $setting;
        $data['ok'] = $this->insert("setting_lang", $_POST);

        $data['page'] = $this->admin['page'] . " | Добавление языковых настроек сайта";
        $data['meta'] = '
            <link type="text/css" rel="stylesheet" href="/js/jtip.css" media="all">
            <script src="/js/jtip.js" type="text/javascript"></script>
            ';
        $data['file'] = "modules/admin/html/site_html.php";
        $where = "";
        $data['lang'] = $this->sql_query("lang");
        $data['site'] = $this->sql_query_one("setting");
        $wer_mod = "join module_lang on module.id = module_lang.id_id where module_lang.id_lang = '" . $setting['id_lang'] . "' ";
        $data['module'] = $this->sql_query("module", $wer_mod);
        $this->load_admin($data);
    }

    function block($id) {
        if (empty($id) or $id == "all") {
            $data['page'] = $this->admin['page'] . " | Просмотр блоков";
            $data['meta'] = '
            <link type="text/css" rel="stylesheet" href="/js/jtip.css" media="all">
            <script src="/js/jtip.js" type="text/javascript"></script>
            ';
            $data['file'] = "modules/admin/html/block_html.php";
            $data['lang'] = $this->sql_query("lang");
            $data['blocks'] = $this->sql_query("block");
            $this->load_admin($data);
        } else {
            if (is_numeric($id)) {
                $this->block_edit($id);
            } else {
                $this->index();
            }
        }
    }

    function block_add() {
        global $setting;
        $data['page'] = $this->admin['page'] . " | Добавление Блока";
        $data['meta'] = '
            <link type="text/css" rel="stylesheet" href="/js/jtip.css" media="all">
            <script src="/js/jtip.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $setting['site'] . 'ckeditor/ckeditor.js"></script>
	<script src="' . $setting['site'] . 'ckeditor/sample.js" type="text/javascript"></script>
        <script type="text/javascript" src="' . $setting['site'] . 'AjexFileManager/ajex.js"></script>
            ';
        if (empty($_POST)) {
            $where = "join module_lang
on module.id = module_lang.id_id
where module_lang.id_lang = '" . $setting['id_lang'] . "' 
";
            $data['modules'] = $this->sql_query("module", $where);


            $data['file'] = "modules/admin/html/block_add.php";
            $data['lang'] = $this->sql_query("lang");
            $this->load_admin($data);
        } else {
            $post['file'] = $_POST['file'];
            $post['on_off'] = $_POST['on_off'];
            $post['module'] = $_POST['module'];
            $post['position'] = $_POST['position'];
            $post['view'] = $_POST['view'];
            $post['access'] = $_POST['access'];
            $post['top'] = $_POST['top'];
            $post['nomer'] = $_POST['nomer'];
            $id_post = $this->insert("block", $post);
            $lan = $this->sql_query("lang");
            foreach ($lan as $langu) {
                $id_l = $langu['id'];
                $lang['id_lang'] = "$id_l";
                $lang['id_id'] = "$id_post";
                $lang['name'] = $_POST["name" . $id_l];
                if ($post['file'] == "0") {
                    $lang['text'] = $_POST["text" . $id_l];
                }
                $this->insert("block_lang", $lang);
            }
            $this->block_edit($id_post);
        }
    }

    function block_edit($id) {
        global $setting;
        $data['page'] = $this->admin['page'] . " | Редактирование Блока";
        $data['meta'] = '
            <link type="text/css" rel="stylesheet" href="/js/jtip.css" media="all">
            <script src="/js/jtip.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $setting['site'] . 'ckeditor/ckeditor.js"></script>
	<script src="' . $setting['site'] . 'ckeditor/sample.js" type="text/javascript"></script>
        <script type="text/javascript" src="' . $setting['site'] . 'AjexFileManager/ajex.js"></script>
            ';
        $data['file'] = "modules/admin/html/block_edit.php";
        $data['lang'] = $this->sql_query("lang");
        $where = "join module_lang on module.id = module_lang.id_id where module_lang.id_lang = '" . $setting['id_lang'] . "'";
        $data['modules'] = $this->sql_query("module", $where);
        $block_info = $this->sql_query_one("block", "where id = '" . $id . "'");
        $data['access_data'] = $this->sql_query("access", "where access_id='" . $block_info['access'] . "'");
        $data['block_info'] = $block_info;
        $this->load_admin($data);
    }

    function add_block_lang_name($id) {
        global $setting;
        $i = $_GET['id'];


        if (empty($_POST)) {
            $langu = $this->sql_query_one("lang", "where id='" . $id . "'");
            include_once 'modules/admin/html/add_lang_block.php';
        } else {

            $post['id_id'] = $i;
            $post['id_lang'] = $id;
            $post['name'] = $_POST['name'];
            $this->insert("block_lang", $post);
            $this->block_edit($_GET['id']);
        }
    }

    function block_edit_post($id) {
        if (!(empty($_POST))) {
            $post = array();
            $post['file'] = $_POST['file'];
            $post['on_off'] = $_POST['on_off'];
            $post['module'] = $_POST['module'];
            $post['position'] = $_POST['position'];
            $post['view'] = $_POST['view'];
            $post['access'] = $_POST['access'];
            $post['top'] = $_POST['top'];
            $post['nomer'] = $_POST['nomer'];

            $this->sql_edit("block", $post, "where id='" . $id . "'");
            $lan = $this->sql_query("lang");

            foreach ($lan as $langu) {
                $id_l = $langu['id'];
                $lang['id_lang'] = "$id_l";
                $lang['id_id'] = "$id";
                if (isset($_POST["name" . $id_l])) {
                    $lang['name'] = $_POST["name" . $id_l];
                }
                if (isset($_POST["text" . $id_l])) {
                    if ($post['file'] == "0") {
                        $lang['text'] = $_POST["text" . $id_l];
                    }
                }
                $ok = $this->sql_edit("block_lang", $lang, "where id_lang = '" . $id_l . "' and id_id = '" . $id . "'");
                $langa['id_lang'] = "$id_l";
                $langa['id_id'] = "$id";
                if (isset($_POST["addname" . $id_l])) {
                    $langa['name'] = $_POST["addname" . $id_l];
                }
                if ($post['file'] == "0") {
                    if (isset($_POST["addtext" . $id_l])) {
                        $langa['text'] = $_POST["addtext" . $id_l];
                    }
                }
                if (isset($_POST["addname" . $id_l])) {

                    $this->insert("block_lang", $langa);
                }
            }
        }
        $this->block_edit($id);
    }

    function block_del($id) {

        $data['ok'] = $this->sql_del("block", "where id = '" . $id . "'");
        $this->block("all");
    }

    function module($id) {
        if (empty($id) or $id == "all") {
            $data['page'] = $this->module_info['name'] . " | Просмотр модулей";
            $data['meta'] = '
            <link type="text/css" rel="stylesheet" href="/js/jtip.css" media="all">
            <script src="/js/jtip.js" type="text/javascript"></script>
            ';
            $data['file'] = "modules/admin/html/module_html.php";
            $data['lang'] = $this->sql_query("lang");
            $data['modules'] = $this->sql_query("module");
            $this->load_admin($data);
        } else {
            if (is_numeric($id)) {
                $this->module_edit($id);
            } else {
                $this->index();
            }
        }
    }

    function module_edit($id) {
        global $setting;
        $data['page'] = $this->module_info['name'] . " | Редактирование Модуля";
        $data['meta'] = '
            <link type="text/css" rel="stylesheet" href="/js/jtip.css" media="all">
            <script src="/js/jtip.js" type="text/javascript"></script>
            <script type="text/javascript" src="/js/thickbox.js"></script>
            <style type="text/css" media="all">@import "/js/thickbox.css";</style>
            ';
        $data['file'] = "modules/admin/html/module_edit.php";
        $data['lang'] = $this->sql_query("lang");

        $module_info = $this->sql_query_one("module", "where id = '" . $id . "'");
        $data['access_data'] = $this->sql_query("access", "where access_id='" . $module_info['access'] . "'");
        $data['module_info'] = $module_info;
        $this->load_admin($data);
    }
    function module_add($id) {
        global $setting,$lang;
         if (empty($_POST)) {
        $data['page'] = $this->module_info['name'] . " | Добавление Модуля";
        $data['meta'] = '
            <link type="text/css" rel="stylesheet" href="/js/jtip.css" media="all">
            <script src="/js/jtip.js" type="text/javascript"></script>
            <script type="text/javascript" src="/js/thickbox.js"></script>
            <style type="text/css" media="all">@import "/js/thickbox.css";</style>
            ';
        $data['file'] = "modules/admin/html/module_add_html.php";
        $data['access_data'] = $this->sql_query("access_group");
        $this->load_admin($data);
         }
         else{
            $post['file'] = $_POST['file'];
            $post['on_off'] = $_POST['on_off'];
            $post['url'] = $_POST['url'];
            $post['access'] = $_POST['access'];
            $post['identif'] = $_POST['identif'];
            $id_post=$this->insert("module",$post);
            if ($id_post == false) {
                $message[] = "Данные занесены не было";
            } else {
                $message[] = "Парнер добавлен";

                foreach ($lang as $langu) {
                    $post_lang = array();
                    isset($_POST['add_name' . $langu['id']]) ? $post_lang['name'] = $_POST['add_name' . $langu['id']] : false;
                    if ($post_lang == true) {
                        $post_lang['id_id'] = "$id_post";
                        $post_lang['id_lang'] = $langu['id'];
                        $id_lang = $this->insert("module_lang", $post_lang);
                        if ($id_lang == true) {
                            $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                        }
                    }
                }
            } $this->module($id_post);
        }
    }

    function module_edit_post($id) {
        //  var_dump($_POST);

        if (!(empty($_POST))) {
            $post['file'] = $_POST['file'];
            $post['on_off'] = $_POST['on_off'];
            $post['url'] = $_POST['url'];

            $id_post = $this->sql_edit("module", $post, "where id='" . $id . "'");
            foreach ($_POST as $key => $value) {
                $lang = str_replace("name", '', $key);
                $lang_id['name'] = $value;
                $ok = $this->sql_edit("module_lang", $lang_id, "where id_module_lang = '" . $lang . "'");
            }
        }
        $this->module_edit($id);
    }

    function left_menu() {
        echo "прювет!";
    }

    function index() {
        $data['page'] = $this->module_info['name'];
        $data['meta'] = "";
        $data['file'] = "modules/admin/html/index_html.php";
        $this->load_admin($data);
    }

}

$admin = new admin_index();
$admin->start();
?>
