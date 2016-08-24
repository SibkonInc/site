<?php

class awards_index extends ycms {

    var $access;
    //доступ к модулю
    var $identifcator = "awards";
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
        $data['file'] = "modules/awards/admin/admin_awards_html.php";
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
                isset($_POST['awards_name' . $id_l]) ? $ulang['awards_name'] = $_POST['awards_name' . $id_l] : false;
                isset($_POST['awards_info' . $id_l]) ? $ulang['awards_info'] = $_POST['awards_info' . $id_l] : false;
                isset($_POST['awards_all' . $id_l]) ? $ulang['awards_all'] = $_POST['awards_all' . $id_l] : false;
                isset($_POST['awards_more' . $id_l]) ? $ulang['awards_more'] = $_POST['awards_more' . $id_l] : false;
                $ol = $this->sql_edit("m_awards_lang", $ulang, "where id_lang =" . $id_l);
                if ($ol == true) {
                    $message[] = "Внесены изменения для языка" . $langu['name_lang'] . "";
                }
                $langa = false;
                isset($_POST['add_awards_name' . $id_l]) ? $langa['awards_name'] = $_POST['add_awards_name' . $id_l] : false;
                isset($_POST['add_awards_info' . $id_l]) ? $langa['awards_info'] = $_POST['add_awards_info' . $id_l] : false;
                isset($_POST['add_awards_all' . $id_l]) ? $langa['awards_all'] = $_POST['add_awards_all' . $id_l] : false;
                isset($_POST['add_awards_more' . $id_l]) ? $langa['awards_more'] = $_POST['add_awards_more' . $id_l] : false;
                if (!(empty($langa))) {
                    $langa['id_lang'] = $id_l;
                    $al = $this->insert('m_awards_lang', $langa);
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
        $data['awards_lang'] = $this->sql_query_one("m_awards_lang", "where id_lang='" . $this->setting['id_lang'] . "'");
        $data['awards_data'] = $this->sql_query("m_awards", "join m_awards_text on m_awards.awards_id = m_awards_text.awards_id where m_awards_text.id_lang='" . $this->setting['id_lang'] . "' order by awards_nomer");
        $data['file'] = "modules/awards/html/index_awards_html.php";
        $data['access'] = $this->access;
        $this->load_theme($data);
    }

