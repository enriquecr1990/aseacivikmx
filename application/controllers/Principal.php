<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

    public $usuario;

    function __construct(){
        parent:: __construct();
        $this->load->model('ControlUsuariosModel');
        if(sesionAsea()){
            $this->usuario = $this->session->userdata('usuario');
        }else{
            $this->usuario = false;
        }
    }

    public function index() {
        $data['extra_js'] = array(
            base_url('extras/asea/es/es_registro.js')
        );
        $data['usuario'] = $this->usuario;
        //var_dump($data);exit;
        $this->load->view('sistema/inicio',$data);
    }

    public function iniciarSesionAsea(){
        $post = $this->input->post();
        $sesion = $this->ControlUsuariosModel->obtenerUsuarioSesion($post);
        if($sesion['existe']){
            $this->session->set_userdata($sesion);
            $this->usuario = $sesion['usuario'];
        }
        $this->index();
    }

    public function cerrarSesionAsea(){
        $this->session->sess_destroy();
        $this->usuario = false;
        $this->index();
    }

    /*public function iniciarRegistroES(){
        $this->load->view('asea/estacion_servicio/RegistroES');
    }*/

    public function menus(){
        $this->load->view('sistema/menus_bootstrap');
    }
    
    public function wizard(){
        $data['extra_js'] = array(
            base_url('extras/proyecto/wizard.js')
        );
        $this->load->view('wizard/principalWizard',$data);
    }

    public function generar_imagen_de_codigo($codigo){
        header ("Content-type: image/png");
        $string = $codigo;
        $font = 13;
        $width = (ImageFontWidth($font) * strlen($string)) + 18;
        $height = ImageFontHeight($font) + 10;

        $im = @imagecreate ($width,$height);
        $background_color = imagecolorallocate ($im, 28, 141, 183); //white background
        $text_color = imagecolorallocate ($im, 255,255,255);//black text
        imagestring ($im, $font, 9, 5, $string, $text_color);
        imagepng ($im);
    }
    
    public function ahorcado(){
        $data['extra_js'] = array(
            base_url('extras/proyecto/wizard.js')
        );
        $data['teclado'] = $this->obtener_teclado();
        $this->load->view('ahorcado/juego_ahorcado',$data);
    }

    private function obtener_teclado(){
        $teclado = array(
            array('1','2','3','4','5','6','7','8','9','0'),
            array('Q','W','E','R','T','Y','U','I','O','P'),
            array('A','S','D','F','G','H','J','K','L','Ñ'),
            array('Z','X','C','V','B','N','M')
        );
        return $teclado;
    }


}
