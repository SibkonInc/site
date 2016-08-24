<?php

class dashboard_index extends ycms {

    var $access;
    //доступ к модулю
    var $identifcator = "dashboard";
    //идентификатор модуля
    var $module_info;
    //настройки
    var $setting;

    /** Разбираем запрос чтоб определить куда идти */
    function start() {
//получаем идентификатор модуля
        global $setting;
        $this->module_info = $this->sql_query_one("module", "join module_lang on module.id = module_lang.id_id where module.identif = '" . $this->identifcator . "' and module_lang.id_lang = '" . $setting['id_lang'] . "'");
        $setting['module_id'] = $this->module_info['id'];
        $this->setting = $setting;
        $this->access = $this->access_dostup($this->module_info['access']);
//получаем данные из командной строки что делаем
        $url = $this->get_url();

        switch ($url['action']) {
//просмотр одного
            case 'view':if ($this->access['access_view'] == "1") {
                    $this->view($url['id']);
                } else {
                    $this->index();
                } break;
            default: $this->index();
                break;
        }
    }

    function index() {
        if ($this->access['access_view'] == "1") {
            $data = array();
            //получаем название модуля на языке
            $data['dash_lang'] = $this->sql_query_one("m_dash_lang", "where id_lang = '" . $this->setting['id_lang'] . "'");
//получаем типы
            $data['page'] = $this->module_info['name'];
            $data['meta'] = "";
            $data['file'] = "modules/dashboard/html/index_dashboard_html.php";
            $this->load_dash($data, "1");
        } else {
            header("Location: " . $this->setting['site'] . "sistems/error/1/");
        }
    }

    function load_dash($data, $tip="1") {
        global $ycms, $start, $setting, $lang;
        $menu_top = $this->menu("top", $setting['id_lang']);
        $html = $this->load("html");
        $menu_lang = $lang;
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        if ($tip == "1") {
            require_once ("modules/dashboard/theme/dashboard/head.php"); //шапка
        } else {
            require_once ("modules/dashboard/theme/dashboard/head_charts.php"); //шапка
        }
        if (isset($data['file'])) {
            require_once ($data['file']); //код основной для модуля
        }
        require_once ("modules/dashboard/theme/dashboard/footer.php"); //футер
    }

}

$dash = new dashboard_index();
$dash->start();
?>
