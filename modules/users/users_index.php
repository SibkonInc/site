<?php

class users_index extends ycms {

    var $access;
    //доступ к модулю
    var $identifcator = "users";
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
//определяем что сейчас нужно делать

//var_dump($url['action']);

        switch ($url['action']) {
//просмотр одного
            case 'view':if ($this->access['access_view'] == "1") {$this->view($url['id']);} else {$this->index();} break;
            default: $this->index();break;
        }
    }

    function index(){

    }

    
}
$us = new users_index();
$us->start();
?>
