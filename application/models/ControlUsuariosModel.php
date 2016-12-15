<?php

defined('BASEPATH') OR exit('No tiene access al script');

class ControlUsuariosModel extends CI_Model{

    public function obtenerUsuarioSesion($form_post){
        $result['existe'] = false;
        $result['msg'] = 'No existe el usuario en el sistema';
        $this->db->where('usuario',$form_post['usuario']);
        $query = $this->db->get('usuario');
        if($query->num_rows() != 0){
            $row = $query->row();
            $pass_decryp = decrypAsea($row->password);
            if($pass_decryp == $form_post['password']){
                $result['existe'] = true;
                $result['usuario'] = $this->obtenerDatosUsuario($row->id_usuario,$row->tipo);
                if($row->activo == 'si'){
                    $result['msg'] = '';
                    if($row->verificado == 'no'){
                        $result['msg'] = 'Su cuenta en el sistema no se encuentra verificada favor de realizar su verificación';
                    }
                    $result['usuario']->activo = true;
                    $result['usuario']->verificado = $row->verificado == 'si' ? true : false;
                    $result['usuario']->update_password = $row->update_password;
                }else{
                    $result['msg'] = 'Su cuenta en el sistema ha sido desactivada, favor de contactar con el administrador para verificar su estatus';
                    $result['usuario']->activo = false;
                }
            }else{
                $result['existe'] = false;
                $result['msg'] = 'Constraseña incorrecta, favor de verificar';
            }
        }
        return $result;
    }

    public function obtenerUsuariosSistema($post_form){
        $consulta = "select 
              u.id_usuario,u.tipo,u.activo,
              if(u.activo = 'si',true,false) es_activo,
              ua.*
            from usuario u 
              inner join usuario_admin ua on ua.id_usuario = u.id_usuario
            where u.tipo = 'admin'";
        $consulta .= $this->obtenerCriteriosAdicionalesUsuarios($post_form);
        $query = $this->db->query($consulta);
        $result = $query->result();
        return $result;
    }

    public function obtenerUsuarioAdministrador($idUsuarioAdmin){
        $this->db->where('id_usuario_admin',$idUsuarioAdmin);
        $query = $this->db->get('usuario_admin');
        return $query->row();
    }

    public function obtenerUsuario($idUsuario){
        $this->db->where('id_usuario',$idUsuario);
        $query = $this->db->get('usuario');
        $row = $query->row();
        $row->password = $this->encrypt->decode($row->password);
        return $row;
    }

    public function configurarUsuario($idUsuario){
        $usuario = $this->obtenerUsuario($idUsuario);
        $retorno = $this->obtenerDatosUsuario($usuario->id_usuario,$usuario->tipo);
        $retorno->activo = $usuario->activo == 'si' ? true : false;
        $retorno->verficado = $usuario->verificado == 'si' ? true : false;
        $retorno->update_password = $usuario->update_password;
        return $retorno;
    }

    public function guardarUsuarioAdminstrador($form_post){
        $retorno['exito'] = true;
        $retorno['msg'] = 'No fue posible guardar el usuario administrador, favor de intentar más tarde';
        $form_post['usuario']['password'] = encrypAsea($form_post['usuario']['password']);
        $existe_usuario = $this->obtenerUsuarioFromUsuario($form_post['usuario']['usuario']);
        if(isset($form_post['usuario']['id_usuario']) && $form_post['usuario']['id_usuario'] == ''){
            if($existe_usuario){
                $retorno['exito'] = false;
                $retorno['msg'] = 'El usuario ya existe en el sistema, favor de verificar el nombre de usuario';
            }else{
                $this->db->insert('usuario',$form_post['usuario']);
                $idUsuario = $this->db->insert_id();
                $form_post['usuario_admin']['id_usuario'] = $idUsuario;
                $this->db->insert('usuario_admin',$form_post['usuario_admin']);
                $retorno['msg'] = 'Se guardo el administrador con éxito';
            }
        }else{
            if(($existe_usuario && $existe_usuario->id_usuario == $form_post['usuario']['id_usuario'])
                || !$existe_usuario){
                $this->db->where('id_usuario',$form_post['usuario']['id_usuario']);
                $this->db->update('usuario',$form_post['usuario']);
                $this->db->where('id_usuario_admin',$form_post['usuario_admin']['id_usuario_admin']);
                $retorno['exito'] = $this->db->update('usuario_admin',$form_post['usuario_admin']);
                $retorno['msg'] = 'Se actualizo el administrador con éxito';
            }else{
                $retorno['exito'] = false;
                $retorno['msg'] = 'El usuario ya existe en el sistema, favor de verificar el nombre de usuarios';
            }
        }
        return $retorno;
    }