    function add_form() {
        $data = array();
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
        $data['awards_tip_data'] = $this->sql_query("m_awards_tip", "join m_awards_tip_lang on m_awards_tip.id_awards_tip = m_awards_tip_lang.id_awards_tip where m_awards_tip_lang.id_lang='" . $this->setting['id_lang'] . "'");
        $data['file'] = "modules/awards/html/add_awards_html.php";
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
         //   var_dump($_FILES);
            if (copy($_FILES["awards_logo"]["tmp_name"],"img/awards/" . $_FILES["awards_logo"]["name"])) {
                $message['fil'] = "Файл успешно загружен <br>";
                $message['fil'].="Характеристики файла: <br>";
                $message['fil'].="Имя файла: ";
                $message['fil'].=$_FILES["awards_logo"]["name"];
                $message['fil'].="<br>Размер файла: ";
                $message['fil'].=$_FILES["awards_logo"]["size"];
                $message['fil'].="<br>Каталог для загрузки: ";
                $message['fil'].=$_FILES["awards_logo"]["tmp_name"];
                $message['fil'].="<br>Тип файла: ";
                $message['fil'].=$_FILES["awards_logo"]["type"];
                $post['awards_logo'] = $_FILES["awards_logo"]["name"];
            } else {
                echo("Ошибка загрузки файла");
                $post['awards_logo'] = '';
            }
            isset($_POST['awards_cat_id']) ? $post['awards_cat_id'] = $_POST['awards_cat_id'] : false;
            isset($_POST['awards_tip']) ? $post['awards_tip'] = $_POST['awards_tip'] : false;
            isset($_POST['awards_nomer']) ? $post['awards_nomer'] = $_POST['awards_nomer'] : false;
            //     var_dump($post);
            $id_post = $this->insert("m_awards", $post);
            if ($id_post == false) {
                $message[] = "Данные занесены не было";
            } else {
                $message[] = "Данные занесены";
            }
            foreach ($lang as $langu) {
                $post_lang = array();
                isset($_POST['awards_name' . $langu['id']]) ? $post_lang['awards_name'] = $_POST['awards_name' . $langu['id']] : false;
                
                isset($_POST['anons_awards' . $langu['id']]) ? $post_lang['anons_awards'] = $_POST['anons_awards' . $langu['id']] : false;
                isset($_POST['text_awards' . $langu['id']]) ? $post_lang['text_awards'] = $_POST['text_awards' . $langu['id']] : false;
                if ($post_lang == true) {
                    $post_lang['awards_id'] = "$id_post";
                    $post_lang['id_lang'] = $langu['id'];
                    if ($post_lang['awards_name'] == "") {
                        $message[] = 'Название для языка "' . $langu['name_lang'] . '" не задано, язык не добавлен';
                    } else {
                        $id_lang = $this->insert("m_awards_text", $post_lang);
                        if ($id_lang == true) {
                            $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                        }
                        if ($post_lang['anons_awards'] == "") {
                            $message[] = 'Анонс для языка "' . $langu['name_lang'] . '" не задан';
                        }
                        $news_text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($post_lang['text_awards']));
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
        $awards_data = $this->sql_query_one("m_awards", "join m_awards_text on m_awards.awards_id = m_awards_text.awards_id where m_awards_text.id_lang='" . $this->setting['id_lang'] . "' and m_awards.awards_id='" . $id . "'");
        $data['awards_data'] = $awards_data;
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | " . $awards_data['awards_name'];
        $data['meta'] = '<script type="text/javascript" src="/js/thickbox.js"></script>
            <style type="text/css" media="all">@import "/js/thickbox.css";</style>';
        $data['file'] = "modules/awards/html/view_awards_html.php";
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
        $data['awards_tip_data'] = $this->sql_query("m_awards_tip", "join m_awards_tip_lang on m_awards_tip.id_awards_tip = m_awards_tip_lang.id_awards_tip where m_awards_tip_lang.id_lang='" . $this->setting['id_lang'] . "'");
        $awards_data = $this->sql_query_one("m_awards", "where m_awards.awards_id='" . $id . "'");
        $data['awards_data'] = $awards_data;
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | Редактирование";
        $data['file'] = "modules/awards/html/edit_awards_html.php";
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
            if (!($_FILES["awards_log"]["tmp_name"] == "")) {
                if (copy($_FILES["awards_log"]["tmp_name"],"img/awards/" . $_FILES["awards_log"]["name"])) {
                    $message['fil'] = "Файл успешно загружен <br>";
                    $message['fil'].="Характеристики файла: <br>";
                    $message['fil'].="Имя файла: ";
                    $message['fil'].=$_FILES["awards_log"]["name"];
                    $message['fil'].="<br>Размер файла: ";
                    $message['fil'].=$_FILES["awards_log"]["size"];
                    $message['fil'].="<br>Каталог для загрузки: ";
                    $message['fil'].=$_FILES["awards_log"]["tmp_name"];
                    $message['fil'].="<br>Тип файла: ";
                    $message['fil'].=$_FILES["awards_log"]["type"];
                    $post['awards_logo'] = $_FILES["awards_log"]["name"];

                    } else {
                    echo("Ошибка загрузки файла");
                    $post['awards_logo'] = $_POST['awards_logo'];
                }
            }
            isset($_POST['awards_cat_id']) ? $post['awards_cat_id'] = $_POST['awards_cat_id'] : false;
            isset($_POST['awards_tip']) ? $post['awards_tip'] = $_POST['awards_tip'] : false;
            isset($_POST['awards_nomer']) ? $post['awards_nomer'] = $_POST['awards_nomer'] : false;
     //     var_dump($post);
            $id_post = $this->sql_edit("m_awards", $post, "where awards_id='" . $id . "'");
            //обрабатываем
            if ($id_post == false) {
                $message[] = "Основные изменения не внесены";
            } else {
                $message[] = "Основные изменения внесены";
            }
            foreach ($lang as $langu) {
                $id_l = $langu['id'];
                $ulang = false;
                isset($_POST['awards_name' . $id_l]) ? $ulang['awards_name'] = $_POST['awards_name' . $id_l] : false;
               
                isset($_POST['anons_awards' . $id_l]) ? $ulang['anons_awards'] = $_POST['anons_awards' . $id_l] : false;
                isset($_POST['text_awards' . $id_l]) ? $ulang['text_awards'] = $_POST['text_awards' . $id_l] : false;
                if ($ulang == true) {
                    $id_post_lang = $this->sql_edit("m_awards_text", $ulang, "where awards_id='" . $id . "' and id_lang = '" . $id_l . "'");
                    if ($id_post_lang == false) {
                        $message[] = "Изменения для " . $langu['name_lang'] . " не внесены";
                    } else {
                        $message[] = "Изменения для " . $langu['name_lang'] . " внесены";
                    }
                }
                $alang = false;
                isset($_POST['add_awards_name' . $id_l]) ? $alang['awards_name'] = $_POST['add_awards_name' . $id_l] : false;
                isset($_POST['add_adress_awards' . $id_l]) ? $alang['adress_awards'] = $_POST['add_adress_awards' . $id_l] : false;
                isset($_POST['add_anons_awards' . $id_l]) ? $alang['anons_awards'] = $_POST['add_anons_awards' . $id_l] : false;
                isset($_POST['add_text_awards' . $id_l]) ? $alang['text_awards'] = $_POST['add_text_awards' . $id_l] : false;
                if ($alang == true) {
                    $alang['awards_id'] = "$id";
                    $alang['id_lang'] = "$id_l";
                    if ($alang['awards_name'] == "") {
                        $message[] = 'Название для языка "' . $langu['name_lang'] . '" не задано, язык не добавлен';
                    } else {
                        $id_lang = $this->insert("m_awards_text", $alang);
                        if ($id_lang == true) {
                            $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                        }
                        if ($alang['anons_awards'] == "") {
                            $message[] = 'Анонс для языка "' . $langu['name_lang'] . '" не задан';
                        }
                        $news_text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($alang['text_awards']));
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
        include_once 'modules/awards/html/del_awards.php';
    }

    function del_post($id) {
        global $setting;
        $message = array();
        $o = $this->sql_del("m_awards", "where awards_id = '" . $id . "'");
        $message[] = "Было удалено записей:" . $o;
        $this->index($message);
    }
}
$awards = new awards_index();
$awards->start();
?>
