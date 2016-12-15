<?php

	function fechaHtmlToBD($fecha){
		if($fecha == '' || $fecha == null){
			return '';
		}
		$fecha_explode = explode('/',$fecha);
		$fecha_retorno = $fecha_explode[2] . '-' . $fecha_explode[1] . '-' . $fecha_explode[0];
		return $fecha_retorno;
	}

	function fechaBDToHtml($fecha){
	    $fecha_html = date_format(date_create($fecha),'d/m/Y');
        return $fecha_html;
    }

    function enConstrucion(){
        redirect(base_url().'Asea/enCostruccion');
    }

    function testHost(){
        var_dump($_SERVER);
    }

    function esServerAndroid(){
        $retorno = false;
        $server = $_SERVER;
        if(strpos($server['SERVER_SOFTWARE'],'AndroPHP')){
            $retorno = true;
        }
        return $retorno;
    }

    function base_url_asea (){
        $esAndroid = esServerAndroid();
        if($esAndroid){
            return base_url().'index.php/';
        }else{
            return base_url();
        }
    }

    function is_ajax(){
        $CI =& get_instance();
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') || $CI->input->is_ajax_request())
            return true;
        else
            return false;
    }

    function upload_file_asea($file,$values=array()){
        $options = array(
            'field'    => 'file',
            'pre'      => rand(1000000,9999999).'-',
            'path' 	   => '',
            'filename' => ''
        );
        $options = array_merge($options,$values);
        //falta agregar subdirectorios en caso de existan
        if($options['path'] != '') {
            if (!file_exists(FCPATH . $options['path'])) {
                mkdir(FCPATH . $options['path'],077,true);
            }
        }

        $config['upload_path'  ] = FCPATH.$options['path'];
        $config['allowed_types'] = EXTENSIONES_FILES_IMG;
        $config['max_size']      = MAX_FILESIZE;
        $config['file_name']     = $options['pre'].remove_caracteres_especiales($file['name']);
        $options['filename']     = $options['pre'].remove_caracteres_especiales($options['filename']);
        $CI =& get_instance();
        $CI->load->library('upload', $config);
        if ( !$CI->upload->do_upload($options['field']) )
            return array('error' => $CI->upload->display_errors().' '.$config['file_name']);
        else
            return $CI->upload->data();
    }

    function remove_caracteres_especiales($str){
        $str = strtolower($str);
        $text = htmlentities($str, ENT_QUOTES, 'UTF-8');
        $patron = array (
            // Espacios, puntos y comas por guion
            //'/[\., ]+/' => ' ',
            // Vocales
            '/\+/' => '',
            '/&agrave;/' => 'a',
            '/&egrave;/' => 'e',
            '/&igrave;/' => 'i',
            '/&ograve;/' => 'o',
            '/&ugrave;/' => 'u',

            '/&aacute;/' => 'a',
            '/&eacute;/' => 'e',
            '/&iacute;/' => 'i',
            '/&oacute;/' => 'o',
            '/&uacute;/' => 'u',

            '/&acirc;/' => 'a',
            '/&ecirc;/' => 'e',
            '/&icirc;/' => 'i',
            '/&ocirc;/' => 'o',
            '/&ucirc;/' => 'u',

            '/&atilde;/' => 'a',
            '/&etilde;/' => 'e',
            '/&itilde;/' => 'i',
            '/&otilde;/' => 'o',
            '/&utilde;/' => 'u',

            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',

            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',

            // Otras letras y caracteres especiales
            '/&aring;/' => 'a',
            '/&ntilde;/' => 'n',

            // Agregar aqui mas caracteres si es necesario

        );

        $text = preg_replace(array_keys($patron),array_values($patron),$text);
        return $text;

    }

    function listar_directorios_ruta($ruta){
        $subruta = $ruta;
        $ruta_directorio = FCPATH . $ruta;
        $retorno = array();
        if(is_dir($ruta)){
            $index = 0;
            $directorio = dir($ruta_directorio);
            while($archivo = $directorio->read()){
                if($archivo != '.' && $archivo != '..'){
                    if(is_dir($ruta_directorio.'/'.$archivo)){
                        $retorno[$index]['es_carpeta'] = true;
                        $retorno[$index]['nombre_carpeta'] = $archivo;
                        $retorno[$index]['ruta_carpeta'] = $subruta;
                        $retorno[$index]['contenido'] = listar_directorios_ruta($subruta . '/' .$archivo);
                    }else{
                        $retorno[$index]['es_carpeta'] = false;
                        $retorno[$index]['nombre_archivo'] = $archivo;
                        $retorno[$index]['ruta_archivo'] = $subruta;
                    }
                    $index++;
                }
            }
            $directorio->close();
        }
        return $retorno;
    }

    function sesionAsea(){
        $ch =& get_instance();
        $sesion = $ch->session->userdata();
        //var_dump($sesion);exit;
        if(isset($sesion['usuario']) && $sesion['usuario']){
            return $sesion;
        }
        return false;
    }

    function encriptarAsea($strEncriptar){
        return base64_encode($strEncriptar);
    }

    function desencritarAsea($strDesencriptar){
        return base64_decode($strDesencriptar);
    }

    function encrypAsea($strEncriptar){
        $ch =& get_instance();
        return $ch->encrypt->encode($strEncriptar);
    }

    function decrypAsea($strDesencriptar){
        $ch =& get_instance();
        return $ch->encrypt->decode($strDesencriptar);
    }

?>