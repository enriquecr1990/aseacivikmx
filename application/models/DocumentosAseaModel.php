<?php

defined('BASEPATH') OR exit('No tiene access al script');

class DocumentosAseaModel extends CI_Model{

    /**
     * metodos publicos para obtener informacion de las estaciones de servicio
     */

    public function obtenerDocumentoAsea($idDocumentoAsea){
        $this->db->where('id_documento_asea',$idDocumentoAsea);
        $query = $this->db->get('documento_asea');
        return $query->row();
    }

    /**
     * metodos de funciones para actualizar la  informacion de las ES
     */
    public function guardarDocumentoAsea($datos_doc){
        $datos_doc['fecha'] = date('Y-m-d H:i:s');
        $this->db->insert('documento_asea',$datos_doc);
        return $this->db->insert_id();
    }

    public function elimiarDocumentoAsea($idDocumentoAsea){
        $this->db->where('id_documento_asea',$idDocumentoAsea);
        return $this->db->delete('documento_asea');
    }


    /*
     * apartado de funciones privadas a las ES
     */


}

?>