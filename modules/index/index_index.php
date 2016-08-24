<?php

class index_index extends ycms {

    var $access;
    //доступ к модулю
    var $identifcator = "index";
    //идентификатор модуля
    var $module_info;
    //настройки
    var $setting;

    function start() {
//получаем идентификатор модуля
        global $setting;
        $this->module_info = $this->sql_query_one("module", "join module_lang on module.id = module_lang.id_id where module.identif = '" . $this->identifcator . "' and module_lang.id_lang = '" . $setting['id_lang'] . "'");
        $setting['module_id'] = $this->module_info['id'];
        $this->setting = $setting;
        $this->access = $this->access_dostup($this->module_info['access']);

//получаем данные из командной строки что делаем
        $url = $this->get_url();
//определяем что сейчас нужно делать
        switch ($url['action']) {
//просмотр одного
            case 'login':$this->login($url['id']);
                break;
            case 'logout':$this->logout($url['id']);
                break;
            case 'language':$this->language($url['id']);
                break;
             case 'register':$this->register($url['id']);
                break;
            default: $this->index();
                break;
        }
    }

    function index() {
        $data = array();
        $data['page'] = $this->get_name_module_page($this->identifcator);
        $data['meta'] = "";
        $data['file'] = "modules/index/html/index_html.php";
        $this->load_theme($data);
    }


}

$index = new index_index();
$index->start();
?>
