<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Constancia DC3</title>
    <link href="<?=base_url('extras/asea/constanciaDC3.css')?>" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="constancia_dc3">
        <table width="100%">
            <tr>
                <td width="10%"></td>
                <td class="izquierda"><img src="<?= base_url().$constanciaDC3->ruta_logo ?>" width="140px"
                                          height="60px"></td>
                <td class="derecha"><img src="<?= base_url('extras/imagenes/logo-civik.png') ?>" width="140px"
                                          height="60px"></td>
                <td width="10%"></td>
            </tr>
        </table>

        <div class="salto_linea"></div>

        <div class="titulo_dc3">
            FORMATO DC-3<div class="salto_linea"></div>
            CONSTANCIA DE COMPETENCIAS O DE HABILIDADES LABORALES
        </div>
        <div class="salto_linea"></div>
        <!-- datos generales -->
        <table width="100%" border="1">
            <tr>
                <td colspan="19" class="titulo_tabla_dc3">DATOS DEL TRABAJADOR</td>
            </tr>
            <tr>
                <td colspan="19" class="contenido_celda border_laterales">
                    Nombre (Anotar apellido paterno, apellido materno, nombre(s))
                </td>
            </tr>
            <tr>
                <td colspan="19" class="contenido_celda border_laterales">
                    <?=$constanciaDC3->nombre_trabajador?>
                </td>
            </tr>
            <tr>
                <td colspan="18" width="45%" class="contenido_celda border_no_inferior">Clave Única de Registro de Población</td>
                <td width="50%" class="contenido_celda border_no_inferior">Ocupación específica (Catálogo Nacional de Ocupaciones)<span class="superindice">/1</span></td>
            </tr>
            <tr>
                <?php foreach ($constanciaDC3->array_curp as $c): ?>
                    <td class="centrado contenido_celda border_no_superior"><?=$c?></td>
                <?php endforeach; ?>
                <td width="50%" class="contenido_celda border_no_superior"><?=$constanciaDC3->ocupacion_especifica?></td>
            </tr>
            <tr>
                <td colspan="19" class="contenido_celda border_laterales">Puesto</td>
            </tr>
            <tr>
                <td colspan="19" class="contenido_celda border_no_superior"><?=$constanciaDC3->puesto?></td>
            </tr>
        </table>
        <div class="salto_linea"></div>
        <div class="salto_linea"></div>

        <table width="100%" border="1">
            <tr>
                <td colspan="15" class="titulo_tabla_dc3">DATOS DE LA EMPRESA</td>
            </tr>
            <tr>
                <td colspan="15" class="contenido_celda border_no_inferior">Nombre o razón social (En caso de persona física, anotar apellido paterno, apellido materno, nombre (s))</td>
            </tr>
            <tr>
                <td colspan="15" class="contenido_celda border_no_superior"><?=$constanciaDC3->nombre_estacion?></td>
            </tr>
            <tr>
                <td colspan="15" class="contenido_celda border_no_inferior">Registro Federal de Contribuyentes con homoclave (SHCP)</td>
            </tr>
            <tr>
                <?php foreach ($constanciaDC3->array_rfc as $r): ?>
                    <td class="centrado contenido_celda border_no_superior"><?=$r?></td>
                <?php endforeach; ?>
                <td width="56%" class="border_no_superior"></td>
            </tr>
        </table>

        <div class="salto_linea"></div>
        <div class="salto_linea"></div>

        <table width="100%" border="1">
            <tr>
                <td colspan="20" class="titulo_tabla_dc3">DATOS DEL PROGRAMA DE CAPACITACIÓN, ADIESTRAMIENTO Y PRODUCTIVIDAD</td>
            </tr>
            <tr>
                <td colspan="20" class="contenido_celda border_no_inferior">Nombre del curso</td>
            </tr>
            <tr>
                <td colspan="20" class="contenido_celda border_no_superior"><?=$constanciaDC3->nombre_norma?></td>
            </tr>
            <tr>
                <td width="29%" class="contenido_celda border_no_inferior">Duración en horas</td>
                <td width="9%" class="contenido_celda border_no_inferior border_no_derecho izquierda">Periodo de</td>
                <td width="4%" class="contenido_celda border_no_inferior border_no_izquierdo"></td>
                <td colspan="4" class="contenido_celda border_no_inferior centrado">Año</td>
                <td colspan="2" class="contenido_celda border_no_inferior centrado">Mes</td>
                <td colspan="2" class="contenido_celda border_no_inferior centrado">Día</td>
                <td class="border_no_inferior contenido_celda"></td>
                <td colspan="4" class="contenido_celda border_no_inferior centrado">Año</td>
                <td colspan="2" class="contenido_celda border_no_inferior centrado">Mes</td>
                <td colspan="2" class="contenido_celda border_no_inferior centrado">Día</td>
            </tr>
            <tr>
                <td width="29%" class="contenido_celda border_no_superior"><?=$constanciaDC3->duracion_norma?></td>
                <td width="9%" class="contenido_celda border_no_superior border_no_derecho">Ejecución:</td>
                <td width="4%" class="contenido_celda_prog_capa border_no_superior border_no_izquierdo derecha">
                    <span style="color: white">&nbsp;</span><span class="subindice">De</span>
                </td>
                <?php foreach ($constanciaDC3->fecha_inicio as $f): ?>
                    <td class="contenido_celda_prog_capa border_no_superior centrado"><?=$f?></td>
                <?php endforeach; ?>
                <td class="contenido_celda_prog_capa border_no_superior centrado">
                    <span style="color: white">&nbsp;</span><span class="subindice">a</span>
                </td>
                <?php foreach ($constanciaDC3->fecha_fin as $f): ?>
                    <td class="contenido_celda_prog_capa border_no_superior centrado"><?=$f?></td>
                <?php endforeach; ?>
            </tr>

            <tr>
                <td colspan="20" class="contenido_celda border_no_inferior">Área temática del curso<span class="superindice">/2</span></td>
            </tr>
            <tr>
                <td colspan="20" class="contenido_celda border_no_superior"><?=$constanciaDC3->area_tematica?></td>
            </tr>

            <tr>
                <td colspan="20" class="contenido_celda border_no_inferior">Nombre del agente capacitador o STPS<span class="superindice">/3</span></td>
            </tr>
            <tr>
                <td colspan="20" class="contenido_celda border_no_superior"><?=$constanciaDC3->agente_capacitador?></td>
            </tr>
        </table>

        <div class="salto_linea"></div>
        <div class="salto_linea"></div>

        <table width="100%" border="1">
            <tr>
                <td class="contenido_celda_firmas centrado border_no_inferior" width="100%" colspan="7">
                    Los datos se asientan en esta constancia bajo protesta de decir verdad, apercibidos de la responsabilidad en que incurre todo
                    <br><br>aquel que no se conduce con verdad.
                </td>
            </tr>

            <tr>
                <td class="border_no_superior border_no_inferior" colspan="7"></td>

            </tr>

            <tr>
                <td class="contenido_celda centrado border_no_superior border_no_derecho border_no_inferior"></td>
                <td width="29%" class="contenido_celda centrado border_ninguno">Instructor o tutor</td>
                <td class="border_ninguno"></td>
                <td width="29%" class="contenido_celda centrado border_no_superior border_no_izquierdo border_no_derecho border_no_inferior">Patrón o representante legal <span class="superindice">/4</span></td>
                <td class="contenido_celda centrado border_ninguno"></td>
                <td width="29%" class="contenido_celda centrado border_ninguno">Representante de los trabajadores <span class="superindice">/5</span></td>
                <td class="contenido_celda centrado border_no_superior border_no_izquierdo border_no_inferior border_no_superior"></td>
            </tr>

            <tr>
                <td class="contenido_celda centrado border_no_superior border_no_inferior" colspan="7"></td>

            </tr>

            <tr>
                <td class="contenido_celda centrado border_no_superior border_no_derecho border_no_inferior"></td>
                <td width="29%" class="contenido_celda centrado border_ninguno"><?=$constanciaDC3->instructor?></td>
                <td class="border_ninguno"></td>
                <td width="29%" class="contenido_celda centrado border_no_superior border_no_izquierdo border_no_derecho border_no_inferior"><?=$constanciaDC3->representante_legal?></td>
                <td class="contenido_celda centrado border_ninguno"></td>
                <td width="29%" class="contenido_celda centrado border_ninguno"><?=$constanciaDC3->representante_trabajadores?></td>
                <td class="contenido_celda centrado border_no_superior border_no_izquierdo border_no_inferior border_no_superior"></td>
            </tr>


            <tr>
                <td width="5%" class="contenido_celda centrado border_no_superior border_no_derecho border_no_inferior"></td>
                <td width="28.33%" class="contenido_celda centrado border_ninguno border_inferior"></td>
                <td width="5%" class="border_ninguno"></td>
                <td width="28.33%" class="contenido_celda centrado border_ninguno border_inferior"></td>
                <td width="5%" class="contenido_celda centrado border_ninguno"></td>
                <td width="28.33%" class="contenido_celda centrado border_ninguno border_inferior"></td>
                <td width="5%" class="contenido_celda centrado border_no_superior border_no_izquierdo border_no_inferior border_no_superior"></td>
            </tr>

            <tr>
                <td class="contenido_celda centrado border_no_superior border_no_derecho"></td>
                <td width="29%" class="contenido_celda centrado border_no_superior border_no_derecho border_no_izquierdo">Nombre y firma</td>
                <td class="border_no_superior border_no_derecho border_no_izquierdo"></td>
                <td width="29%" class="contenido_celda centrado border_no_superior border_no_derecho border_no_izquierdo">Nombre y firma</td>
                <td class="contenido_celda centrado border_no_superior border_no_derecho border_no_izquierdo"></td>
                <td width="29%" class="contenido_celda centrado border_no_superior border_no_derecho border_no_izquierdo">Nombre y firma</td>
                <td class="contenido_celda border_no_izquierdo border_no_superior"></td>
            </tr>

        </table>
        <div class="salto_linea"></div>
        <div class="contenido_instrucciones" >
            <label>INSTRUCCIONES</label>.<div class="salto_linea_instrucciones"></div>
            - Llenar a máquina o con letra de molde.<div class="salto_linea_instrucciones"></div>
            - Deberá entregarse al trabajador dentro de los veinte días hábiles siguientes al término del curso de capacitación aprobado.<div class="salto_linea_instrucciones"></div>
            <span class="superindice">/1</span>Las áreas y subáreas ocupacionales del Catálogo Nacional de Ocupaciones se encuentran disponibles en el reverso
                de este formato y en la página <a href="http://www.stps.gob.mx" target="_blank">www.stps.gob.mx</a> <div class="salto_linea_instrucciones"></div>
            <span class="superindice">/2</span>Las áreas temáticas de los cursos se encuentran disponibles en el reverso de este formato y en la página
            <a href="http://www.stps.gob.mx" target="_blank">www.stps.gob.mx</a><div class="salto_linea_instrucciones"></div>
            <span class="superindice">/3</span>Cursos impartidos por el área competente de la Secretaria del Trabajo y Previsión Social. <div class="salto_linea_instrucciones"></div>
            <span class="superindice">/4</span>Para empresas con menos de 51 trabajadores. Para empresas con más de 50 trabajadores firmaría el representante del patrón ante la Comisión mixta de capacitación,
            <div class="salto_linea"></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;adiestramiento y productividad.<div class="salto_linea_instrucciones"></div>
            <span class="superindice">/5</span>Solo para empresas con más de 50 trabajadores. <div class="salto_linea_instrucciones"></div>
            * Dato no obligatorio
        </div>
        <div class="salto_linea_instrucciones"></div>
        <div class="pie_pagina_dc3">
            DC-3&nbsp;&nbsp;&nbsp;&nbsp;<div class="salto_linea_instrucciones">ANVERSO</div>
        </div>
    </div>
</body>
</html>