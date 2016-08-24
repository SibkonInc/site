<?php

class part_index extends ycms {

    var $access;
    //доступ к модулю
    var $identifcator = "cases";
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
            case 'add_form':if ($this->access['access_add'] == "1") {$this->add_form();} else {} break;
            case 'add_post':if ($this->access['access_add'] == "1") {$this->add_post();} else {$this->index();} break;
            case 'edit':if ($this->access['access_edit'] == "1") {$this->edit($url['id']);} else {$this->index();} break;
           case 'edit_post':if ($this->access['access_edit'] == "1") {$this->edit_post($url['id']);} else {$this->index();} break;
           case 'del':if ($this->access['access_edit'] == "1") {$this->del($url['id']);} else {$this->index();} break;
            case 'del_post':if ($this->access['access_edit'] == "1") {$this->del_post($url['id']);} else {$this->index();} break;
            case 'admin':if ($this->access['access_admin'] == "1") {$this->admin($url['id']);} else {$this->index();} break;
            case 'admin_post':if ($this->access['access_admin'] == "1") {$this->admin_post($url['id']);} else {$this->index();} break;
            case 'admin_tip':if ($this->access['access_admin'] == "1") {$this->admin_tip($url['id']);} else {$this->index();} break;
            case 'edit_tip':if ($this->access['access_admin'] == "1") {$this->edit_tip($url['id']);} else {$this->index();} break;
case 'add_tip':if ($this->access['access_admin'] == "1") {$this->add_tip($url['id']);} else {$this->index();} break;

