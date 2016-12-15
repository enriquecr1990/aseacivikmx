<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="<?= base_url() . 'extras/asea/comun.css' ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url() . 'extras/bootstrap/css/bootstrap.css' ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url() . 'extras/datepicker/css/bootstrap-datepicker.css'?>" rel="stylesheet" type="text/css" >
    <link href="<?= base_url() . 'extras/bootstrap/css/font-awesome.css' ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url() . 'extras/fileinput/css/fileinput.css'?>" rel="stylesheet" type="text/css" >
    <link href="<?= base_url() . 'extras/fileupload/css/jquery.fileupload.css'?>" rel="stylesheet" type="text/css" >

    <link href="<?= base_url() . 'extras/imagenes/icono-ASEA.png'?>" rel="shortcut icon">

    <title>ASEA - Agencia de Seguridad, Energía y Ambiente</title>
</head>
<body>
<!-- se carga el menu -->

<?php $this->load->view('default/menu') ?>

<div id="backgroundImage">
    <div class="container main">

        <div class="row">
            <div class="col-sm-12">
                <div id="conteiner_mensajes_sistema_asea" class="mensajes_sistema_asea"></div>
            </div>
        </div>



