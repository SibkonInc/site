<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of action
 *
 * @author Yerick
 */

   function access($id) {
        $data['page'] = $this->admin['page'] . " | Уровни доступа";
        $data['meta'] = "";
        if (empty($id)) {
            $data['acesss'] = $this->sql_query("access");
            $data['file'] = "modules/admin/html/access_html.php";
        }
        $this->load_theme($data);
    }

?>