            default: $this->index();break;
        }
    }

    function admin($message=false) {
        $data=array();
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | Админка модуля";
        $data['meta'] = '';
        $data['message'] = $message;
        $data['access'] = $this->access;
        $data['file'] = "modules/cases/admin/admin_part_html.php";
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
                isset($_POST['part_name' . $id_l]) ? $ulang['part_name'] = $_POST['part_name' . $id_l] : false;
                isset($_POST['part_info' . $id_l]) ? $ulang['part_info'] = $_POST['part_info' . $id_l] : false;
                isset($_POST['part_all' . $id_l]) ? $ulang['part_all'] = $_POST['part_all' . $id_l] : false;
                isset($_POST['part_more' . $id_l]) ? $ulang['part_more'] = $_POST['part_more' . $id_l] : false;
                $ol = $this->sql_edit("m_part_lang", $ulang, "where id_lang =" . $id_l);
                if ($ol == true) {
                    $message[] = "Внесены изменения для языка" . $langu['name_lang'] . "";
                }
                $langa = false;
                isset($_POST['add_part_name' . $id_l]) ? $langa['part_name'] = $_POST['add_part_name' . $id_l] : false;
                isset($_POST['add_part_info' . $id_l]) ? $langa['part_info'] = $_POST['add_part_info' . $id_l] : false;
                isset($_POST['add_part_all' . $id_l]) ? $langa['part_all'] = $_POST['add_part_all' . $id_l] : false;
                isset($_POST['add_part_more' . $id_l]) ? $langa['part_more'] = $_POST['add_part_more' . $id_l] : false;
                if (!(empty($langa))) {
                    $langa['id_lang'] = $id_l;
                    $al = $this->insert('m_part_lang', $langa);
                    if ($al == true) {
                        $message[] = "Добавлены данные для языка" . $langu['name_lang'] . "";
                    }
                }
            }
            $this->admin($message);
        }
    }
    function admin_tip($message=false) {
        $data=array();
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | Админка модуля";
        $data['meta'] = '';
        $data['message'] = $message;
        $data['access'] = $this->access;
        $data['part_tip_data'] = $this->sql_query("m_part_tip");
        $data['file'] = "modules/cases/html/admin_tip_html.php";
        $this->load_theme($data);
    }

    function edit_tip($id,$message=false) {
        global $user, $lang;
        if (empty($_POST)) {
            $data = array();
            $data['page'] = $this->get_name_module_page($this->identifcator) . " | Редактирование типов";
            $data['meta'] = '
            <script src="' . $this->setting['site'] . 'js/i18n/jquery-ui-i18n.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $this->setting['site'] . 'js/ui.core.js"></script>
            <!--<script type="text/javascript" src="' . $this->setting['site'] . 'js/ui.dropdownchecklist.js"></script>-->
            <!--    <link rel="stylesheet" type="text/css" href="' . $this->setting['site'] . 'js/ui.dropdownchecklist.css">-->
            <script type="text/javascript" src="' . $this->setting['site'] . 'ckeditor/ckeditor.js"></script>
            <script src="' . $this->setting['site'] . 'ckeditor/sample.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $this->setting['site'] . 'AjexFileManager/ajex.js"></script>
            ';
            $data['message'] = $message;
            $data['access'] = $this->access;
            $data['part_tip_data'] = $this->sql_query_one("m_part_tip", "where id_part_tip='" . $id . "'");
            $data['file'] = "modules/cases/html/admin_edit_tip_html.php";
            $this->load_theme($data);

        } else {
            $message = array();
            
            //обрабатываем
            foreach ($lang as $langu) {
                $id_l = $langu['id'];
                $ulang = false;
                isset($_POST['part_tip_name' . $id_l]) ? $ulang['part_tip_name'] = $_POST['part_tip_name' . $id_l] : false;
                isset($_POST['part_tip_text' . $id_l]) ? $ulang['part_tip_text'] = $_POST['part_tip_text' . $id_l] : false;

                if ($ulang == true) {
                    $id_post_lang = $this->sql_edit("m_part_tip_lang", $ulang, "where id_part_tip='" . $id . "' and id_lang = '" . $id_l . "'");
                    if ($id_post_lang == false) {
                        $message[] = "Изменения для " . $langu['name_lang'] . " не внесены";
                    } else {
                        $message[] = "Изменения для " . $langu['name_lang'] . " внесены";
                    }
                }
                $alang = false;
                isset($_POST['add_part_tip_name' . $id_l]) ? $alang['part_tip_name'] = $_POST['add_part_tip_name' . $id_l] : false;
                isset($_POST['add_part_tip_text' . $id_l]) ? $alang['part_tip_text'] = $_POST['add_part_tip_text' . $id_l] : false;
                if ($alang == true) {
                    $alang['id_part_tip'] = "$id";
                    $alang['id_lang'] = "$id_l";
                    if ($alang['part_tip_name'] == "") {
                        $message[] = 'Название для языка "' . $langu['name_lang'] . '" не задано, язык не добавлен';
                    } else {
                        $id_lang = $this->insert("m_part_tip_lang", $alang);
                        if ($id_lang == true) {
                            $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                        }
                        $news_text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($alang['part_tip_text']));
                        if ($news_text == "") {
                            $message[] = 'Текст для языка "' . $langu['name_lang'] . '" не задан';
                        }
                    }
                }
            }
            if (isset($message)) {
                $this->admin_tip();
            } else {
                $this->admin_tip();
            }
        }
    }


    function add_tip($id,$message=false) {
        global $user, $lang;
        if (empty($_POST)) {
            $data = array();
            $data['page'] = $this->get_name_module_page($this->identifcator) . " | Редактирование типов";
            $data['meta'] = '
            <script src="' . $this->setting['site'] . 'js/i18n/jquery-ui-i18n.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $this->setting['site'] . 'js/ui.core.js"></script>
            <!--<script type="text/javascript" src="' . $this->setting['site'] . 'js/ui.dropdownchecklist.js"></script>-->
            <!--    <link rel="stylesheet" type="text/css" href="' . $this->setting['site'] . 'js/ui.dropdownchecklist.css">-->
            <script type="text/javascript" src="' . $this->setting['site'] . 'ckeditor/ckeditor.js"></script>
            <script src="' . $this->setting['site'] . 'ckeditor/sample.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $this->setting['site'] . 'AjexFileManager/ajex.js"></script>
            ';
            $data['message'] = $message;
            $data['access'] = $this->access;
            $data['file'] = "modules/cases/html/admin_add_tip_html.php";
            $this->load_theme($data);

        } else {

            $message = array();
            $set = array();
            $set['text'] = date("Y-m-d H:i");
            $id_past = $this->insert("m_part_tip", $set);
            //обрабатываем
            foreach ($lang as $langu) {
                $id_l = $langu['id'];
                $alang = false;
                isset($_POST['part_tip_name' . $id_l]) ? $alang['part_tip_name'] = $_POST['part_tip_name' . $id_l] : false;
                isset($_POST['part_tip_text' . $id_l]) ? $alang['part_tip_text'] = $_POST['part_tip_text' . $id_l] : false;
                if ($alang == true) {
                    $alang['id_part_tip'] = $id_past;
                    $alang['id_lang'] = "$id_l";
                 
                    if ($alang['part_tip_name'] == "") {
                        $message[] = 'Название для языка "' . $langu['name_lang'] . '" не задано, язык не добавлен';
                    } else {
                        $id_lang = $this->insert("m_part_tip_lang", $alang);
                        if ($id_lang == true) {
                            $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                        }
                        $news_text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($alang['part_tip_text']));
                        if ($news_text == "") {
                            $message[] = 'Текст для языка "' . $langu['name_lang'] . '" не задан';
                        }
                    }
                }
            }
            if (isset($message)) {
                $this->admin_tip();
            } else {
                $this->admin_tip();
            }
        }
    }




    function index($message=false) {
        $data = array();
        $data['message'] = $message;
        $data['page'] = $this->module_info['name'];
        $data['meta'] = '';
        $url = $this->get_url();
        if ($url['action'] == "tip") {
            $data['part_lang'] = $this->sql_query_one("m_part_lang", "where id_lang='" . $this->setting['id_lang'] . "'
               ");
            $data['part_data'] = $this->sql_query("m_cases", "
           join m_part_text on m_cases.part_id = m_part_text.part_id
           
           where m_part_text.id_lang='" . $this->setting['id_lang'] . "' 
               and m_cases.part_tip ='" . $url['id'] . "'  order by part_nomer");
        } else {
            $data['part_lang'] = $this->sql_query_one("m_part_lang", "where id_lang='" . $this->setting['id_lang'] . "'");
            $data['part_data'] = $this->sql_query("m_cases", "
                join m_part_text on m_cases.part_id = m_part_text.part_id

                where m_part_text.id_lang='" . $this->setting['id_lang'] . "' order by part_nomer");
       
            }


        $data['file'] = "modules/cases/html/index_part_html.php";
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
        $data['part_tip_data'] = $this->sql_query("m_part_tip", "join m_part_tip_lang on m_part_tip.id_part_tip = m_part_tip_lang.id_part_tip where m_part_tip_lang.id_lang='" . $this->setting['id_lang'] . "'");
        $data['file'] = "modules/cases/html/add_part_html.php";
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
           if (copy($_FILES["part_logo"]["tmp_name"],"img/cases/" . $_FILES["part_logo"]["name"])) {
                $message['fil'] = "Файл успешно загружен <br>";
                $message['fil'].="Характеристики файла: <br>";
                $message['fil'].="Имя файла: ";
                $message['fil'].=$_FILES["part_logo"]["name"];
                $message['fil'].="<br>Размер файла: ";
                $message['fil'].=$_FILES["part_logo"]["size"];
                $message['fil'].="<br>Каталог для загрузки: ";
                $message['fil'].=$_FILES["part_logo"]["tmp_name"];
                $message['fil'].="<br>Тип файла: ";
                $message['fil'].=$_FILES["part_logo"]["type"];
                $post['part_logo'] = $_FILES["part_logo"]["name"];
            } else {
                echo("Ошибка загрузки файла");
                $post['part_logo'] = '';
            }
            isset($_POST['part_cat_id']) ? $post['part_cat_id'] = $_POST['part_cat_id'] : false;
            isset($_POST['part_tip']) ? $post['part_tip'] = $_POST['part_tip'] : false;
            isset($_POST['part_nomer']) ? $post['part_nomer'] = $_POST['part_nomer'] : false;
            //     var_dump($post);
            $id_post = $this->insert("m_cases", $post);
            if ($id_post == false) {
                $message[] = "Данные занесены не было";
            } else {
                $message[] = "Парнер добавлен";
            }
            foreach ($lang as $langu) {
                $post_lang = array();
                isset($_POST['part_name' . $langu['id']]) ? $post_lang['part_name'] = $_POST['part_name' . $langu['id']] : false;
                isset($_POST['adress_part' . $langu['id']]) ? $post_lang['adress_part'] = $_POST['adress_part' . $langu['id']] : false;
                isset($_POST['anons_part' . $langu['id']]) ? $post_lang['anons_part'] = $_POST['anons_part' . $langu['id']] : false;
                isset($_POST['text_part' . $langu['id']]) ? $post_lang['text_part'] = $_POST['text_part' . $langu['id']] : false;
                if ($post_lang == true) {
                    $post_lang['part_id'] = "$id_post";
                    $post_lang['id_lang'] = $langu['id'];
                    if ($post_lang['part_name'] == "") {
                        $message[] = 'Название для языка "' . $langu['name_lang'] . '" не задано, язык не добавлен';
                    } else {
                        $id_lang = $this->insert("m_part_text", $post_lang);
                        if ($id_lang == true) {
                            $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                        }
                        if ($post_lang['anons_part'] == "") {
                            $message[] = 'Анонс для языка "' . $langu['name_lang'] . '" не задан';
                        }
                        if ($post_lang['adress_part'] == "") {
                            $message[] = 'Адрес для языка "' . $langu['name_lang'] . '" не задан';
                        }
                        $news_text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($post_lang['text_part']));
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
        $part_data = $this->sql_query_one("m_cases", "join m_part_text on m_cases.part_id = m_part_text.part_id join m_part_tip_lang on m_cases.part_tip = m_part_tip_lang.id_part_tip where m_part_text.id_lang='" . $this->setting['id_lang'] . "' and m_cases.part_id='" . $id . "'");
        $data['part_data'] = $part_data;
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | " . $part_data['part_name'];
        $data['meta'] = '<script type="text/javascript" src="/js/thickbox.js"></script>
            <style type="text/css" media="all">@import "/js/thickbox.css";</style>';
        $data['file'] = "modules/cases/html/view_part_html.php";
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
        $data['part_tip_data'] = $this->sql_query("m_part_tip", "join m_part_tip_lang on m_part_tip.id_part_tip = m_part_tip_lang.id_part_tip where m_part_tip_lang.id_lang='" . $this->setting['id_lang'] . "'");
        $part_data = $this->sql_query_one("m_cases", "where m_cases.part_id='" . $id . "'");
        $data['part_data'] = $part_data;
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | Редактирование";
        $data['file'] = "modules/cases/html/edit_part_html.php";
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
            if (!($_FILES["part_log"]["tmp_name"] == "")) {
                if (copy($_FILES["part_log"]["tmp_name"],"img/cases/" . $_FILES["part_log"]["name"])) {
                    $message['fil'] = "Файл успешно загружен <br>";
                    $message['fil'].="Характеристики файла: <br>";
                    $message['fil'].="Имя файла: ";
                    $message['fil'].=$_FILES["part_log"]["name"];
                    $message['fil'].="<br>Размер файла: ";
                    $message['fil'].=$_FILES["part_log"]["size"];
                    $message['fil'].="<br>Каталог для загрузки: ";
                    $message['fil'].=$_FILES["part_log"]["tmp_name"];
                    $message['fil'].="<br>Тип файла: ";
                    $message['fil'].=$_FILES["part_log"]["type"];
                    $post['part_logo'] = $_FILES["part_log"]["name"];
                } else {
                    echo("Ошибка загрузки файла");
                    $post['part_logo'] = $_POST['part_logo'];
                }
            }
            isset($_POST['part_cat_id']) ? $post['part_cat_id'] = $_POST['part_cat_id'] : false;
            isset($_POST['part_tip']) ? $post['part_tip'] = $_POST['part_tip'] : false;
            isset($_POST['part_nomer']) ? $post['part_nomer'] = $_POST['part_nomer'] : false;
            $id_post = $this->sql_edit("m_cases", $post, "where part_id='" . $id . "'");
            //обрабатываем
            if ($id_post == false) {
                $message[] = "Основные изменения не внесены";
            } else {
                $message[] = "Основные изменения внесены";
            }
            foreach ($lang as $langu) {
                $id_l = $langu['id'];
                $ulang = false;
                isset($_POST['part_name' . $id_l]) ? $ulang['part_name'] = $_POST['part_name' . $id_l] : false;
                isset($_POST['adress_part' . $id_l]) ? $ulang['adress_part'] = $_POST['adress_part' . $id_l] : false;
                isset($_POST['anons_part' . $id_l]) ? $ulang['anons_part'] = $_POST['anons_part' . $id_l] : false;
                isset($_POST['text_part' . $id_l]) ? $ulang['text_part'] = $_POST['text_part' . $id_l] : false;
                if ($ulang == true) {
                    $id_post_lang = $this->sql_edit("m_part_text", $ulang, "where part_id='" . $id . "' and id_lang = '" . $id_l . "'");
                    if ($id_post_lang == false) {
                        $message[] = "Изменения для " . $langu['name_lang'] . " не внесены";
                    } else {
                        $message[] = "Изменения для " . $langu['name_lang'] . " внесены";
                    }
                }
                $alang = false;
                isset($_POST['add_part_name' . $id_l]) ? $alang['part_name'] = $_POST['add_part_name' . $id_l] : false;
                isset($_POST['add_adress_part' . $id_l]) ? $alang['adress_part'] = $_POST['add_adress_part' . $id_l] : false;
                isset($_POST['add_anons_part' . $id_l]) ? $alang['anons_part'] = $_POST['add_anons_part' . $id_l] : false;
                isset($_POST['add_text_part' . $id_l]) ? $alang['text_part'] = $_POST['add_text_part' . $id_l] : false;
                if ($alang == true) {
                    $alang['part_id'] = "$id";
                    $alang['id_lang'] = "$id_l";
                    if ($alang['part_name'] == "") {
                        $message[] = 'Название для языка "' . $langu['name_lang'] . '" не задано, язык не добавлен';
                    } else {
                        $id_lang = $this->insert("m_part_text", $alang);
                        if ($id_lang == true) {
                            $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                        }
                        if ($alang['anons_part'] == "") {
                            $message[] = 'Анонс для языка "' . $langu['name_lang'] . '" не задан';
                        }
                        $news_text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($alang['text_part']));
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
        include_once 'modules/cases/html/del_part.php';
    }

    function del_post($id) {
        global $setting;
        $message = array();
        $o = $this->sql_del("m_cases", "where part_id = '" . $id . "'");
        $message[] = "Было удалено записей:" . $o;
        $this->index($message);
    }
}
$part = new part_index();
$part->start();
?>
