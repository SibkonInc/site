<?php

class clients_index extends ycms {

    var $access;
    //доступ к модулю
    var $identifcator = "clients";
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
        switch ($url['action']) {
//просмотр одного
            case 'view':if ($this->access['access_view'] == "1") {$this->view($url['id']);} else {$this->index();} break;
            case 'add_form':if ($this->access['access_add'] == "1") {$this->add_form();} else {} break;
            case 'add_post':if ($this->access['access_add'] == "1") {$this->add_post();} else {$this->index();} break;
            case 'edit':if ($this->access['access_edit'] == "1") {$this->edit($url['id']);} else {$this->index();} break;
            case 'edit_post':if ($this->access['access_edit'] == "1") {$this->edit_post($url['id']);} else {$this->index();} break;
            case 'del':if ($this->access['access_edit'] == "1") {$this->del($url['id']);} else {$this->index();} break;
            case 'del_post':if ($this->access['access_edit'] == "1") {$this->del_post($url['id']);} else {$this->index();} break;
            case 'admin':if ($this->access['access_admin'] == "1") {$this->admin($url['id']);} else {$this->index();} break;
            case 'admin_post':if ($this->access['access_admin'] == "1") {$this->admin_post($url['id']);} else {$this->index();} break;
            default: $this->index();break;
        }
    }

    function admin($message=false) {
        $data=array();
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | Админка модуля";
        $data['meta'] = '';
        $data['message'] = $message;
        $data['access'] = $this->access;
        $data['file'] = "modules/clients/admin/admin_clients_html.php";
        $this->load_theme($data);
    }
    function admin_post($id) {
        global $lang;
        if (empty($_POST)) {
            $this->admin();
        } else {
            $data = array();
            $message = array();
            $data['page'] = $this->get_name_module_page($this->identifcator) . " | Админка модуля";
            $data['meta'] = '';
            foreach ($lang as $langu) {
                $id_l = $langu['id'];
                $ulang = false;
                isset($_POST['clients_name' . $id_l]) ? $ulang['clients_name'] = $_POST['clients_name' . $id_l] : false;
                isset($_POST['clients_info' . $id_l]) ? $ulang['clients_info'] = $_POST['clients_info' . $id_l] : false;
                isset($_POST['clients_all' . $id_l]) ? $ulang['clients_all'] = $_POST['clients_all' . $id_l] : false;
                isset($_POST['clients_more' . $id_l]) ? $ulang['clients_more'] = $_POST['clients_more' . $id_l] : false;
                $ol = $this->sql_edit("m_clients_lang", $ulang, "where id_lang =" . $id_l);
                if ($ol == true) {
                    $message[] = "Внесены изменения для языка" . $langu['name_lang'] . "";
                }
                $langa = false;
                isset($_POST['add_clients_name' . $id_l]) ? $langa['clients_name'] = $_POST['add_clients_name' . $id_l] : false;
                isset($_POST['add_clients_info' . $id_l]) ? $langa['clients_info'] = $_POST['add_clients_info' . $id_l] : false;
                isset($_POST['add_clients_all' . $id_l]) ? $langa['clients_all'] = $_POST['add_clients_all' . $id_l] : false;
                isset($_POST['add_clients_more' . $id_l]) ? $langa['clients_more'] = $_POST['add_clients_more' . $id_l] : false;
                if (!(empty($langa))) {
                    $langa['id_lang'] = $id_l;
                    $al = $this->insert('m_clients_lang', $langa);
                    if ($al == true) {
                        $message[] = "Добавлены данные для языка" . $langu['name_lang'] . "";
                    }
                }
            }
            $this->admin($message);
        }
    }
    function index($message=false) {
        $data = array();
        $data['message'] = $message;
        $data['page'] = $this->module_info['name'];
        $data['meta'] = '';
        $data['clients_lang'] = $this->sql_query_one("m_clients_lang", "where id_lang='" . $this->setting['id_lang'] . "'");
        $data['clients_data'] = $this->sql_query("m_clients", "join m_clients_text on m_clients.clients_id = m_clients_text.clients_id join m_clients_tip_lang on m_clients.clients_tip = m_clients_tip_lang.id_clients_tip where m_clients_text.id_lang='" . $this->setting['id_lang'] . "' order by clients_nomer");
        $data['file'] = "modules/clients/html/index_clients_html.php";
        $data['access'] = $this->access;
        $this->load_theme($data);
    }

    function add_form() {
        $data = array();
//данные для титла
        $data['page'] = $this->module_info['name'] . ' | Добавление';
        $data['meta'] = '
            <script src="' . $this->setting['site'] . 'js/i18n/jquery-ui-i18n.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $this->setting['site'] . 'js/ui.core.js"></script>
            <!--<script type="text/javascript" src="' . $this->setting['site'] . 'js/ui.dropdownchecklist.js"></script>-->
            <!--    <link rel="stylesheet" type="text/css" href="' . $this->setting['site'] . 'js/ui.dropdownchecklist.css">-->
            <script type="text/javascript" src="' . $this->setting['site'] . 'ckeditor/ckeditor.js"></script>
            <script src="' . $this->setting['site'] . 'ckeditor/sample.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $this->setting['site'] . 'AjexFileManager/ajex.js"></script>
            ';
        $data['clients_tip_data'] = $this->sql_query("m_clients_tip", "join m_clients_tip_lang on m_clients_tip.id_clients_tip = m_clients_tip_lang.id_clients_tip where m_clients_tip_lang.id_lang='" . $this->setting['id_lang'] . "'");
        $data['file'] = "modules/clients/html/add_clients_html.php";
        $data['access'] = $this->access;
        $this->load_theme($data);
    }

    function add_post() {
        global $user, $lang;
        if (empty($_POST)) {
            $this->index();
        } else {
            $post = array();
            $message = array();
            var_dump($_FILES);
            if (copy($_FILES["clients_logo"]["tmp_name"],"img/clients/" . $_FILES["clients_logo"]["name"])) {
                $message['fil'] = "Файл успешно загружен <br>";
                $message['fil'].="Характеристики файла: <br>";
                $message['fil'].="Имя файла: ";
                $message['fil'].=$_FILES["clients_logo"]["name"];
                $message['fil'].="<br>Размер файла: ";
                $message['fil'].=$_FILES["clients_logo"]["size"];
                $message['fil'].="<br>Каталог для загрузки: ";
                $message['fil'].=$_FILES["clients_logo"]["tmp_name"];
                $message['fil'].="<br>Тип файла: ";
                $message['fil'].=$_FILES["clients_logo"]["type"];
                $post['clients_logo'] = $_FILES["clients_logo"]["name"];
            } else {
                echo("Ошибка загрузки файла");
                $post['clients_logo'] = '';
            }
            isset($_POST['clients_cat_id']) ? $post['clients_cat_id'] = $_POST['clients_cat_id'] : false;
            isset($_POST['clients_tip']) ? $post['clients_tip'] = $_POST['clients_tip'] : false;
            isset($_POST['clients_nomer']) ? $post['clients_nomer'] = $_POST['clients_nomer'] : false;
            //     var_dump($post);
            $id_post = $this->insert("m_clients", $post);
            if ($id_post == false) {
                $message[] = "Данные занесены не было";
            } else {
                $message[] = "Парнер добавлен";
            }
            foreach ($lang as $langu) {
                $post_lang = array();
                isset($_POST['clients_name' . $langu['id']]) ? $post_lang['clients_name'] = $_POST['clients_name' . $langu['id']] : false;
                isset($_POST['adress_clients' . $langu['id']]) ? $post_lang['adress_clients'] = $_POST['adress_clients' . $langu['id']] : false;
                isset($_POST['anons_clients' . $langu['id']]) ? $post_lang['anons_clients'] = $_POST['anons_clients' . $langu['id']] : false;
                isset($_POST['text_clients' . $langu['id']]) ? $post_lang['text_clients'] = $_POST['text_clients' . $langu['id']] : false;
                if ($post_lang == true) {
                    $post_lang['clients_id'] = "$id_post";
                    $post_lang['id_lang'] = $langu['id'];
                    if ($post_lang['clients_name'] == "") {
                        $message[] = 'Название для языка "' . $langu['name_lang'] . '" не задано, язык не добавлен';
                    } else {
                        $id_lang = $this->insert("m_clients_text", $post_lang);
                        if ($id_lang == true) {
                            $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                        }
                        if ($post_lang['anons_clients'] == "") {
                            $message[] = 'Анонс для языка "' . $langu['name_lang'] . '" не задан';
                        }
                        if ($post_lang['adress_clients'] == "") {
                            $message[] = 'Адрес для языка "' . $langu['name_lang'] . '" не задан';
                        }
                        $news_text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($post_lang['text_clients']));
                        if ($news_text == "") {
                            $message[] = 'Текст для языка "' . $langu['name_lang'] . '" не задан';
                        }
                    }
                }
            }
            if (isset($message)) {
//вызываем просмотр вместе с сообщениями
                $this->view($id_post, $message);
            } else {
//вызываем просмотр без сообщений
                $this->view($id_post);
            }
        }
    }

    function view($id, $message=false) {
        global $lang;
        $data = array();
        $data['message'] = $message;
        $data['access'] = $this->access;
        $clients_data = $this->sql_query_one("m_clients", "join m_clients_text on m_clients.clients_id = m_clients_text.clients_id join m_clients_tip_lang on m_clients.clients_tip = m_clients_tip_lang.id_clients_tip where m_clients_text.id_lang='" . $this->setting['id_lang'] . "' and m_clients.clients_id='" . $id . "'");
        $data['clients_data'] = $clients_data;
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | " . $clients_data['clients_name'];
        $data['meta'] = '<script type="text/javascript" src="/js/thickbox.js"></script>
            <style type="text/css" media="all">@import "/js/thickbox.css";</style>';
        $data['file'] = "modules/clients/html/view_clients_html.php";
        $this->load_theme($data);
    }

    function edit($id) {
        $data = array();
//данные для титла
        $data['meta'] = '
            <script src="' . $this->setting['site'] . 'js/i18n/jquery-ui-i18n.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $this->setting['site'] . 'js/ui.core.js"></script>
            <!--<script type="text/javascript" src="' . $this->setting['site'] . 'js/ui.dropdownchecklist.js"></script>-->
            <!--    <link rel="stylesheet" type="text/css" href="' . $this->setting['site'] . 'js/ui.dropdownchecklist.css">-->
            <script type="text/javascript" src="' . $this->setting['site'] . 'ckeditor/ckeditor.js"></script>
            <script src="' . $this->setting['site'] . 'ckeditor/sample.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $this->setting['site'] . 'AjexFileManager/ajex.js"></script>
            ';
//название для самого модуля
        $data['clients_tip_data'] = $this->sql_query("m_clients_tip", "join m_clients_tip_lang on m_clients_tip.id_clients_tip = m_clients_tip_lang.id_clients_tip where m_clients_tip_lang.id_lang='" . $this->setting['id_lang'] . "'");
        $clients_data = $this->sql_query_one("m_clients", "where m_clients.clients_id='" . $id . "'");
        $data['clients_data'] = $clients_data;
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | Редактирование";
        $data['file'] = "modules/clients/html/edit_clients_html.php";
        $data['access'] = $this->access;
        $this->load_theme($data);
    }

    function edit_post($id) {
        global $user, $lang;
        if (empty($_POST)) {
            $this->view($id);
        } else {
            $post = array();
            $message = array();
            if (!($_FILES["clients_log"]["tmp_name"] == "")) {
                if (copy($_FILES["clients_log"]["tmp_name"],"img/clients/" . $_FILES["clients_log"]["name"])) {
                    $message['fil'] = "Файл успешно загружен <br>";
                    $message['fil'].="Характеристики файла: <br>";
                    $message['fil'].="Имя файла: ";
                    $message['fil'].=$_FILES["clients_log"]["name"];
                    $message['fil'].="<br>Размер файла: ";
                    $message['fil'].=$_FILES["clients_log"]["size"];
                    $message['fil'].="<br>Каталог для загрузки: ";
                    $message['fil'].=$_FILES["clients_log"]["tmp_name"];
                    $message['fil'].="<br>Тип файла: ";
                    $message['fil'].=$_FILES["clients_log"]["type"];
                    $post['clients_logo'] = $_FILES["clients_log"]["name"];

                    } else {
                    echo("Ошибка загрузки файла");
                    $post['clients_logo'] = $_POST['clients_logo'];
                }
            }
            isset($_POST['clients_cat_id']) ? $post['clients_cat_id'] = $_POST['clients_cat_id'] : false;
            isset($_POST['clients_tip']) ? $post['clients_tip'] = $_POST['clients_tip'] : false;
            isset($_POST['clients_nomer']) ? $post['clients_nomer'] = $_POST['clients_nomer'] : false;
     //     var_dump($post);
            $id_post = $this->sql_edit("m_clients", $post, "where clients_id='" . $id . "'");
            //обрабатываем
            if ($id_post == false) {
                $message[] = "Основные изменения не внесены";
            } else {
                $message[] = "Основные изменения внесены";
            }
            foreach ($lang as $langu) {
                $id_l = $langu['id'];
                $ulang = false;
                isset($_POST['clients_name' . $id_l]) ? $ulang['clients_name'] = $_POST['clients_name' . $id_l] : false;
                isset($_POST['adress_clients' . $id_l]) ? $ulang['adress_clients'] = $_POST['adress_clients' . $id_l] : false;
                isset($_POST['anons_clients' . $id_l]) ? $ulang['anons_clients'] = $_POST['anons_clients' . $id_l] : false;
                isset($_POST['text_clients' . $id_l]) ? $ulang['text_clients'] = $_POST['text_clients' . $id_l] : false;
                if ($ulang == true) {
                    $id_post_lang = $this->sql_edit("m_clients_text", $ulang, "where clients_id='" . $id . "' and id_lang = '" . $id_l . "'");
                    if ($id_post_lang == false) {
                        $message[] = "Изменения для " . $langu['name_lang'] . " не внесены";
                    } else {
                        $message[] = "Изменения для " . $langu['name_lang'] . " внесены";
                    }
                }
                $alang = false;
                isset($_POST['add_clients_name' . $id_l]) ? $alang['clients_name'] = $_POST['add_clients_name' . $id_l] : false;
                isset($_POST['add_adress_clients' . $id_l]) ? $alang['adress_clients'] = $_POST['add_adress_clients' . $id_l] : false;
                isset($_POST['add_anons_clients' . $id_l]) ? $alang['anons_clients'] = $_POST['add_anons_clients' . $id_l] : false;
                isset($_POST['add_text_clients' . $id_l]) ? $alang['text_clients'] = $_POST['add_text_clients' . $id_l] : false;
                if ($alang == true) {
                    $alang['clients_id'] = "$id";
                    $alang['id_lang'] = "$id_l";
                    if ($alang['clients_name'] == "") {
                        $message[] = 'Название для языка "' . $langu['name_lang'] . '" не задано, язык не добавлен';
                    } else {
                        $id_lang = $this->insert("m_clients_text", $alang);
                        if ($id_lang == true) {
                            $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                        }
                        if ($alang['anons_clients'] == "") {
                            $message[] = 'Анонс для языка "' . $langu['name_lang'] . '" не задан';
                        }
                        $news_text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($alang['text_clients']));
                        if ($news_text == "") {
                            $message[] = 'Текст для языка "' . $langu['name_lang'] . '" не задан';
                        }
                    }
                }
            }
            if (isset($message)) {
                $this->view($id, $message);
            } else {
                $this->view($id);
            }
        }
    }

    function del($id) {
        global $setting;
        include_once 'modules/clients/html/del_clients.php';
    }

    function del_post($id) {
        global $setting;
        $message = array();
        $o = $this->sql_del("m_clients", "where clients_id = '" . $id . "'");
        $message[] = "Было удалено записей:" . $o;
        $this->index($message);
    }
}
$clients = new clients_index();
$clients->start();
?>
