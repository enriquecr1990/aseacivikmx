<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller {

    function __construct(){
        parent:: __construct();
        $this->load->model('testing_model','Testing_model');
    }

    public function test_select(){
        $this->Testing_model->testing_select();
    }

    public function test_helper(){
        $fecha = '04/06/1990';
        $fecha_db = fechaHtmlToBD($fecha);
        var_dump($fecha,$fecha_db);
    }

    public function test_host(){
        var_dump(esServerAndroid());
    }

    public function test_encript(){
        $this->load->model('ControlUsuariosModel');
        $strOriginal = 'password1234';
        $strEncripAsea = encriptarAsea($strOriginal);
        $strDecrypAsea = desencritarAsea($strEncripAsea);
        var_dump($strOriginal,$strEncripAsea,$strDecrypAsea);
        $strEncryp = encrypAsea($strOriginal);
        $strDecryp = decrypAsea($strEncryp);
        var_dump($strEncryp,$strDecryp);
        //$this->ControlUsuariosModel->obtenerUsuarioSesion(array('usuario'=>'civikholding','password'=>'Pa$$wordCivik'));
    }

    /*public function otro_encrytp(){
        $plain_text = 'Pa$$wordCivik';
        $ciphertext = $this->encryption->encrypt($plain_text);
        echo  $ciphertext;
    }*/

    public function test_date(){
        var_dump(date('Y-m-d H:i:s'));
        var_dump(date('Y-m-d h:i:s'));
    }

    public function testDirectorios(){
        $ruta =  RUTA_VIDEOS_NORMAS;
        $data['navegacion'] = listar_directorios_ruta($ruta);
        print_r($data['navegacion']);
        //var_dump($data['navegacion']);
    }

    public function testMargueArray(){
        $dataUno['uno'] = 1;
        $dataUno['dos'] = 2;
        $dataUno['tres'] = 3;
        $dataDos['cuatro'] = 4;
        $dataDos['cinco'] = 5;
        $dataDos['seis'] = 6;
        $data = array_merge($dataUno,$dataDos);
        var_dump($data);
    }

    public function testSession(){
        var_dump(sesionAsea());exit;
    }

    public function testPDF(){
        $this->load->library();
    }

    public function testHost(){
        var_dump($_SERVER);exit;
    }
}