    public function activarDesactivarUsuario($idUsuarioAdmin){
        $usuarioAdmin = $this->obtenerUsuarioAdministrador($idUsuarioAdmin);
        $usuario = $this->obtenerUsuario($usuarioAdmin->id_usuario);
        $usuarioUpdate['activo'] = $usuario->activo == 'si' ? 'no' : 'si';
        $this->db->where('id_usuario',$usuario->id_usuario);
        return $this->db->update('usuario',$usuarioUpdate);
    }

    public function eliminarUsuarioAdmin($idUsuarioAdmin){
        $usuarioAdmin = $this->obtenerUsuarioAdministrador($idUsuarioAdmin);
        $this->db->where('id_usuario_admin',$usuarioAdmin->id_usuario_admin);
        $this->db->delete('usuario_admin');
        $this->db->where('id_usuario',$usuarioAdmin->id_usuario);
        return $this->db->delete('usuario');
    }

    public function obtenerUsuarioFromUsuario($nombreUsuario){
        $this->db->where('usuario',$nombreUsuario);
        $query = $this->db->get('usuario');
        if($query->num_rows() == 0){
            return false;
        }
        return $query->row();
    }

    public function obtenerDatosUsuario($idUsuario,$tipoUsuario){
        $usuario = new stdClass();
        switch ($tipoUsuario){
            case 'administrador':
            case 'admin':
                $this->db->where('id_usuario',$idUsuario);
                $query = $this->db->get('usuario_admin');
                $usuario = $query->row();
                $usuario->usuario_sistema = $usuario->nombre.' '.$usuario->apellido_p;
                $usuario->es_administrador = false;
                $usuario->es_admin = true;
                $usuario->imagen_usuario = base_url().'extras/imagenes/administrador_01.png';
                if($tipoUsuario == 'administrador'){
                    $usuario->es_administrador = true;
                    $usuario->es_admin = false;
                    $usuario->imagen_usuario = base_url().'extras/imagenes/administrador_01.png';
                }
                break;
            case 'rh_empresa':
                $this->db->where('id_usuario',$idUsuario);
                $query = $this->db->get('estacion_servicio');
                $usuario = $query->row();
                $usuario->usuario_sistema = $usuario->rfc;
                $usuario->es_rh_empresa = true;
                $usuario->imagen_usuario = $this->obtenerImagenEstacionEmpleado($usuario->id_estacion_servicio);
                break;
            case 'trabajador':
                $this->db->where('id_usuario',$idUsuario);
                $query = $this->db->get('empleado_es');
                $usuario = $query->row();
                $usuario->usuario_sistema = $usuario->nombre.' '.$usuario->apellido_p;
                $usuario->es_trabajador = true;
                $usuario->imagen_usuario = $this->obtenerImagenEstacionEmpleado($usuario->id_estacion_servicio);
                break;
        }
        return $usuario;
    }

    /**
     * apartado de funciones privadas para el control de usuario del asea
     */
    private function obtenerCriteriosAdicionalesUsuarios($form_post){
        $criterios = '';
        return $criterios;
    }

    private function obtenerImagenEstacionEmpleado($idEstacionServicio){
        $consulta = "select da.* from documento_asea da
              inner join estacion_servicio_tiene_documento estd on estd.id_documento_asea = da.id_documento_asea
              where estd.id_estacion_servicio = $idEstacionServicio";
        $query = $this->db->query($consulta);
        $documento_asea = $query->row();
        return base_url().$documento_asea->ruta_directorio.$documento_asea->nombre;
    }
}

?>