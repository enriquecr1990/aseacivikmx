<?php

defined('BASEPATH') OR exit('No tiene access al script');

class Testing_model extends CI_Model{

    /**
     * metoso publics para guardar informacion
     */
    public function testing_select(){
        $query = $this->db->get('usuario');
        $result = $query->result();
        var_dump($result);
    }

}

?>