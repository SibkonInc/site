<?php
class pages_index extends ycms {

    //put your code here

    function __construct() {
        $url = "";
        $url = $this->get_url();
        switch ($url['action']) {

            case 'view': $this->view($url['id']);
                break;

            default: $this->index();
                break;
        }
    }
    function index() {
        $data['page'] = "Страницы";
        $data['meta'] = "";
        $data['file'] = "modules/pages/html/index_html.php";
        $this->load_theme($data);
    }

}

new pages_index();
?>
