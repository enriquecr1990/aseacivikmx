<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ControlUsuarios extends CI_Controller {

    public $usuario;

    function __construct(){
        parent:: __construct();
        $this->load->model('ControlUsuariosModel');
        $this->load->model('EstacionServicioModel');
        if(sesionAsea()){
            $this->usuario = $this->session->userdata('usuario');
        }else{
            $this->usuario = false;
            redirect(base_url('Asea'));
        }
    }

    public function index(){
        $data['usuario'] = $this->usuario;
        $data['extra_js'] = array(
            base_url('extras/asea/control_usuario/control_usuarios.js')
        );
        $data['tipo_usuario'] = $this->obtenerTiposUsuario();
        $this->load->view('asea/control_usuarios/Usuario',$data);
    }

    public function buscarUsuariosSistema(){
        $post = $this->input->post();
        $data['listaUsuario'] = $this->ControlUsuariosModel->obtenerUsuariosSistema($post);
        $this->load->view('asea/control_usuarios/ResultadosBusquedaUsuarios',$data);
    }

    public function agregarModificarUsuario($idUsuarioAdmin=false){
        $data = array();
        $post = $this->input->post();
        if($idUsuarioAdmin){
            $data['usuario_admin'] = $this->ControlUsuariosModel->obtenerUsuarioAdministrador($idUsuarioAdmin);
            $data['usuario'] = $this->ControlUsuariosModel->obtenerUsuario($data['usuario_admin']->id_usuario);
            $data['tipo_usuario'] = isset($post['tipo_usuario']) ? $post['tipo_usuario'] : 'trabajador';
            $data['es_configuracion'] = isset($post['es_configuracion']) ? true : false;
        }
        $this->load->view('asea/control_usuarios/RegistrarModificarUsuario',$data);
    }

    public function configuracion(){
        $data['extra_js'] = $this->obtenerScriptsConfiguracion();
        $data['usuario'] = $this->usuario;
        if(isset($data['usuario']->es_rh_empresa) && $data['usuario']->es_rh_empresa){
            $data['estacion'] = $this->EstacionServicioModel->obtenerEstacionServicioFromIdUsuario($data['usuario']->id_usuario);
        }
        //var_dump($data);exit;
        $this->load->view('asea/control_usuarios/ConfiguracionUsuario',$data);
    }

    public function guardarUsuario(){
        $form_post = $this->input->post();
        $retorno = $this->ControlUsuariosModel->guardarUsuarioAdminstrador($form_post);
        if(isset($form_post['es_configuracion']) && $form_post['es_configuracion'] == 1){
            if($retorno['exito'] && strpos($form_post['usuario']['tipo'], 'admin') !== false){
                $usuario = $this->usuario;
                $usuario->nombre = $form_post['usuario_admin']['nombre'];
                $usuario->apellido_p = $form_post['usuario_admin']['apellido_p'];
                $usuario->apellido_m = $form_post['usuario_admin']['apellido_m'];
                $usuario->correo = $form_post['usuario_admin']['correo'];
                $usuario->telefono = $form_post['usuario_admin']['telefono'];
                $usuario->update_password = $form_post['usuario']['update_password'];
                $usuario->usuario_sistema = $form_post['usuario_admin']['nombre'].' '.$form_post['usuario_admin']['apellido_p'];
                $sesion['existe'] = true;
                $sesion['msg'] = '';
                $sesion['usuario'] = $usuario;
                $this->session->set_userdata($sesion);
                $this->usuario = $usuario;
                $retorno['recargar'] = true;
            }
        }
        echo json_encode($retorno);
        exit;
    }

    public function activarDesactivarUsuario($idUsuarioAdmin){
        $result['exito'] = false;
        $result['msg'] = 'No fue posible cambiar el estatus del usuario administrador, favor de intentar más tarde';
        if($this->ControlUsuariosModel->activarDesactivarUsuario($idUsuarioAdmin)){
            $result['exito'] = true;
            $result['msg'] = 'Se actualizó el estatus del usuario administrador con éxito';
        }
        echo json_encode($result);
        exit;
    }

    public function eliminarUsuarioAdmin($idUsuarioAdmin){
        $result['exito'] = false;
        $result['msg'] = 'No fue posible eliminar el usuario administrador, favor de intentar mas tarde';
        if($this->ControlUsuariosModel->eliminarUsuarioAdmin($idUsuarioAdmin)){
            $result['exito'] = true;
            $result['msg'] = 'Se elimino el usuario administrador con éxito';
        }
        echo json_encode($result);
        exit;
    }

    private function obtenerTiposUsuario(){
        $tipos = array(
            array('value' => 'admin','label' => 'Administrador'),
            array('value' => 'rh_empresa','label' => 'Recursos Humanos ES'),
            array('value' => 'trabajador','label' => 'Trabajador ES'),
        );
        return $tipos;
    }

    private function obtenerScriptsConfiguracion(){
        $usuario = $this->usuario;
        $scripts = array();
        if(isset($usuario->es_administrador) && $usuario->es_administrador ||
            isset($usuario->es_admin) && $usuario->es_admin){
            $scripts = array(
                base_url('extras/asea/control_usuario/control_usuarios.js')
            );
        }if(isset($usuario->es_rh_empresa) && $usuario->es_rh_empresa){
            $scripts = array(
                base_url().'extras/datepicker/js/bootstrap-datepicker.js',
                base_url().'extras/datepicker/locales/bootstrap-datepicker.es.min.js',
                base_url().'extras/fileinput/js/fileinput.js',
                base_url().'extras/fileupload/js/vendor/jquery.ui.widget.js',
                base_url().'extras/fileupload/js/jquery.iframe-transport.js',
                base_url().'extras/fileupload/js/jquery.fileupload.js',
                base_url().'extras/asea/es/es_registro.js'
            );
        }if(isset($usuario->es_trabajador) && $usuario->es_trabajador){
            $scripts = array(
                base_url(). 'extras/asea/empleados_es/empleados_es.js'
            );
        }
        return $scripts;
    }
}