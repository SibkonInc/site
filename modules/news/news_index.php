<?php

class news_index extends ycms {

    var $access;
    //доступ к модулю
    var $identifcator = "news";
    //идентификатор модуля
    var $module_info;
    //настройки
    var $setting;

    /** Разбираем запрос чтоб определить куда идти */
    function __construct() {
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
            case 'add_form':if ($this->access['access_add'] == "1") {$this->add_form();} else {$this->index();} break;
            case 'add_post':if ($this->access['access_add'] == "1") {$this->add_post();} else {$this->index();} break;
            case 'all':if ($this->access['access_view'] == "1") {$this->all($url['id']);} else { $this->index();} break;
            case 'admin_edit':if ($this->access['access_view'] == "1") {$this->admin_edit($url['id']);} else {$this->index();} break;
            case 'admin':if ($this->access['access_view'] == "1") {$this->admin($url['id']);} else {$this->index();} break;
            case 'edit':if ($this->access['access_edit'] == "1") {$this->edit($url['id']);} else { $this->index(); } break;
            case 'edit_post':if ($this->access['access_edit'] == "1") {$this->edit_post($url['id']);} else {$this->index();} break;
            case 'del':if ($this->access['access_edit'] == "1") { $this->del($url['id']); } else {$this->index();} break;
            case 'del_post':if ($this->access['access_edit'] == "1") {$this->del_post($url['id']);} else {$this->index(); } break;
            default: $this->index();break;
        }
    }

    function index($message=false) {
        $data=array();
        $data['message'] = $message;
//данные для титла
        $data['page'] = $this->module_info['name'];
        $data['meta'] = '';
//название для самого модуля
//подключаем графическую часть
        $news_setting = $this->sql_query_one("m_news_setting");
        $data['news_setting'] = $news_setting;
        $data['news_lang'] = $this->sql_query_one("m_news_lang", "where id_lang='" . $this->setting['id_lang'] . "'");
        $data['news_last_data'] = $this->sql_query("m_news", "left join m_news_text on  m_news.news_id = m_news_text.news_id where news_on = '1' and m_news_text.id_lang = '" . $this->setting['id_lang'] . "' order by m_news.news_id DESC limit 0," . $news_setting['news_order_last'] . "");
        $data['news_top_data'] = $this->sql_query("m_news", "left join m_news_text on  m_news.news_id = m_news_text.news_id where news_on = '1' and m_news_text.id_lang = '" . $this->setting['id_lang'] . "' order by news_count DESC limit 0," . $news_setting['news_order_last'] . " ");
        $data['file'] = "modules/news/html/index_news_html.php";
        $data['access'] = $this->access;
        $this->load_theme($data);
    }

    function all($id="0") {
        $data=array();
        $html = $this->load("html");
//данные для титла
        $data['page'] = $this->module_info['name'];
        $data['meta'] = '<script type="text/javascript" src="/js/thickbox.js"></script>
            <style type="text/css" media="all">@import "/js/thickbox.css";</style>';
//получаем настройки модуля
        $news_setting = $this->sql_query_one("m_news_setting");
        $data['news_setting'] = $news_setting;
//получаем название модуля на языке
        $data['news_lang'] = $this->sql_query_one("m_news_lang", "where id_lang='" . $this->setting['id_lang'] . "'");
//получаем сколько записей
        $itogo = $this->sql_query_count("m_news", "left join m_news_text on  m_news.news_id = m_news_text.news_id where m_news_text.id_lang = '" . $this->setting['id_lang'] . "'", "count(*)");
//получаем массив для страниц
        $data["pages"] = $html->pages_count($itogo, $news_setting['news_order_pages'], $id, $this->setting['site'] . "news/all");
//определяем на какой странице мы находимся
        if (!($id == "0")) {
            $id = $id - 1;
            $id = $id * $news_setting['news_order_pages'];
        } else {
            $id = "0";
        }
//выбираем данные для страницы
        $data['news_last_data'] = $this->sql_query("m_news", "left join m_news_text on  m_news.news_id = m_news_text.news_id where m_news_text.id_lang = '" . $this->setting['id_lang'] . "' order by m_news.news_id DESC limit " . $id . "," . $news_setting['news_order_pages'] . "");
//доступ
        $data['access'] = $this->access;
//графическая часть
        $data['file'] = "modules/news/html/all_news_html.php";
        $this->load_theme($data);
    }

    function add_form() {
//данные для титла
        $data=array();
        $data['page'] = $this->module_info['name'] . " | Добавление новости";
        $data['meta'] = '
            <script src="' . $this->setting['site'] . 'js/i18n/jquery-ui-i18n.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $this->setting['site'] . 'js/ui.core.js"></script>
                <!--<script type="text/javascript" src="' . $this->setting['site'] . 'js/ui.dropdownchecklist.js"></script>-->
    <!--    <link rel="stylesheet" type="text/css" href="' . $this->setting['site'] . 'js/ui.dropdownchecklist.css">-->
            <script type="text/javascript" src="' . $this->setting['site'] . 'ckeditor/ckeditor.js"></script>
            <script src="' . $this->setting['site'] . 'ckeditor/sample.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $this->setting['site'] . 'AjexFileManager/ajex.js"></script>
            ';
        $data['section'] = $this->sql_query("m_section_text", "where id_lang = '" . $this->setting['id_lang'] . "'");
        $data['file'] = "modules/news/html/add_form_news_html.php";
        $data['access'] = $this->access;
        $this->load_theme($data);
    }

    function add_post() {
        global $user, $lang;
        if (empty($_POST)) {
            $this->index();
        } else {
            $post=array();
            $message=array();
            $post['news_date_public'] = date("Y-m-d", strtotime($_POST['news_date_public']));
            $post['news_date'] = date("Y-m-d");
            $post['news_section'] = $_POST['news_section'];
            $post['news_section'] = $_POST['news_section'];
            $post['news_on'] = $_POST['news_on'];
            $post['news_autor'] = $user['id_user'];
            $id_post = $this->insert("m_news", $post);
            if ($id_post == false) {
                $message[] = "Данные занесены не было";
            } else {
                $message[] = "Новость добавлена";
            }
            foreach ($lang as $langu) {
                $post_lang=array();
                $post_lang['news_id'] = "$id_post";
                $post_lang['id_lang'] = $langu['id'];
                $post_lang['news_name'] = $_POST['name' . $langu['id']];
                $post_lang['news_anons_text'] = $_POST['anons' . $langu['id']];
                $post_lang['news_text'] = $_POST['text' . $langu['id']];

                //проверяем пустоту названия, текста и анонса
                if ($post_lang['news_name'] == "") {
                    $message[] = 'Название для языка "' . $langu['name_lang'] . '" не задано, язык не добавлен';
                } else {
                    $id_lang = $this->insert("m_news_text", $post_lang);
                    if ($id_lang == true) {
                        $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                    }
                }
                if ($post_lang['news_anons_text'] == "") {
                    $message[] = 'Анонс для языка "' . $langu['name_lang'] . '" не задан';
                }
                $news_text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($post_lang['news_text']));
                if ($news_text == "") {
                    $message[] = 'Текст для языка "' . $langu['name_lang'] . '" не задан';
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
        $data=array();
        $data['message'] = $message;
        $data['access'] = $this->access;
//увеличиваем счетчик просмотров
        $this->sql_count("m_news", "news_count", "where news_id = '" . $id . "'");
//данные о записи
        $data_news = $this->sql_query_one("m_news", "left join m_news_text on  m_news.news_id = m_news_text.news_id where m_news_text.id_lang = '" . $this->setting['id_lang'] . "' and m_news.news_id = '" . $id . "'");
        $data['news_data'] = $data_news;
        $data['data_last'] = $this->sql_query_one("m_news", "left join m_news_text on  m_news.news_id = m_news_text.news_id where m_news_text.id_lang = '" . $this->setting['id_lang'] . "' and m_news.news_id = '" . $id . "'");
        $news_setting = $this->sql_query_one("m_news_setting");
        $data['news_setting'] = $news_setting;
        $data['news_lang'] = $this->sql_query_one("m_news_lang", "where id_lang='" . $this->setting['id_lang'] . "'");
        foreach ($lang as $lang_text) {
            if ($lang_text['id'] <> $this->setting['id_lang']) {
                $text = $this->sql_query_one("m_news_text", "where id_lang = '" . $lang_text['id'] . "' and news_id='" . $id . "'", "news_text");
                $text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($text['news_text']));
                if (!($text == "")) {
                    $text_lang=array();
                    $text_lang[$lang_text['id']] = $this->sql_query_one("lang", "where id='" . $lang_text['id'] . "'");
                }
            }
        }
        if (isset($text_lang)) {
            $data['text_lang'] = $text_lang;
        }
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | " . $data_news['news_name'];
        $data['news_data'] = $data_news;
        $data['meta'] = '<script type="text/javascript" src="/js/thickbox.js"></script>
            <style type="text/css" media="all">@import "/js/thickbox.css";</style>';
        $data['file'] = "modules/news/html/view_news_html.php";
        $this->load_theme($data);
    }

    function edit($id, $message=false) {
        global $lang;
        $data=array();
        $data['message'] = $message;
        $data['access'] = $this->access;
//данные о записи
        $data_news = $this->sql_query_one("m_news", "where m_news.news_id = '" . $id . "'");
        $data['news_data'] = $data_news;
        $data['section'] = $this->sql_query("m_section_text", "where id_lang = '" . $this->setting['id_lang'] . "'");
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | Редактирование";
        $data['meta'] = '<script src="' . $this->setting['site'] . 'js/i18n/jquery-ui-i18n.js" type="text/javascript"></script>
            <script type="text/javascript" src="' . $this->setting['site'] . 'js/ui.core.js"></script>
    <!--<script type="text/javascript" src="' . $this->setting['site'] . 'js/ui.dropdownchecklist.js"></script>-->
    <!--    <link rel="stylesheet" type="text/css" href="' . $this->setting['site'] . 'js/ui.dropdownchecklist.css">-->
            <script type="text/javascript" src="' . $this->setting['site'] . 'ckeditor/ckeditor.js"></script>
	<script src="' . $this->setting['site'] . 'ckeditor/sample.js" type="text/javascript"></script>
        <script type="text/javascript" src="' . $this->setting['site'] . 'AjexFileManager/ajex.js"></script>
            ';
        $data['file'] = "modules/news/html/edit_news_html.php";
        $this->load_theme($data);
    }

    function edit_post($id) {
        global $user, $lang;
        if (empty($_POST)) {
            $this->view($id);
        } else {
            //формируем
            $post=array();
            $message=array();
            $post['news_date_public'] = date("Y-m-d", strtotime($_POST['news_date_public']));
            $post['news_date'] = date("Y-m-d");
            $post['news_section'] = $_POST['news_section'];
            $post['news_on'] = $_POST['news_on'];
            $post['news_autor'] = $user['id_user'];
            //отправляем
            $id_post = $this->sql_edit("m_news", $post, "where news_id='" . $id . "'");
            //обрабатываем
            if ($id_post == false) {
                $message[] = "Основные изменения не внесены";
            } else {
                $message[] = "Основные изменения внесены";
            }
            foreach ($lang as $langu) {
                $id_l = $langu['id'];
                $ulang = false;
                isset($_POST['news_name' . $id_l]) ? $ulang['news_name'] = $_POST['news_name' . $id_l] : false;
                isset($_POST['news_anons_text' . $id_l]) ? $ulang['news_anons_text'] = $_POST['news_anons_text' . $id_l] : false;
                isset($_POST['news_text' . $id_l]) ? $ulang['news_text'] = $_POST['news_text' . $id_l] : false;
                if ($ulang == true) {
                    $id_post_lang = $this->sql_edit("m_news_text", $ulang, "where news_id='" . $id . "' and id_lang = '" . $id_l . "'");
                    if ($id_post_lang == false) {
                        $message[] = "Изменения для " . $langu['name_lang'] . " не внесены";
                    } else {
                        $message[] = "Изменения для " . $langu['name_lang'] . " внесены";
                    }
                }
                $alang = false;
                isset($_POST['add_news_name' . $id_l]) ? $alang['news_name'] = $_POST['add_news_name' . $id_l] : false;
                isset($_POST['add_news_anons_text' . $id_l]) ? $alang['news_anons_text'] = $_POST['add_news_anons_text' . $id_l] : false;
                isset($_POST['add_news_text' . $id_l]) ? $alang['news_text'] = $_POST['add_news_text' . $id_l] : false;
                if ($alang == true) {
                    $alang['news_id'] = "$id";
                    $alang['id_lang'] = "$id_l";
                    if ($alang['news_name'] == "") {
                        $message[] = 'Название для языка "' . $langu['name_lang'] . '" не задано, язык не добавлен';
                    } else {
                        $id_lang = $this->insert("m_news_text", $alang);
                        if ($id_lang == true) {
                            $message[] = 'Добавлен язык "' . $langu['name_lang'] . '"';
                        }

                        if ($alang['news_anons_text'] == "") {
                            $message[] = 'Анонс для языка "' . $langu['name_lang'] . '" не задан';
                        }
                        $news_text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($alang['news_text']));
                        if ($news_text == "") {
                            $message[] = 'Текст для языка "' . $langu['name_lang'] . '" не задан';
                        }
                    }
                }
            }
            if (isset($message)) {
//вызываем просмотр вместе с сообщениями
                $this->view($id, $message);
            } else {
//вызываем просмотр без сообщений
                $this->view($id);
            }
        }
    }
    function admin($message=false) {
        $data=array();
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | Админка модуля";
        $data['meta'] = '';
        $data['message'] = $message;
        $news_setting = $this->sql_query_one("m_news_setting");
        $data['news_setting'] = $news_setting;
        $data['access'] = $this->access;
        $data['file'] = "modules/news/admin/admin_news_html.php";
        $this->load_theme($data);
    }
    function admin_edit($id) {
        global $lang;
        if (empty($_POST)) {
            $this->admin();
        } else {
            $data=array();
            $message=array();
            $data['page'] = $this->get_name_module_page($this->identifcator) . " | Админка модуля";
            $data['meta'] = '';
            $post=array();
            $post['news_order_last'] = $_POST['news_order_last'];
            $post['news_order_top'] = $_POST['news_order_top'];
            $post['news_order_search'] = $_POST['news_order_search'];
            $post['news_order_pages'] = $_POST['news_order_pages'];
            $post['on_comment'] = $_POST['on_comment'];
            $post['news_order_comment'] = $_POST['news_order_comment'];
            $post['on_top'] = $_POST['on_top'];
            $post['on_search'] = $_POST['on_search'];
            $post['format_date'] = $_POST['format_date'];
            $post['text_small'] = $_POST['text_small'];
            $o = $this->sql_edit("m_news_setting", $post);
            if ($o == true) {
                $message[] = "Основные изменения внесены";
            }
            foreach ($lang as $langu) {
                $id_l = $langu['id'];
                $ulang = false;
                isset($_POST['name_m_news' . $id_l]) ? $ulang['name_m_news'] = $_POST['name_m_news' . $id_l] : false;
                isset($_POST['name_news_last' . $id_l]) ? $ulang['name_news_last'] = $_POST['name_news_last' . $id_l] : false;
                isset($_POST['name_news_top' . $id_l]) ? $ulang['name_news_top'] = $_POST['name_news_top' . $id_l] : false;
                isset($_POST['name_news_search' . $id_l]) ? $ulang['name_news_search'] = $_POST['name_news_search' . $id_l] : false;
                isset($_POST['name_news_comment' . $id_l]) ? $ulang['name_news_comment'] = $_POST['name_news_comment' . $id_l] : false;
                isset($_POST['name_news_count' . $id_l]) ? $ulang['name_news_count'] = $_POST['name_news_count' . $id_l] : false;
                isset($_POST['news_read_more' . $id_l]) ? $ulang['news_read_more'] = $_POST['news_read_more' . $id_l] : false;
                isset($_POST['news_read_all' . $id_l]) ? $ulang['news_read_all'] = $_POST['news_read_all' . $id_l] : false;
                isset($_POST['news_rss' . $id_l]) ? $ulang['news_rss'] = $_POST['news_rss' . $id_l] : false;
                $ol = $this->sql_edit("m_news_lang", $ulang, "where id_lang =" . $id_l);
                if ($ol == true) {
                    $message[] = "Внесены изменения для языка" . $langu['name_lang'] . "";
                }
                $langa = false;
                isset($_POST['add_name_m_news' . $id_l]) ? $langa['name_m_news'] = $_POST['add_name_m_news' . $id_l] : false;
                isset($_POST['add_name_news_last' . $id_l]) ? $langa['name_news_last'] = $_POST['add_name_news_last' . $id_l] : false;
                isset($_POST['add_name_news_top' . $id_l]) ? $langa['name_news_top'] = $_POST['add_name_news_top' . $id_l] : false;
                isset($_POST['add_name_news_search' . $id_l]) ? $langa['name_news_search'] = $_POST['add_name_news_search' . $id_l] : false;
                isset($_POST['add_name_news_comment' . $id_l]) ? $langa['name_news_comment'] = $_POST['add_name_news_comment' . $id_l] : false;
                isset($_POST['add_news_read_more' . $id_l]) ? $langa['news_read_more'] = $_POST['add_news_read_more' . $id_l] : false;
                isset($_POST['add_news_read_all' . $id_l]) ? $langa['news_read_all'] = $_POST['add_news_read_all' . $id_l] : false;
                isset($_POST['add_news_rss' . $id_l]) ? $langa['news_rss'] = $_POST['add_news_rss' . $id_l] : false;
                if (!(empty($langa))) {
                    $langa['id_lang'] = $id_l;
                    $al = $this->insert('m_news_lang', $langa);
                    if ($al == true) {
                        $message[] = "Добавлены данные для языка" . $langu['name_lang'] . "";
                    }
                }
            }
            $this->admin($message);
        }
    }

    function del($id) {
        global $setting;
        include_once 'modules/news/html/del_news.php';
    }

    function del_post($id) {
        global $setting;
        $message=array();
        $o = $this->sql_del("m_news", "where news_id = '" . $id . "'");
        $message[] = "Было удалено записей:" . $o;
        $this->index($message);
    }
}
new news_index();
?>
