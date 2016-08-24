<?php

/** Модуль секций */
class section_index extends ycms {

    var $access; //доступ к модулю
    var $identifcator = "section";//идентификатор модуля
    var $module_info;
    
/** Разбираем запрос чтоб определить куда идти */
    function __construct() {
        global $setting;
//получаем идентификатор модуля
        $this->module_info = $this->sql_query_one("module", "join module_lang on module.id = module_lang.id_id where module.identif = '" . $this->identifcator . "' and module_lang.id_lang = '" . $setting['id_lang'] . "'");
        $setting['module_id'] = $this->module_info['id'];
        $this->access = $this->access_dostup($this->module_info['access']);
//получаем данные из командной строки что делаем
        $url = $this->get_url();
//определяем что сейчас нужно делать
        switch ($url['action']) {
//просмотр одного
            case 'view':if ($this->access['access_view'] == "1") {$this->view($url['id']);} else {$this->index();} break;
//форма добавления нового
            case 'add_form':if ($this->access['access_add'] == "1") {$this->add_form($url['id']);} else {$this->index();} break;
//механизм добавления
            case 'add': if ($this->access['access_add'] == "1") {$this->add();} else {$this->index();}break;
//форма удаления
            case 'del': if ($this->access['access_del'] == "1") {$this->del($url['id']);} else {$this->index();}break;
//обработка удаления
            case 'del_post': if ($this->access['access_del'] == "1") {$this->del_post($url['id']);} else {$this->index();}break;
//редатирование
            case 'edd': if ($this->access['access_edit'] == "1") {$this->edit($url['id']);} else {$this->index();}break;
//главная
            default: $this->index();
                break;
        }
    }

/** предупреждение перед удалением */
    function del($id) {
        global $setting;
        include_once 'modules/section/html/del_section.php';
    }

/** Обработка удаления */
    function del_post($id) {
        global $setting;
        $o = $this->sql_del("m_section", "where section_id = '" . $id . "'");
        $message=array();
        $message[] = "Было удалено записей:".$o;
        $this->index($message);
    }


/** Редактирование секции */
    function edit($id) {
        global $setting, $user;
//определяем массив. если пустой пост, открываем режим редактирования
        if (empty($_POST)) {
            $data = array();
//данные для титла
            $data['page'] = $this->get_name_module_page($this->identifcator) . " | Редактирование";
            $data['meta'] = '<script type="text/javascript" src="' . $setting['site'] . 'ckeditor/ckeditor.js"></script>
	<script src="' . $setting['site'] . 'ckeditor/sample.js" type="text/javascript"></script>
        <script type="text/javascript" src="' . $setting['site'] . 'AjexFileManager/ajex.js"></script>
            ';

//данные раздела
            $data['data_section'] = $this->sql_query_one("m_section", "where section_id = '" . $id . "'");

//данные для выпадающего списка
            $data['section_name'] = $this->sql_query("m_section", "join m_section_text on m_section.section_id = m_section_text.id_id where m_section_text.id_lang = '" . $setting['id_lang'] . "'", "id_id,name");

//определяем языки
            $data['lang'] = $this->sql_query("lang");

//подключаем внешний вид
            $data['file'] = "modules/section/html/edit_section.php";
            $this->load_theme($data);

//иначе начинаем проработку изменения
        } else {

//выбираем необходимые данные из массива - основные данные и обновляем конкретно их
            $post=array();
            $post['section_id_id'] = $_POST['section_id_id'];
            $post['online'] = $_POST['online'];
            $post['section_nomer'] = $_POST['section_nomer'];
            $o = $this->sql_edit("m_section", $post, "where section_id='" . $id . "'");
            if ($o == true) {$message[] = "Основные изменения внесены";}

//определяем языки и выбираем данные для языков
            $lan = $this->sql_query("lang");
            foreach ($lan as $langu) {
                $id_l = $langu['id'];
                $lang=array();
                $lang['id_lang'] = "$id_l";
                $lang['id_id'] = "$id";
                $lang['name'] = $_POST["name" . $id_l];
                $lang['text'] = $_POST["text" . $id_l];
                $lang['id_autor'] = $user['id_user'];

//тут надо определиться с версиями когда подключим
                $lang['version'] = $user['id_user'];
                $o = $this->sql_edit("m_section_text", $lang, "where id_id='" . $id . "' and id_lang='" . $id_l . "'");
                if ($o == true) {
                    $message=array();
                    $message[] = 'Изменения в язык "' . $langu['name_lang'] . '"';
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

/** Добавление записей */
    function add() {
        global $user, $setting;

        if (empty($_POST)) {$this->index();} else {
//определяем массив что послан
            $post=array();
            $post['section_id_id'] = $_POST['section_id_id'];
            $post['online'] = $_POST['online'];
            $post['section_nomer'] = $_POST['section_nomer'];
//тут выполняем действия по менюшке
            $id_zap = $this->insert("m_section", $post);
$message=array();
            if ($id_zap == false) {

                $message[] = "Данные занесены не было";} else {$message[] = "Данные занесены";}
//действия с языками
            $lan = $this->sql_query("lang");
            foreach ($lan as $langu) {
                $id = $langu['id'];
                $lang=array();
                $lang['id_lang'] = "$id";
                $lang['id_id'] = "$id_zap";
                $lang['name'] = $_POST["name" . $id];
                $lang['text'] = $_POST["text" . $id];
                $lang['id_autor'] = $user['id_user'];
                $lang['version'] = $user['id_user'];
                $o =$this->insert("m_section_text", $lang);
                if ($o == true) {$message[] = 'Добавлены данные в язык "' . $langu['name_lang'] . '"';}
            }
            if (isset($message)) {
//вызываем просмотр вместе с сообщениями
                $this->view($id_zap, $message);
            } else {
//вызываем просмотр без сообщений
                $this->view($id_zap);
            }
        }
    }

/** Главная страница разделов */
    function index($message=false) {
        global $setting;
        $data=array();
        $data['message'] = $message;
//данные для титла
        $data['page'] = $this->get_name_module_page($this->identifcator);
        $data['meta'] = '';
//название для самого модуля
        $where = "where id_lang = '" . $setting['id_lang'] . "'";
        $data['section_data_name'] = $this->sql_query_one("m_section_lang", $where);
//данные о записях
        $where2 = "where id_lang = '" . $setting['id_lang'] . "' and id_id=4";
        $data['section_data'] = $this->sql_query_one("module_lang", $where2);
//подключаем графическую часть
        $data['file'] = "modules/section/html/index_html.php";
        $data['access'] = $this->access;
        $this->load_theme($data);
    }

    function add_form($id="0") {
        global $setting;
//данные для титла
         $data=array();
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | Добавление раздела";
        $data['meta'] = '<script type="text/javascript" src="' . $setting['site'] . 'ckeditor/ckeditor.js"></script>
	<script src="' . $setting['site'] . 'ckeditor/sample.js" type="text/javascript"></script>
        <script type="text/javascript" src="' . $setting['site'] . 'AjexFileManager/ajex.js"></script>
';
//узнаем языки
        $data['lang'] = $this->sql_query("lang");
        //узнаем секции для выпадающего списка
        $data['section_name'] = $this->sql_query("m_section", "join m_section_text on m_section.section_id = m_section_text.id_id where id_lang = '" . $setting['id_lang'] . "'");
        //усли вызвано из раздела - проставляем его ид
        $data['id_sect_post'] = "$id";

//файл внешнего вида и загрузка графической темы
        $data['file'] = "modules/section/html/add_section.php";
        $this->load_theme($data);
    }

/** Просмотр раздела */
    function view($id, $message=false) {
        global $setting;
         $data=array();
        $data['message'] = $message;
//получаем данные по записи из таблице в соответствии с языком
        $where = "left join m_section_text on  m_section.section_id = m_section_text.id_id where m_section_text.id_lang = '" . $setting['id_lang'] . "' and m_section.section_id = '" . $id . "'";
        $name_sect = $this->sql_query_one("m_section", $where);
//определяем есть ли данные тексты на других языках
        $lang = $this->sql_query("lang", "where id <>'" . $setting['id_lang'] . "'");
        foreach ($lang as $lang_text) {
            $text = $this->sql_query_one("m_section_text", "where id_lang = '" . $lang_text['id'] . "' and id_id='" . $id . "'", "text");
            $text = preg_replace("/[^A-Z0-9А-Я.-_]/i", "", strip_tags($text['text']));
            if (!($text == "")) {
                 $text_lang=array();
                $text_lang[$lang_text['id']] = $this->sql_query_one("lang", "where id='" . $lang_text['id'] . "'");
            }
        }
        if (isset($text_lang)) {$data['text_lang'] = $text_lang;}
     
//данные для титла и метатегов
        $data['section_data'] = $name_sect;
        $data['page'] = $this->get_name_module_page($this->identifcator) . " | " . $name_sect['name'];
        $data['meta'] = '<script type="text/javascript" src="/js/thickbox.js"></script>
            <style type="text/css" media="all">@import "/js/thickbox.css";</style>';

//данные о доступе для страницы
        $data['access'] = $this->access;
//данные для верхней цепочки
        $where = "where id_lang = '" . $setting['id_lang'] . "'";
        $section_data_name = $this->sql_query_one("m_section_lang", $where);
        $data['section_data_name'] = $section_data_name;

//файл для внешнего вида
        $data['file'] = "modules/section/html/view_html.php";
        $this->load_theme($data);
    }

}

new section_index();
?>
