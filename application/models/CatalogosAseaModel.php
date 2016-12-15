<?php

defined('BASEPATH') OR exit('No tiene access al script');

class CatalogosAseaModel extends CI_Model{

    /**
     * metodos para obtener los catalogos del sistema ASEA
     */
    public function obtenerCatalogoOpcionesPregunta(){
        $query = $this->db->get('catalogo_tipo_opciones_pregunta');
        return $query->result();
    }

    public function obtenerCatalogoAnio(){
        $anios = array();
        for ($i = 2015; $i <= date('Y');$i++){
            $anios[$i] = $i;
        }
        return $anios;
    }

    public function obtenerOrdenamientoNorma(){
        $ordenamieto = array();
        for ($i = 1; $i < 13 ;$i++){
            $ordenamieto[$i] = $i;
        }
        return $ordenamieto;
    }

}

?>